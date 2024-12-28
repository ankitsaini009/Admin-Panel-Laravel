<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle_type;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class VehicleController extends Controller
{
    public function index()
    {
        if (\request()->ajax()) {
            $data = Vehicle_type::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('vehicle.edit', $row->id) . '" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a> <a href="' . route('vehicle.destroy', $row->id) . '"  class="btn btn-danger shadow btn-xs sharp" onclick="return confirm(\'Are You Sure Delete This?\')"><i class="fa fa-trash"></i></a>';
                    return $actionBtn;
                })->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.vehicle-rental-type.index');
    }

    public function vehiclestore(Request $request)
    {
        //dd($request->all());

        if (isset($request->Vehicle_id) && !empty($request->Vehicle_id)) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'Par_Day_Price' => 'required',
                'Vehicle_Type' => 'required',
                'status' => 'required|in:active,inactive',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $Vehicle_type = Vehicle_type::find($request->Vehicle_id);
            $Vehicle_type->Name = $request->name;
            $Vehicle_type->Par_Day_Price = $request->Par_Day_Price;
            $Vehicle_type->Number_Of_Passenger = $request->Number_Of_Passenger;
            $Vehicle_type->status = $request->status;
            $Vehicle_type->Vehicle_Type = $request->Vehicle_Type;
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images'), $imageName);
                $Vehicle_type->image = $imageName;
            }

            $Vehicle_type->save();
            return redirect()->route('vehicle.index')->with('success', 'Vehicle update successfully.');
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'Par_Day_Price' => 'required',
                'Vehicle_Type' => 'required',
                'status' => 'required|in:active,inactive',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $Vehicle_type = new Vehicle_type();
            $Vehicle_type->Name = $request->name;
            $Vehicle_type->Par_Day_Price = $request->Par_Day_Price;
            $Vehicle_type->Number_Of_Passenger = $request->Number_Of_Passenger;
            $Vehicle_type->status = $request->status;
            $Vehicle_type->Vehicle_Type = $request->Vehicle_Type;

            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images'), $imageName);
                $Vehicle_type->image = $imageName;
            }

            $Vehicle_type->save();
            return redirect()->route('vehicle.index')->with('success', 'Vehicle created successfully.');
        }
    }

    public function vehiclecreate()
    {
        return view('admin.vehicle-rental-type.add');
    }

    public function vehicleedit($id)
    {
        $Vehicle_type = Vehicle_type::find($id);
        return view('admin.vehicle-rental-type.add', compact('Vehicle_type'));
    }

    public function vehicleestroy($id)
    {
        $userdata = Vehicle_type::find($id);
        if (!$userdata) {
            return redirect()->back()->with('error', 'Vehicle Not Found!');
        }
        $userdata->delete();
        return redirect()->back()->with('success', 'Vehicle Delete successfully.');
    }
}
