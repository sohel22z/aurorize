<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\FAQs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;


class AdminFAQsController extends Controller
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
            if ($request->ajax()) {
                $FAQs = FAQs::orderBy('id', 'desc');
                // ->get();
                return DataTables::of($FAQs)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('admin.faqs.edit', ['id' => $row->id]) . '"  data-id="' . $row->id . '" class="text-success" title="Edit"><i class="uil-edit"></i></a>&nbsp;';
                        $btn .= '&nbsp;<a href="javascript:;" class="text-danger delete" data-id="' . $row->id . '" title="Delete"><i class="uil-trash-alt"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('admin.FAQs.index');
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('error', trans('app.something_went_wrong'));
        }
    }

    /**
     * Create
     *
     * @return void
     */
    public function create()
    {
        return view('admin.FAQs.add-faqs');
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
                    'question' => 'required',
                    'answer' => 'required',
                ]
            );
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = [
                'question' => $request->question,
                'answer' => $request->answer,
            ];
            $FAQs = FAQs::create($data);

            if ($FAQs) {
                DB::commit();
                return redirect()->route('admin.faqs')->with('success', trans('app.FAQ_has_been_added'));
            } else {
                DB::rollback();
                return redirect()->back()
                    ->withInput()
                    ->with('error', trans('app.something_went_wrong'));
            }
        } catch (Throwable $e) {
            report($e);
            DB::rollback();
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
        $FAQs = FAQs::select('*')
            ->where('id', $id)
            ->first();
        return view('admin.FAQs.add-faqs', compact('FAQs'));
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
                    'question' => 'required',
                    'answer' => 'required',
                ]
            );
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $data = [
                'question' => $request->question,
                'answer' => $request->answer
            ];
            $FAQs = FAQs::where('id', $request->id)->update($data);

            if ($FAQs) {
                DB::commit();
                return redirect()->route('admin.faqs')->with('success', trans('app.FAQ_has_been_updated'));
            } else {
                DB::rollback();
                return redirect()->back()
                    ->withInput()
                    ->with('error', trans('app.something_went_wrong'));
            }
        } catch (Throwable $e) {
            report($e);
            DB::rollback();
            return redirect()->back()
                ->withInput()
                ->with('error', trans('app.something_went_wrong'));
        }
        return redirect()->route('FAQs');
    }

    /**
     * Delete
     *
     * @param  mixed $request
     * @return void
     */
    public function delete(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = [
                'status' => false,
                'message' => trans('app.FAQ_is_not_found'),
                'data' => null
            ];
            if ($request->ajax()) {
                $faq = FAQs::where('id', $request->id)->first();

                if ($faq) {
                    $faq->delete();
                    $data['message'] = trans('app.FAQ_has_been_deleted');
                    $data['status'] = true;
                    DB::commit();
                }
            }
            DB::rollback();
            return response()->json($data, 200);
        } catch (Throwable $e) {
            report($e);
            DB::rollback();
            return response()->json(
                [
                    'is_success' => false,
                    'error' => trans('app.something_went_wrong')
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
            $exists = FAQs::where('question', $request->question);
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
