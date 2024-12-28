<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Complaint;

class ComplaintsController extends Controller
{
    public function index()
    {
        if (\request()->ajax()) {
            $data = Complaint::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('complaints.destroy', $row->id) . '"  class="btn btn-danger shadow btn-xs sharp" onclick="return confirm(\'Are You Sure Delete This?\')"><i class="fa fa-trash"></i></a>';
                    return $actionBtn;
                })->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.complaints.index');
    }

    public function complaints_destroy($id)
    {
        $userdata = Complaint::find($id);
        if (!$userdata) {
            return redirect()->back()->with('error', 'Complaint Not Found!');
        }
        $userdata->delete();
        return redirect()->back()->with('success', 'Complaint Delete successfully.');
    }
}
