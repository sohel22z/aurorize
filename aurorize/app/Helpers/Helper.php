<?php

namespace App\Helpers;

use Throwable;
use DOMDocument;
use Carbon\Carbon;
use App\Models\Blog;
use App\Models\User;
use App\Models\Country;
use App\Models\Category;
use App\Models\Notification;
use App\Models\SystemSetting;
use App\Models\UserLoginDevice;
use App\Models\NotificationReciver;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Spatie\ImageOptimizer\OptimizerChainFactory;

class Helper
{
    // Returm assets path (like http://localhost/project/public/css or js or static images)
    public static function assets($path, $secure = null)
    {
        if (config('app.env') == "local") {
            return app('url')->asset($path, $secure);
        } else if (config('app.env') == "staging") {
            return app('url')->asset($path, $secure);
        } else if (config('app.env') == "production") {
            return app('url')->asset($path, $secure);
        }
        return app('url')->asset("public/" . $path, $secure);
    }

    // return documents (like flag ) relative path (like http://localhost/project/public)
    public static function images($path, $secure = null)
    {
        if (config('app.env') == "local") {
            return app('url')->asset($path, $secure);
        } else if (config('app.env') == "staging") {
            return app('url')->asset($path, $secure);
        } else if (config('app.env') == "production") {
            return app('url')->asset($path, $secure);
        }
        return app('url')->asset("public/" . $path, $secure);
    }

    // return absolute path (Full path like - var/wwww/html/project/public) with filename
    public static function uploadPDFFile($path, $filename)
    {
        if (config('app.env') == "local") {
            return public_path() . $path . $filename;
        } else if (config('app.env') == "staging") {
            return public_path() . $path . $filename;
        } else if (config('app.env') == "production") {
            return public_path() . $path . $filename;
        }
        return public_path() . $path . $filename;
    }

    // Upload Images, Document
    public static function uploadFile($fileData = Null, $path = Null, $filename = Null, $oldfilename = null)
    {
        if (!is_null($fileData)) {
            if (config('app.env') == "local") {
                $fileData->move(public_path() . $path, $filename);

                if (!is_null($oldfilename) && file_exists(public_path() . $path . $oldfilename)) {
                    unlink(public_path() . $path . $oldfilename);
                }
            } else if (config('app.env') == "staging") {
                $fileData->move(public_path() . $path, $filename);

                if (!is_null($oldfilename) && file_exists(public_path() . $path . $oldfilename)) {
                    unlink(public_path() . $path . $oldfilename);
                }
            } else if (config('app.env') == "production") {
                $fileData->move(public_path() . $path, $filename);

                if (!is_null($oldfilename) && file_exists(public_path() . $path . $oldfilename)) {
                    unlink(public_path() . $path . $oldfilename);
                }
            }

            self::optimizeImage($path, $filename);

            return self::assets($path . $filename);
        }
        return false;
    }

    // Delete a File
    public static function deleteFile($path = Null, $filename = Null)
    {
        if (!is_null($filename) && !empty($filename)) {
            if (config('app.env') == "local") {
                if (file_exists(public_path() . $path . $filename)) {
                    unlink(public_path() . $path . $filename);
                }
            } else if (config('app.env') == "staging") {
                if (file_exists(public_path() . $path . $filename)) {
                    unlink(public_path() . $path . $filename);
                }
            } else if (config('app.env') == "production") {
                if (file_exists(public_path() . $path . $filename)) {
                    unlink(public_path() . $path . $filename);
                }
            }
        }
        return true;
    }

    // Delete a File
    public static function deleteDirectory($path = Null)
    {
        if (!is_null($path)) {
            if (config('app.env') == "local") {
                if (is_dir(public_path() . $path)) {
                    File::deleteDirectory(public_path() . $path);
                }
            } else if (config('app.env') == "staging") {
                if (is_dir(public_path() . $path)) {
                    File::deleteDirectory(public_path() . $path);
                }
            } else if (config('app.env') == "production") {
                if (is_dir(public_path() . $path)) {
                    File::deleteDirectory(public_path() . $path);
                }
            }
        }
        return true;
    }

