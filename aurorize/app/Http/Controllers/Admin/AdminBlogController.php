<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\Blog;
use App\Helpers\Helper;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class AdminBlogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Index
     *
     * @param  mixed $request
     * @return void
     */
    public function index(Request $request)
    {
        try {
            return view('admin.blog.index');
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('error', trans('app.something_went_wrong'));
        }
    }

    public function getBlog()
    {
        try {
            $blog = Blog::orderBy('id', 'desc');
            return DataTables::of($blog)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('admin.blogs.edit', ['blog' => $row->id]) . '"  data-id="' . $row->id . '" class="text-primary" title="Edit"><i class="uil-edit"></i></a>&nbsp;';
                    $btn .= '&nbsp;<a href="javascript:;" class="text-danger delete" data-id="' . $row->id . '" title="Delete"><i class="uil-trash-alt"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        } catch (Throwable $e) {
            report($e);
            return response()->json()->with('error', trans('app.something_went_wrong'));
        }
    }

    /**
     * Create
     *
     * @return void
     */
    public function create()
    {
        try {
            return view('admin.blog.add-blog');
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('error', trans('app.something_went_wrong'));
        }
    }

    /**
     * Store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make(
                $request->all(),
                [
                    'title' => ['required', 'string', 'max:255', 'unique:blogs,title,NULL,id,deleted_at,NULL'],
                    'image' => 'required',
                    'description' => 'required',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $description = Helper::replaceImagePath($request->description, config('constant.cms_page_url'));
            $slug = Helper::createSlug([Str::slug($request->title)], NULL, "blog");
            $blog_image = null;

            if ($request->file('image') != "") {
                $image = $request->file('image');
                $blog_image = "Img-" . date('YmdHis') . mt_rand(1, 100) . '.' . $image->getClientOriginalExtension();
                Helper::uploadFile($image, config('constant.blog_url'), $blog_image);
            }
            $data = [
                'title' => $request->title,
                'description' => $description,
                'image' => $blog_image,
                'slug' => $slug
            ];
            $blog = Blog::create($data);

            if ($blog) {
                DB::commit();
                return redirect()->route('admin.blogs.index')->with('success', trans('app.Blog_has_been_added'));
            } else {
                DB::rollback();
                return redirect()->back()
                    ->withInput()
                    ->with('error', trans('app.something_went_wrong'));
            }
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()
                ->withInput()
                ->with('error', trans('app.something_went_wrong'));
        }
    }

    /**
     * Edit
     *
     * @param  mixed $id
     * @return void
     */
    public function edit($id)
    {
        try {
            if (is_null($id)) {
                return redirect()->back()->with('error', trans('app.something_went_wrong'));
            }
            $blog = Blog::where('id', $id)->first();
            if (empty($blog)) {
                return redirect()->route('admin.blogs.index')->with('error', trans('app.Blog_is_not_found'));
            }
            return view('admin.blog.add-blog', compact('blog'));
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('error', trans('app.something_went_wrong'));
        }
    }

    /**
     * Update
     *
     * @param  mixed $request
     * @return void
     */
    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make(
                $request->all(),
                [
                    'title' => ['required', 'string', 'max:255', 'unique:blogs,title,' . $request->id . ',id,deleted_at,NULL'],
                    // 'image' => 'required',
                    'description' => 'required',
                ]
            );
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $description = Helper::replaceImagePath($request->description, config('constant.cms_page_url'));
            $slug = Helper::createSlug([Str::slug($request->title)], $request->id, "blog");

            $blog_image = "";
            if ($request->file('image') != "") {
                $image = $request->file('image');
                $blog_image = "Img-" . date('YmdHis') . rand(1, 100) . '.' . $image->getClientOriginalExtension();
                Helper::uploadFile($image, config('constant.blog_url'), $blog_image, $request->old_blog_image);
            }
            $data = [
                'title' => $request->title,
                'description' => $description,
                'slug' => $slug
            ];

            if ($blog_image != '') {
                $data['image'] = $blog_image;
            }
            $blog = Blog::where('id', $request->id)->update($data);
            if ($blog) {
                DB::commit();
                return redirect()->route('admin.blogs.index')->with('success', trans('app.Blog_has_been_updated'));
            } else {
                DB::rollback();
                return redirect()->back()
                    ->withInput()
                    ->with('error', trans('app.something_went_wrong'));
            }
        } catch (Throwable $e) {
            DB::rollback();
            report($e);
            return redirect()->back()
                ->withInput()
                ->with('error', trans('app.something_went_wrong'));
        }
    }

    /**
     * Delete
     *
     * @param  mixed $request
     * @return void
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $data = [
                'status' => false,
                'message' => trans('app.Blog_is_not_found'),
                'data' => null
            ];
            $blog = Blog::where('id', $id)->first();
            if ($blog) {
                Helper::deleteFile(config('constant.blog_url'), $blog->image);
                $blog->delete();
                $data['message'] = trans('app.Blog_has_been_deleted');
                $data['status'] = true;
                DB::commit();
            }

            return response()->json($data, 200);
        } catch (Throwable $e) {
            DB::rollback();
            report($e);
            return response()->json(
                [
                    'status' => false,
                    'message' => trans('app.something_went_wrong'),
                    'data' => null
                ],
                400
            );
        }
    }

    /**
     * Exists
     *
     * @param  mixed $request
     * @return void
     */
    public function exists(Request $request)
    {
        try {
            $exists = Blog::where('title', $request->title);
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
}
