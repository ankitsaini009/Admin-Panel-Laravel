<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Outstation_vehicle_booking;

class VehicleBookingController extends Controller
{
    public function index()
    {
        if (\request()->ajax()) {
            $data = Outstation_vehicle_booking::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('vehicle_booking.destroy', $row->id) . '"  class="btn btn-danger shadow btn-xs sharp" onclick="return confirm(\'Are You Sure Delete This?\')"><i class="fa fa-trash"></i></a>';
                    return $actionBtn;
                })->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.vehicle_booking.index');
    }

    public function vehicle_booking_destroy($id)
    {
        $userdata = Outstation_vehicle_booking::find($id);
        if (!$userdata) {

            return redirect()->back()->with('error', 'Vehicle Booking Not Found!');
        }

        $userdata->delete();
        return redirect()->back()->with('success', 'Vehicle Booking Delete successfully.');
    }
}
