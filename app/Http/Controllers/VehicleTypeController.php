<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Setting_vehicle_type;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class VehicleTypeController extends Controller
{
    public function index()
    {
        if (\request()->ajax()) {
            $data = Setting_vehicle_type::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('vehicle_type.edit', $row->id) . '" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a> <a href="' . route('vehicle_type.destroy', $row->id) . '"  class="btn btn-danger shadow btn-xs sharp" onclick="return confirm(\'Are You Sure Delete This?\')"><i class="fa fa-trash"></i></a>';
                    return $actionBtn;
                })->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.vehicle_type.index');
    }

    public function vehicle_typestore(Request $request)
    {
        //dd($request->all());
        if (isset($request->Setting_vehicle_type_id) && !empty($request->Setting_vehicle_type_id)) {
            $validator = Validator::make($request->all(), [
                'Vehicle_Type' => 'required|string|max:255',
                'status' => 'required',
                'image' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $Setting_vehicle_type = Setting_vehicle_type::find($request->Setting_vehicle_type_id);
            $Setting_vehicle_type->Vehicle_Type = $request->Vehicle_Type;
            $Setting_vehicle_type->Status = $request->status;
            $Setting_vehicle_type->Delivery_Charge = $request->Delivery_Charge;
            $Setting_vehicle_type->Minimum_Delivery_Charge = $request->Minimum_Delivery_Charge;
            $Setting_vehicle_type->Minimum_Delivery_Charge_Within_KM = $request->Minimum_Delivery_Charge_Within_KM;

            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images'), $imageName);
                $Setting_vehicle_type->image = $imageName;
            }

            $Setting_vehicle_type->save();
            return redirect()->route('vehicle_type.index')->with('success', 'Vehicle Update successfully.');
        } else {
            $validator = Validator::make($request->all(), [
                'Vehicle_Type' => 'required|string|max:255',
                'status' => 'required',
                'image' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $Setting_vehicle_type = new Setting_vehicle_type();
            $Setting_vehicle_type->Vehicle_Type = $request->Vehicle_Type;
            $Setting_vehicle_type->Status = $request->status;
            $Setting_vehicle_type->Delivery_Charge = $request->Delivery_Charge;
            $Setting_vehicle_type->Minimum_Delivery_Charge = $request->Minimum_Delivery_Charge;
            $Setting_vehicle_type->Minimum_Delivery_Charge_Within_KM = $request->Minimum_Delivery_Charge_Within_KM;

            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images'), $imageName);
                $Setting_vehicle_type->image = $imageName;
            }
            $Setting_vehicle_type->save();
            return redirect()->route('vehicle_type.index')->with('success', 'Vehicle Created successfully.');
        }
    }

    public function vehicle_typecreate()
    {
        return view('admin.vehicle_type.add');
    }

    public function vehicle_typeedit($id)
    {
        $Setting_vehicle_type = Setting_vehicle_type::find($id);
        return view('admin.vehicle_type.add', compact('Setting_vehicle_type'));
    }

    public function vehicle_typedestroy($id)
    {
        $Setting_vehicle_type = Setting_vehicle_type::find($id);
        if (!$Setting_vehicle_type) {
            return redirect()->back()->with('error', 'Vehicle Not Found!');
        }

        $Setting_vehicle_type->delete();
        return redirect()->back()->with('success', 'Vehicle Delete successfully.');
    }
}
