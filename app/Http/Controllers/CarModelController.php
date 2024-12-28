<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car_model;
use App\Models\Setting_vehicle_type;
use App\Models\Brand;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CarModelController extends Controller
{

    public function index()
    {
        if (\request()->ajax()) {
            $data = Car_model::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('car_model.edit', $row->id) . '" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a> <a href="' . route('car_model.destroy', $row->id) . '"  class="btn btn-danger shadow btn-xs sharp" onclick="return confirm(\'Are You Sure Delete This?\')"><i class="fa fa-trash"></i></a>';
                    return $actionBtn;
                })->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.car_models.index');
    }

    public function car_modelstore(Request $request)
    {
        //dd($request->all());
        if (isset($request->car_model_id) && !empty($request->car_model_id)) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'Brand' => 'required',
                'Vehicle_Type' => 'required',
                'status' => 'required|in:active,inactive',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $Car_model = Car_model::find($request->car_model_id);
            $Car_model->Name = $request->name;
            $Car_model->Brand = $request->Brand;
            $Car_model->Vehicle_Type = $request->Vehicle_Type;
            $Car_model->Status = $request->status;
            $Car_model->save();
            return redirect()->route('car_model.index')->with('success', 'Car Model update successfully.');
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'Brand' => 'required',
                'Vehicle_Type' => 'required',
                'status' => 'required|in:active,inactive',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $Car_model = new Car_model();
            $Car_model->Name = $request->name;
            $Car_model->Brand = $request->Brand;
            $Car_model->Vehicle_Type = $request->Vehicle_Type;
            $Car_model->Status = $request->status;
            $Car_model->save();
            return redirect()->route('car_model.index')->with('success', 'Car Model created successfully.');
        }
    }

    public function car_modelcreate()
    {
        $brands = Brand::all();

        $vehicleTypes = Setting_vehicle_type::all();

        return view('admin.car_models.add', compact('brands', 'vehicleTypes'));
    }

    public function car_modeledit($id)
    {
        $brands = Brand::all();

        $vehicleTypes = Setting_vehicle_type::all();

        $Car_model = Car_model::find($id);

        return view('admin.car_models.add', compact('Car_model', 'brands', 'vehicleTypes'));
    }

    public function car_modedestroy($id)
    {
        $userdata = Car_model::find($id);
        if (!$userdata) {
            return redirect()->back()->with('error', 'Car Model Not Found!');
        }
        $userdata->delete();
        return redirect()->back()->with('success', 'Car Model Delete successfully.');
    }
}