    // Check file exists or not - return absolute path (Full path like - var/wwww/html/project/public) with filename
    public static function checkFileExists($path, $filename)
    {
        if (config('app.env') == "local") {
            if (file_exists(public_path() . $path . $filename)) {
                return public_path() . $path . $filename;
            }
        } else if (config('app.env') == "staging") {
            if (file_exists(public_path() . $path . $filename)) {
                return public_path() . $path . $filename;
            }
        } else if (config('app.env') == "production") {
            if (file_exists(public_path() . $path . $filename)) {
                return public_path() . $path . $filename;
            }
        }
        return "";
    }

    // Copy file from one location to another location
    public static function copyFile($sourcefilepath = Null, $destinationfilepath = null, $filename = null, $is_delete_source_file = true)
    {
        if (!is_null($sourcefilepath) && !is_null($destinationfilepath) && !is_null($filename)) {
            if (config('app.env') == "local") {
                if (file_exists(public_path() . $sourcefilepath . $filename)) {
                    copy(public_path() . $sourcefilepath . $filename, public_path() . $destinationfilepath . $filename);
                    if ($is_delete_source_file) {
                        unlink(public_path() . $sourcefilepath . $filename);
                    }
                }
            } else if (config('app.env') == "staging") {
                if (file_exists(public_path() . $sourcefilepath . $filename)) {
                    copy(public_path() . $sourcefilepath . $filename, public_path() . $destinationfilepath . $filename);
                    if ($is_delete_source_file) {
                        unlink(public_path() . $sourcefilepath . $filename);
                    }
                }
            } else if (config('app.env') == "production") {
                if (file_exists(public_path() . $sourcefilepath . $filename)) {
                    copy(public_path() . $sourcefilepath . $filename, public_path() . $destinationfilepath . $filename);
                    if ($is_delete_source_file) {
                        unlink(public_path() . $sourcefilepath . $filename);
                    }
                }
            }
        }
        return true;
    }


    public static function createThumbnail($path, $filename)
    {
        try {
            if ($pathToImage = self::checkFileExists($path, $filename)) {
                $filenPath = self::assets($path . $filename);
                $ext =  pathinfo(parse_url($filenPath, PHP_URL_PATH), PATHINFO_EXTENSION);
                $width = 60;
                $height = 60;

                list($width_orig, $height_orig) = getimagesize($filenPath);

                $new_width  =   $width;
                $new_height =   floor($height_orig * ($new_width / $width_orig));
                $crop_x     =   0;
                $crop_y     =   ceil(($height - $width) / 2);
                $ratio_orig = $width_orig / $height_orig;
                $height = $height;
                $width = $width;

                $image_p = imagecreatetruecolor($width, $height);

                if ($ext == 'jpeg' || $ext == 'jpg' || exif_imagetype($filenPath) === 2) {
                    $image = imagecreatefromjpeg($filenPath);
                } else if ($ext == 'png' || exif_imagetype($filenPath) === 3) {
                    $image = imagecreatefrompng($filenPath);
                } else if ($ext == 'webp' || exif_imagetype($filenPath) === 18) {
                    $image = imagecreatefromwebp($filenPath);
                }

                imagecopyresampled($image_p, $image, 0, 0, $crop_x, $crop_y, $new_width, $new_height, $width_orig, $height_orig);

                if ($ext == 'jpeg' || $ext == 'jpg' || exif_imagetype($filenPath) === 2) {
                    imagejpeg($image_p, public_path() . $path . 'thumb/' . $filename, 100);
                } else if ($ext == 'png' || exif_imagetype($filenPath) === 3) {
                    imagepng($image_p, public_path() . $path . 'thumb/' . $filename, 9);
                } else if ($ext == 'webp' || exif_imagetype($filenPath) === 18) {
                    imagewebp($image_p, public_path() . $path . 'thumb/' . $filename, 9);
                }
            }
        } catch (Throwable $e) {
            report('Helper ' . $e);
        }
    }

