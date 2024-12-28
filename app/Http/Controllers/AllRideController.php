<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\All_ride;

class AllRideController extends Controller
{
    public function index()
    {
        if (\request()->ajax()) {
            $data = All_ride::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('allRide.destroy', $row->id) . '"  class="btn btn-danger shadow btn-xs sharp" onclick="return confirm(\'Are You Sure Delete This?\')"><i class="fa fa-trash"></i></a>';
                    return $actionBtn;
                })->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.allRides.index');
    }

    public function allRide_destroy($id)
    {
        $userdata = All_ride::find($id);
        if (!$userdata) {
            return redirect()->back()->with('error', 'Ride Not Found!');
        }
        $userdata->delete();
        return redirect()->back()->with('success', 'Ride Delete successfully.');
    }
}
