<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CmsPages;
use DataTables, Validator, DB, DOMDocument;
use App\Helpers\Helper;

class AdminCMSController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
	}

	public function index(Request $request) {
        try {
            if ($request->ajax()) {
                $cms_pages = CmsPages::select('*')->orderBy('id', 'desc');
				// ->get();
                return Datatables::of($cms_pages)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('admin.cms.edit', ['id' => $row->id]) . '"  data-id="' . $row->id . '" class="text-success" title="Edit"><i class="uil-edit"></i></a>&nbsp;';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('admin.cms.index');
        } catch (Exception $e) {
            return redirect()->back()->with('error', trans('app.something_went_wrong'));
        }
	}

	public function edit($id) {
		$cms_page = CmsPages::select('*')->where('id', $id)->first();
		return view('admin.cms.edit-page', compact('cms_page'));
	}

	public function update(Request $request) {
		$data = array();
		DB::beginTransaction();
		try {
			$page_id = $request->page_id;
			$cms_page = CmsPages::select('*')->where('id', $page_id)->first();
			$cms_contents_arr = json_decode($cms_page->contents, true);

			$request_arr = $request->all();
			unset($request_arr['_token']);
			unset($request_arr['page_id']);
			$data = array_merge($cms_contents_arr, $request_arr);

			if(!empty($request_arr)){
				foreach ($request_arr as $key => $value) {
					if (strpos($key, 'image') !== false || strpos($key, 'banner') !== false) {
						if ($request->file($key) != "") {
							$image = $request->file($key);
							$old_image = $cms_contents_arr[$key];
                            $filename = "Img-" . date('YmdHis') . rand(1,100) . '.' . $image->getClientOriginalExtension();
                            Helper::uploadFile($image, config('constant.cms_page_url'), $filename, $old_image);
							$data[$key] = $filename;
						}
					} else if (strpos($key, 'banner') !== false) {
						if ($request->file($key) != "") {
							$image = $request->file($key);
							$old_image = $cms_contents_arr[$key];
                            $filename = "Banner-" . date('YmdHis') . rand(1,100) . '.' . $image->getClientOriginalExtension();
                            Helper::uploadFile($image, config('constant.cms_page_url'), $filename, $old_image);
							$data[$key] = $filename;
						}
					} else if (strpos($key, 'video') !== false) {
						if ($request->file($key) != "") {
							$image = $request->file($key);
							$old_image = $cms_contents_arr[$key];
                            $filename = 'VID-' . date('YmdHsi') . rand(10, 99) . '.' . $image->getClientOriginalExtension();
                            Helper::uploadFile($image, config('constant.cms_page_url'), $filename, $old_image);
							$data[$key] = $filename;
						}
					} else if (strpos($key, 'editor') !== false) {
						$htmlDom = new DOMDocument;
						$htmlDom->loadHTML($data[$key]);
						$imageTags = $htmlDom->getElementsByTagName('img');
						$extractedImages = array();
						if(!empty($imageTags)){
							foreach($imageTags as $imageTag){
								$imgSrc = $imageTag->getAttribute('src');
								$file = pathinfo($imgSrc);
								$filename = $file['basename'];
								Helper::copyFile(config('constant.temp_image_url'), config('constant.cms_page_url'), $filename);
							}
							$data[$key] = str_replace(config('constant.temp_image_url'), config('constant.cms_page_url'), $data[$key]);
						}
					}
				}
			}

			$cms_page->contents = json_encode($data);
			$cms_page->save();
			DB::commit();
            return redirect()->route('admin.cms.pages')->with('success', 'Page details updated successfully' );
		} catch (Exception $e) {
			DB::rollback();
            return redirect()->back()->with('error', trans('app.something_went_wrong') );
		}
	}

	public function uploadImage(Request $request) {
		$CKEditor = $request->CKEditor;
		$funcNum = $request->CKEditorFuncNum;
		$message = $url = '';
		if ($request->upload != '') {
			$file = $request->file('upload');
			if ($file->isValid()) {
				$filename = rand(1000, 9999) . $file->getClientOriginalName();
                $filePath = config('constant.cms_page_url') . $filename;
                Helper::uploadFile($file, config('constant.cms_page_url'));

				$url = Helper::assetFiles($filePath);
			} else {
				$message = 'An error occurred while uploading the file.';
			}
		} else {
			$message = 'No file uploaded.';
		}
		return '<script>window.parent.CKEDITOR.tools.callFunction(' . $funcNum . ', "' . $url . '", "' . $message . '")</script>';
	}
}