    public static function optimizeImage($path, $filename)
    {
        try {
            if ($pathToImage = self::checkFileExists($path, $filename)) {
                $optimizerChain = OptimizerChainFactory::create();
                $optimizerChain->optimize($pathToImage);
            }
        } catch (Throwable $e) {
            report('Helper ' . $e);
        }
    }

    public static function getHumanReadableFormat($datetime, $format = "")
    {
        $datetime = Carbon::createFromTimeStamp(strtotime($datetime));
        if ($format != "") {
            return $datetime->format($format);
        }
        if ($datetime->isToday()) {
            return 'Today';
        } else if ($datetime->isYesterday()) {
            return 'Yesterday';
        } else if ($datetime->diffInDays(Carbon::now()) < 7) {
            return $datetime->diffForHumans();
        }
        return $datetime->format('d/m/Y');
    }

    public static function replaceImagePath($text = "", $path)
    {
        $htmlDom = new DOMDocument();
        $htmlDom->loadHTML($text);
        $imageTags = $htmlDom->getElementsByTagName('img');
        if (!empty($imageTags)) {
            foreach ($imageTags as $imageTag) {
                $imgSrc = $imageTag->getAttribute('src');
                if ($imgSrc) {
                    $file = pathinfo($imgSrc);
                    $filename = $file['basename'];
                    self::copyFile(config('constant.temp_file_url'), $path, $filename);
                }
            }
            $text = str_replace(config('constant.temp_file_url'), $path, $text);
        }

        $inputTags = $htmlDom->getElementsByTagName('input');
        if (!empty($inputTags)) {
            foreach ($inputTags as $inputTag) {
                $imgType = $inputTag->getAttribute('type');
                if ($imgType == "image") {
                    $imgSrc = $inputTag->getAttribute('src');
                    if ($imgSrc) {
                        $file = pathinfo($imgSrc);
                        $filename = $file['basename'];
                        self::copyFile(config('constant.temp_file_url'), $path, $filename);
                    }
                }
            }
            $text = str_replace(config('constant.temp_file_url'), $path, $text);
        }

        return $text;
    }

    // Get all Settings
    public static function getSetting($id = 1)
    {
        $Setting = SystemSetting::select('*');
        if (!is_null($id)) {
            $Setting->where('id', $id);
        }
        return $Setting->first();
    }

    public static function getCountry($params = [])
    {
        $Country = Country::select('*');
        if (isset($params['status'])) {
            $Country->where('status', $params['status']);
        }
        if (isset($params['isd_code'])) {
            $Country->orderBy('isd_code', $params['isd_code']);
        }
        if (isset($params['id']) && !empty($params['id'])) {
            return $Country->where('id', $params['id'])->first();
        }
        return $Country->get();
    }

    public static function getState($params = [])
    {
        /* $State = State::select('*');
        if (isset($params['status'])) {
            $State->where('status', $params['status']);
        }
        if (isset($params['country_id']) && !empty($params['country_id'])) {
            $State->where('country_id', $params['country_id']);
        }
        if (isset($params['id']) && !empty($params['id'])) {
            return $State->where('id', $params['id'])->first();
        }
        return $State->get(); */
    }

