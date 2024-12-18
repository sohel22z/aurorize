<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use Illuminate\Http\Request;
use App\Models\SystemSetting;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/**
 * AdminController
 *
 * @author Anand parikh
 */
class AdminController extends Controller
{
    /**
     * Index
     *
     * @return void
     * @author Anand parikh
     */
    public function index()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('admin.login');
    }

    /**
     * settings
     *
     * @return void
     */
    public function settings()
    {
        try {
            $settings = SystemSetting::where('id', 1)->first();
            return view('admin.settings', compact('settings'));
        } catch (Throwable $e) {
            return redirect()->back()->with('error', trans('app.something_went_wrong'));
        }
    }

    /**
     * saveSettings
     *
     * @param  mixed $request
     * @return void
     */
    public function saveSettings(Request $request)
    {
        try {
            DB::beginTransaction();
            $settings = SystemSetting::where('id', 1)->first();
            if ($settings) {
                $settings->android_version = $request->android_version;
                $settings->android_force_update = (isset($request->android_force_update) ? 1 : 0);
                $settings->ios_version = $request->ios_version;
                $settings->ios_force_update = (isset($request->ios_force_update) ? 1 : 0);
                $settings->under_maintenance = (isset($request->under_maintenance) ? 1 : 0);
                $settings->save();

                DB::commit();
            }
            return redirect()->route('admin.settings')->with('success', trans('app.setting_saved_success'));
        } catch (Throwable $e) {
            report($e);
            DB::rollback();
            return redirect()->back()->with('error', trans('app.something_went_wrong'));
        }
    }

    /**
     * EditPageContent
     *
     * @return void
     */
    public function editPageContent()
    {
        try {
            $pagecontent = "";
            $page_title = Route::currentRouteName();
            $page_title = str_replace('admin.', '', $page_title);
            $file_name = $page_title;
            $file_name = str_replace('-&-', '-', $file_name) . '.txt';
            $page_title = str_replace('-', ' ', $page_title);
            $page_title = ucwords($page_title);

            if (Storage::exists($file_name)) {
                $pagecontent = Storage::get($file_name);
            } else {
                Storage::put($file_name, "");
            }

            return view('admin.edit-page', compact('pagecontent', 'page_title', 'file_name'));
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('error', trans('app.something_went_wrong'));
        }
    }

    /**
     * SavepageContent
     *
     * @param  mixed $request
     * @return void
     */
    public function savePageContent(Request $request)
    {
        try {
            if (Storage::exists($request->file_name)) {
                Storage::put($request->file_name, $request->page_content);
            } else {
                Storage::put($request->file_name, $request->page_content);
            }
            return redirect()->route('admin.dashboard')
                ->with('success', trans('app.page_content_save_success', ['page' => $request->page_title]));
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('error', trans('app.something_went_wrong'));
        }
    }
}
