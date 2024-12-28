<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Sose;

class SOSController extends Controller
{
    public function index()
    {
        if (\request()->ajax()) {
            $data = Sose::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('sos.destroy', $row->id) . '"  class="btn btn-danger shadow btn-xs sharp" onclick="return confirm(\'Are You Sure Delete This?\')"><i class="fa fa-trash"></i></a>';
                    return $actionBtn;
                })->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.SOS.index');
    }

    public function sos_destroy($id)
    {
        $userdata = Sose::find($id);
        if (!$userdata) {
            return redirect()->back()->with('error', 'SOS Not Found!');
        }
        $userdata->delete();
        return redirect()->back()->with('success', 'SOS Delete successfully.');
    }
}