    public static function getCity($params = [])
    {
        /* $City = City::select('*');

        if (isset($params['with_country'])) {
            $City->with(
                [
                    'country' => function ($query) use ($params) {
                        $query->select('countries.id', 'countries.name');
                        if (isset($params['country_id']) && !empty($params['country_id'])) {
                            $query->where('countries.id', $params['country_id']);
                        }
                    }
                ]
            );
            $City->whereHas(
                'country',
                function ($query) use ($params) {
                    $query->select('countries.id', 'countries.name');
                    if (isset($params['country_id']) && !empty($params['country_id'])) {
                        $query->where('countries.id', $params['country_id']);
                    }
                }
            );
        }
        if (isset($params['status'])) {
            $City->where('status', $params['status']);
        }
        if (isset($params['state_id']) && !empty($params['state_id'])) {
            $City->where('state_id', $params['state_id']);
        }
        if (isset($params['id']) && !empty($params['id'])) {
            return $City->where('id', $params['id'])->first();
        }
        return $City->get(); */
    }

    //get categories
    // public static function getCategory($params = [])
    // {
    //     $categories = Category::select('*');
    //     if (isset($params['id']) && !empty($params['id'])) {
    //         return $categories->where('id', $params['id'])->first();
    //     }
    //     return $categories->get();
    // }

    // Read notification
    public static function readNotification($params = array())
    {
        try {
            $notification = NotificationReciver::where(["receiver_id" => $params['user_id'], 'status' => 0])->update(['status' => 1]);
            return $notification;
        } catch (Throwable $e) {
            report($e);
            return false;
        }
    }

    // get notifications
    public static function getNotification($params = array())
    {
        try {
            $notification = Notification::select('*');

            $notification->whereHas('receivers', function ($query) use ($params) {
                if (isset($params['user_id']) && !is_null($params['user_id'])) {
                    $query->where('receiver_id', $params['user_id']);
                }
                if (isset($params['status']) && !is_null($params['status'])) {
                    $query->where('status', $params['status']);
                }
            });

            $notification->orderBy('created_at', 'desc');

            // return only count
            if (isset($params['count']) && !is_null($params['count'])) {
                return $notification->count();
            }

            // return pagignation for web
            if (isset($params['paginate']) && !is_null($params['paginate'])) {
                return $notification->paginate($params['paginate']);
            }

            return $notification->get();
        } catch (Throwable $e) {
            report($e);
            return array();
        }
    }

    // Create slug for url
    public static function createSlug($title, $id = null, $type = "blog")
    {
        // Normalize the title
        $slug = implode('/', $title);

        $i = 1;
        $nslug = $slug;

        while (self::getRelatedSlugs($nslug, $id, $type)) {
            $nslug = $slug . '-' . $i;
            $i++;
        }

        return $nslug;

        // // Get any that could possibly be related.
        // // This cuts the queries down by doing it once.
        // $allSlugs = self::getRelatedSlugs($slug, $id, $type);

        // // If we haven't used it before then we are all good.
        // if (!$allSlugs->contains('slug', $slug)) {
        //     return $slug;
        // }

        // // Just append numbers like a savage until we find not used.
        // for ($i = 1; $i <= 100000; $i++) {
        //     $newSlug = $slug . '-' . $i;
        //     if (!$allSlugs->contains('slug', $newSlug)) {
        //         return $newSlug;
        //     }
        // }
    }

    // check slug already exists
    public static function getRelatedSlugs($slug, $id = null, $type = "blog")
    {
        if ($type == "blog") {
            $data = Blog::select('slug');
        } else {
            $data = null;
        }
        if ($data != null) {
            $data->where('slug', 'like', $slug . '%');
            if ($id != null) {
                $data->where('id', '<>', $id);
            }
            return $data->exists();
        }
        return;
    }

    // Get all blogs
    public static function getRelatedBlogs($param = [])
    {
        $blogs = Blog::select("*");
        $blogs->orderBy("id", "desc");
        if (isset($param['slug']) && !is_null($param['slug'])) {
            return $blogs->where('slug', '=', $param['slug'])->first();
        }
        if (isset($param['blog_id']) && !is_null($param['blog_id'])) {
            $blogs->where('id', '!=', $param['blog_id']);
        }
        if (isset($param['count']) && !is_null($param['count'])) {
            $blogs->limit($param['count']);
        }
        if (isset($param['id']) && !is_null($param['id'])) {
            return $blogs->where('id', '=', $param['id'])->first();
        }
        if (isset($param['paginate']) && !is_null($param['paginate'])) {
            return $blogs->paginate($param['paginate']);
        }
        return $blogs->get();
    }

