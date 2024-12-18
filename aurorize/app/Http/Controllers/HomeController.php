<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\FAQs;
use App\Models\User;
use App\Helpers\Helper;
use App\Models\Contact;
use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::guard('web')->check()) {
            return view('welcome');
        }
        return redirect()->route('login');
    }

    public function dashboard()
    {
        return view('home');
    }

    /**
     * Go to change profile page
     *
     * @return void
     */
    public function profile()
    {
        $user = Auth::guard('web')->user();
        return view('auth.profile', compact('user'));
    }

    /**
     * Save profile details
     *
     * @param  mixed $request
     * @return void
     */
    public function saveProfile(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->getMessageBag()->toArray());
            }

            /** @var \App\User @user */
            $user = Auth::guard('web')->user();
            if ($user) {
                $user->name = $request->name;
                $user->save();
                if ($user->role_id == 1) {
                    return redirect()->route('admin.dashboard')->with('success', trans('app.Profile_has_been_saved_success'));
                }
                return redirect()->route('user.profile')->with('success', trans('app.Profile_has_been_saved_success'));
            } else {
                return redirect()->back()->with('error', trans('app.something_went_wrong'));
            }
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('error', trans('app.something_went_wrong'));
        }
    }

    /**
     * ChangePassword
     *
     * @return void
     */
    public function changePassword()
    {
        return view('auth.change-password');
    }

    /**
     * UpdatePassword
     *
     * @param  mixed $request
     * @return void
     */
    public function updatePassword(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'old_password' => 'required',
                'password' => 'required|string|min:6|confirmed',
            ], [
                'old_password.required' => 'Please enter old password',
                'password.required' => 'Please enter password',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->getMessageBag()->toArray());
            }

            $user = Auth::guard('web')->user();
            if (Hash::check($request->old_password, $user->password)) {
                $obj_user = User::find($user->id);
                $obj_user->password = Hash::make($request->password);;
                $obj_user->save();
                return redirect()->route('home')->with('success', trans('auth.password_changed_success'));
            } else {
                return redirect()->back()->with("error", trans('auth.please_enter_correct_current_password'));
            }
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('error', trans('app.something_went_wrong'));
        }
    }

    /**
     * Terms and Conditions Page
     *
     * @return void
     */
    public function termsConditions()
    {
        $pagecontent = "";
        if (Storage::exists("terms-conditions.txt")) {
            $pagecontent = Storage::get("terms-conditions.txt");
        }
        return view('pages.terms-conditions', compact('pagecontent'));
    }

    /**
     * Privacy Policy Page
     *
     * @return void
     */
    public function privacyPolicy()
    {
        $pagecontent = "";
        if (Storage::exists("privacy-policy.txt")) {
            $pagecontent = Storage::get("privacy-policy.txt");
        }
        return view('pages.privacy-policy', compact('pagecontent'));
    }

    /**
     * About Us Page
     *
     * @return void
     */
    public function aboutUs()
    {
        $pagecontent = "";
        if (Storage::exists("about-us.txt")) {
            $pagecontent = Storage::get("about-us.txt");
        }
        return view('pages.about-us', compact('pagecontent'));
    }

    /**
     * About Us Page
     *
     * @return void
     */
    public function homePage()
    {
        // dd(1);
        return view('front.home');
    }
    /**
     * About Us Page
     *
     * @return void
     */
    public function homeInquiry()
    {
        // dd(1);
        return view('front.contact');
    }

    public function getRcm()
    {
        // dd(1);
        return view('front.rcm');
    }

    public function getIdr()
    {
        // dd(1);
        return view('front.idr');
    }

    /**
     * About Us Page
     *
     * @return void
     */
    public function submitInquiry(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ];

        $contact =  Contact::create($data);

        if ($contact) {
            return redirect()->back()->with(['success' => "Inquiry send successfully"]);
        }
    }

    /**
     * Contact Us Page
     *
     * @return void
     */
    public function contactUs()
    {
        return view('pages.contact-us');
    }

    /**
     * Save enquiry
     *
     * @param  mixed $request
     * @return void
     */
    public function enquiry(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'email' => 'required',
                    'message' => 'required',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->getMessageBag()->toArray());
            }

            $contact = Contact::create(
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'subject' => $request->subject,
                    'message' => $request->message,
                ]
            );
            if ($contact) {
                // Send contact equiry mail to admin
                $mail_data = [
                    'email_id' => 6,
                    'user_id' => 1,
                    'name' => $request->name,
                    'email' => $request->email,
                    'subject' => $request->subject,
                    'message' => $request->message,
                ];

                dispatch(new SendEmailJob($mail_data));
                return redirect()->back()->with('success', trans('app.Enquiry_has_been_sent_success'));
            } else {
                return redirect()->back()->with('error', trans('app.something_went_wrong'));
            }
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('error', trans('app.something_went_wrong'));
        }
    }

    /**
     * Check user email is exists or not
     *
     * @param  mixed $request
     * @return void
     */
    public function checkExists(Request $request)
    {
        try {
            $exists = User::where('email', $request->email);
            if ($request->has('id') && $request->id != "") {
                $exists->where('id', '!=', $request->id);
            }
            $exists = $exists->first();
            if ($exists) {
                echo 'false';
            } else {
                echo 'true';
            }
        } catch (Throwable $e) {
            report($e);
            echo "false";
        }
        exit;
    }

    /**
     * Blog Page
     *
     * @param  mixed $slug
     * @return void
     */
    public function viewBlogs($slug = NULL)
    {
        try {
            if (isset($slug) && !is_null($slug)) {
                $blog = Helper::getRelatedBlogs(['slug' => $slug]);
                if (isset($blog) && !empty($blog)) {
                    return view('pages.blog-details', compact("blog"));
                } else {
                    return redirect()->back()->with("error", trans('app.Blog_is_not_found'));
                }
            }
            $blogs = Helper::getRelatedBlogs(['paginate' => 6]);
            return view('pages.blogs', compact("blogs"));
        } catch (Throwable $e) {
            report($e);
            return redirect('/')->with("error", trans('app.something_went_wrong'));
        }
    }

    /**
     * Notifications
     *
     * @return void
     */
    public function notifications()
    {
        try {
            $user_id = Auth::id();
            $notifications =  Helper::getNotification(['user_id' => $user_id, 'limit' => 5]);

            Helper::readNotification(['user_id' => $user_id]);

            return ['status' => 1, 'result' => $notifications];
        } catch (Throwable $e) {
            return ['status' => 0, 'result' => ""];
        }
    }

    /**
     * AllNotifications
     *
     * @return void
     */
    public function allNotifications()
    {
        try {
            $user_id = Auth::id();
            Helper::readNotification(['user_id' => $user_id]);
            $notifications = Helper::getNotification(['user_id' => $user_id, 'paginate' => 10]);

            return view('message.notification', compact('notifications'));
        } catch (Throwable $e) {
            return redirect('/')->with('error', trans('app.something_went_wrong'));
        }
    }

    /**
     * Upload file into temp directories (It will be delete after 24 hours)
     *
     * @param  mixed $request
     * @return void
     */
    public function uploadFiles(Request $request)
    {
        try {
            $uploadedFile = [];
            $prefix = "";
            if ($request->file('files')) {
                $files = $request->file('files');
                if (is_array($files)) {
                    foreach ($request->file('files') as $file) {
                        $ext = $file->getClientOriginalExtension();
                        $prefix = Helper::getPrefixBasedOnExtension($ext);
                        $filename = $prefix . "-" . \Carbon\Carbon::now()->timestamp . mt_rand(1, 100) . "." . $ext;
                        $temp = [];
                        $temp['name'] = $filename;
                        $temp['url'] = Helper::uploadFile($file, config('constant.temp_file_url'), $filename);
                        $uploadedFile[] = $temp;
                    }
                } else {
                    $file = $request->file('files');
                    $ext = $file->getClientOriginalExtension();
                    $prefix = Helper::getPrefixBasedOnExtension($ext);
                    $filename = $prefix . "-" . \Carbon\Carbon::now()->timestamp . mt_rand(1, 100) . "." . $ext;
                    $uploadedFile['name'] = $filename;
                    $uploadedFile['url'] = Helper::uploadFile($file, config('constant.temp_file_url'), $filename);
                }
                return response()->json(['status' => true, 'files' => $uploadedFile], 200);
            }
            return response()->json(['status' => false, 'files' => null], 200);
        } catch (Throwable $e) {
            report($e);
            return response()->json(
                [
                    'status' => false,
                    'files' => null,
                    'message' => trans('app.something_went_wrong')
                ],
                200
            );
        }
    }

    /**
     * UploadCKeditorImage
     *
     * @param  mixed $request
     * @return void
     */
    public function uploadCKeditorImage(Request $request)
    {
        $url = $msg = "";
        $CKEditorFuncNum = $request->input('CKEditorFuncNum');
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            if (in_array($extension, ['png', 'PNG', 'jpg', 'JPG', 'jpeg', 'JPEG', 'gif', 'GIF'])) {
                $fileName = $fileName . '_' . time() . '.' . $extension;

                // Upload image on server
                $file = $request->file('upload');
                Helper::uploadFile($file, config('constant.temp_file_url'), $fileName);
                $url = Helper::assets(config('constant.temp_file_url') . $fileName);

                $msg = 'Image uploaded successfully';
            } else {
                $msg = 'An error occured while uploading the file.';
            }
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
        } else {
            $msg = 'No image uploaded.';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
        }

        @header('Content-type: text/html; charset=utf-8');
        echo $response;
    }

    /**
     * UploadCropImage
     *
     * @param  mixed $request
     * @return void
     */
    public function uploadCropImage(Request $request)
    {
        $folderPath = public_path(config('constant.cropped_image_url'));

        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        $imageName = "Img-" . date('YmdHis') . mt_rand(1, 100) . '.' . $image_type;

        $imageFullPath = $folderPath . $imageName;

        file_put_contents($imageFullPath, $image_base64);

        return response()->json([
            'success' => true,
            'url' => Helper::assets(config('constant.cropped_image_url') . $imageName),
            'filename' => $imageName
        ]);
    }

    /**
     * Detailed description of testimonial
     *
     * @param  mixed $request
     * @return void
     */
    public function viewTestimonialDesc(Request $request)
    {
        try {
            // if ($request->ajax()) {
            //     $testimonial = Testimonial::where('id', $request->id)->first();
            //     if (isset($testimonial) && !empty($testimonial)) {
            //         $data = ['status' => true, 'message' => '', 'data' => $testimonial];
            //     } else {
            //         $data['message'] = 'Testimonial is not found';
            //         $data['status'] = false;
            //     }
            //     return response()->json($data, 200);
            // }
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('error', trans('app.something_went_wrong'));
        }
    }
}
