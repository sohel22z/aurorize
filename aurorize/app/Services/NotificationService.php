<?php

namespace App\Services;

use Throwable;
use App\Models\User;
use App\Models\Notification;
use App\Models\UserLoginDevice;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class NotificationService
{
    /**
     * Send Notifiction
     *
     * @param  mixed $params
     * @return mixed
     */
    public static function sendNotifiction($params = [])
    {
        $notification = Notification::create([
            'type' => $params['type'] ?? null,
            'text' =>  $params['text'] ?? null,
            'sender_id' => $params['sender_id'] ?? null,
            'redirect_on' => $params['redirect_on'] ?? null,
        ]);

        if ($notification) {
            if (is_array($params['receiver_id'])) {
                foreach ($params['receiver_id'] as $receiver) {
                    $notification->receivers()->create([
                        'receiver_id' => $receiver ?? null,
                        'status' => 0
                    ]);
                }
            } else {
                $notification->receivers()->create([
                    'receiver_id' => $params['receiver_id'] ?? null,
                    'status' => 0
                ]);
            }

            if (isset($params['push_noti'])) {
                $receiver_id = [];
                if (is_array($params['receiver_id'])) {
                    $receiver_id = $params['receiver_id'];
                } else {
                    $receiver_id[] = $params['receiver_id'];
                }

                $params = collect($params)->except(['text', 'type', 'receiver_id', 'push_noti'])->all();

                Log::channel('notification')->info($params);

                NotificationService::sendPushNotifications($receiver_id, $notification->text, config('app.name'), $notification->type, $params);
            }
        }
    }


    /**
     * Send push notifications
     * 
     * @param array $receiverIds
     * @param string $message
     * @param string $title
     * @param mixed $type
     * @param array $params
     * @return void
     */
    public static function sendPushNotifications($receiverIds = [], $message = "", $title = "", $type = null, $params = [])
    {
        try {
            $receivers = User::select('id')
                ->whereIn('id', $receiverIds)
                ->with(
                    [
                        'userLoginDevices' => function ($query) {
                            $query->whereNull('logout_date')
                                ->where('is_signout', 0)
                                ->whereNotNull('fcm_token');
                        }
                    ]
                )
                ->has('userLoginDevices')
                ->get();

            if ($receivers->count()) {
                $deviceTokens = [];
                foreach ($receivers as $receiver) {
                    $deviceTokensTemp = collect($receiver->userLoginDevices)->pluck('fcm_token')->toArray();
                    $deviceTokens = array_merge($deviceTokens, $deviceTokensTemp);
                }

                $deviceTokens = array_values(array_unique($deviceTokens));

                if (count($deviceTokens)) {
                    $badge = 0;
                    if (isset($params['badge']) && !empty($params['badge']) && $params['badge'] > 0) {
                        $badge = $params['badge'];
                    }

                    $data = [
                        'body' => $message,
                        'title' => $title,
                        'type' => $type,
                        "badge" => $badge,
                        "sound" => ($type == 0 ? "" : "default")
                    ];

                    if (!empty($params)) {
                        $data = array_merge($data, $params);
                    }

                    Log::channel('notification')->info($deviceTokens);
                    Log::channel('notification')->info($data);

                    $fields = [
                        'registration_ids' => $deviceTokens, // send notification on multiple device
                        // 'to' => $registration_id, // send notification on single device
                        'notification' => $data,
                        'data' => $data,
                        "priority" => "high",
                        "android" => [
                            "notification" => [
                                "sound" => ($type == 0 ? "" : "default"),
                            ]
                        ],
                        "apns" => [
                            "payload" => [
                                "aps" => [
                                    "sound" => ($type == 0 ? "" : "default")
                                ]
                            ]
                        ],
                        "content_available" => true,
                        "mutable_content" => true
                    ];

                    // For silent notification
                    if ($type == 0) {
                        $fields["apns-priority"] = 5;
                        unset($fields['notification']);
                    }

                    $result = Http::withHeaders(
                        [
                            'Authorization' => "key=" . env('FCM_SERVER_KEY'),
                            'Content-Type' => 'application/json'
                        ]
                    )
                        ->post('https://fcm.googleapis.com/fcm/send', $fields)
                        ->json();

                    Log::channel('notification')->info($result);

                    if ($result && isset($result['failed_registration_ids'])) {
                        UserLoginDevice::whereIn('fcm_token', $result['failed_registration_ids'])->delete();
                    }
                }
            }
        } catch (Throwable $e) {
            report('NotificationService ' . $e);
        }
    }
}
