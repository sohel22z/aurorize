<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\Contact;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminEnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $enquiries = Contact::orderBy('id', 'desc');
                return DataTables::of($enquiries)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '';
                        $btn .= '&nbsp;<a href="javascript:;" class="text-danger delete" data-id="' . $row->id . '" title="Delete"><i class="uil-trash-alt"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }

            return view('admin.enquiry.index');
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('error', trans('app.something_went_wrong'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = [
                'status' => false,
                'message' => trans('app.Enquiry_is_not_found'),
                'data' => null
            ];
            if ($request->ajax()) {
                $enquiry = Contact::where('id', $request->id)->first();

                if ($enquiry) {
                    $enquiry->delete();
                    DB::commit();
                    $data['message'] = trans('app.Enquiry_has_been_deleted');
                    $data['status'] = true;
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
}
