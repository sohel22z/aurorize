<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Notification extends Model
{
    use SoftDeletes;

    protected $fillable = ["type", "text", "sender_id", "redirect_on"];

    /**
     * Get all of the receivers for the Notification
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function receivers(): HasMany
    {
        return $this->hasMany(NotificationReciver::class, 'notification_id', 'id');
    }

    // This is a recommended way to declare event handlers
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            if (isset($model->receivers) && !empty($model->receivers)) {
                foreach ($model->receivers as $receiver) {
                    $receiver->delete();
                }
            }
        });
    }
}