    public static function getUsers($params = array())
    {
        try {
            $nuser = User::select("id", "name", "email", 'is_complete_profile');

            if (isset($params['role']) && !empty($params['role'])) {
                $nuser->where('role_id', $params['role']);
            }

            if (isset($params['id']) && !empty($params['id'])) {
                return $nuser->where('id', $params['id'])->first();
            }
            return $nuser->get();
        } catch (Throwable $e) {
            report($e);
            return "";
        }
    }

    public static function updateLastActive($user)
    {
        try {
            $user->last_active_at = date('Y-m-d H:i:s');
            $user->save();
            return true;
        } catch (Throwable $e) {
            report($e);
            return false;
        }
    }

    public static function getTestimonial($params = [])
    {
        try {
            // $testimonials = Testimonial::select('id', 'name', 'image', 'description');
            // if (isset($params['id']) && !empty($params['id'])) {
            //     return $testimonials->where('users.id', $params['id'])->first();
            // }
            // return $testimonials->orderBy('id', 'desc')->get();
        } catch (Throwable $e) {
            report($e);
        }
    }

    public static function convertInHtml($msg = "")
    {
        $url = '@(http(s)?)?(://)?(([a-zA-Z])([-\w]+\.)+([^\s\.]+[^\s]*)+[^,.\s])@';
        $msg = preg_replace(
            $url,
            '<a href="http$2://$4" target="_blank">$0</a>',
            $msg
        );
        $msg = str_ireplace(
            array("\r\n\t", '\r\n\t', "\r\n", '\r\n', "\n", '\n', "\t", '\t'),
            '<br/>',
            $msg
        );
        return $msg;
    }


    /**
     * GetPrefixBasedOnExtension
     *
     * @param  mixed $ext
     * @return void
     */
    public static function getPrefixBasedOnExtension($ext = "")
    {
        $prefix = "";
        if (in_array($ext, ['png', 'jpeg', 'jpg', 'svg', 'gif'])) {
            $prefix = "IMG";
        } else if (in_array($ext, ['mp4', 'mkv', 'webm', 'mov'])) {
            $prefix = "VID";
        } else if (in_array($ext, ['pdf'])) {
            $prefix = "PDF";
        } else if (in_array($ext, ['doc', 'docx'])) {
            $prefix = "DOC";
        }
        return $prefix;
    }

    /**
     * FindDistance
     *
     * @param  mixed $latitude
     * @param  mixed $longitude
     * @return void
     */
    public static function findDistance($latitude, $longitude)
    {
        return "(6371 * acos(cos(radians($latitude))
        * cos(radians(latitude))
        * cos(radians(longitude)
        - radians($longitude))
        + sin(radians($latitude))
        * sin(radians(latitude))))";
    }

    /**
     * SocialMediaShareUrl
     *
     * @param  mixed $type
     * @param  mixed $link
     * @param  mixed $message
     * @param  mixed $param
     * @return void
     */
    public static function socialMediaShareUrl($type, $link, $message, $param = '')
    {
        $url = '';
        switch ($type) {
            case 'fb':
                $url = config('constant.facebook_share_url');
                $url = str_replace('{href}', $link, $url);
                $url = str_replace('{redirect_uri}', $link, $url);
                $url = str_replace('{quote}', $message, $url);
                break;
            case 'twit':
                $url = config('constant.twitter_share_url');
                $url = str_replace('{url}', $link, $url);
                $url = str_replace('{text}', $message, $url);
                break;

            default:
                break;
        }
        return $url;
    }

    public static function generageRandomPassword()
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        $pass = implode($pass);
        return $pass;
    }
}
