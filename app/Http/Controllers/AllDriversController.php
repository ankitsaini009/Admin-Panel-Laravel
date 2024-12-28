<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\Brand;
use App\Models\Setting_vehicle_type;
use App\Models\Car_model;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AllDriversController extends Controller
{

    public function index()
    {
        if (\request()->ajax()) {
            $data = Driver::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<div class="btn-group">
                        <button type="button" class="btn btn-info dropdown-toggle shadow btn-xs sharp" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-eye"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="' . route('drivers.approved') . '">Approved</a></li>
                            <li><a class="dropdown-item" href="' . route('drivers.details', $row->id) . '">Details</a></li>
                        </ul>
                    </div> 
                    <a href="' . route('all_drivers.edit', $row->id) . '" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a> <a href="' . route('all_drivers.destroy', $row->id) . '"  class="btn btn-danger shadow btn-xs sharp" onclick="return confirm(\'Are You Sure Delete This?\')"><i class="fa fa-trash"></i></a>';
                    return $actionBtn;
                })->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.drivers.index');
    }

    public function approved_drivers()
    {
        if (\request()->ajax()) {
            $data = Driver::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                    <div class="btn-group">
                        <button type="button" class="btn btn-info dropdown-toggle shadow btn-xs sharp" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-eye"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="' . route('drivers.approved') . '">Approved</a></li>
                            <li><a class="dropdown-item" href="' . route('drivers.details', $row->id) . '">Details</a></li>
                        </ul>
                    </div>
                    <a href="' . route('all_drivers.edit', $row->id) . '" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a> 
                    <a href="' . route('all_drivers.destroy', $row->id) . '" class="btn btn-danger shadow btn-xs sharp" onclick="return confirm(\'Are You Sure Delete This?\')"><i class="fa fa-trash"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.drivers.approved_drivers');
    }

    public function pending_drivers()
    {
        if (\request()->ajax()) {
            $data = Driver::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<div class="btn-group">
                        <button type="button" class="btn btn-info dropdown-toggle shadow btn-xs sharp" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-eye"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="' . route('drivers.approved') . '">Approved</a></li>
                            <li><a class="dropdown-item" href="' . route('drivers.details', $row->id) . '">Details</a></li>
                        </ul>
                    </div>
                     <a href="' . route('all_drivers.edit', $row->id) . '" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a> <a href="' . route('all_drivers.destroy', $row->id) . '"  class="btn btn-danger shadow btn-xs sharp" onclick="return confirm(\'Are You Sure Delete This?\')"><i class="fa fa-trash"></i></a>';
                    return $actionBtn;
                })->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.drivers.pending_drivers');
    }

    public function all_driversstore(Request $request)
    {
        //dd($request->all());

        if (isset($request->driver_id) && !empty($request->driver_id)) {
            $validator = Validator::make($request->all(), [
                'firstName' => 'required|string|max:255',
                'lastName' => 'required|string|max:255',
                'email' => 'required',
                'vehicleType' => 'required',
                'color' => 'required',
                'email' => 'required',
                'phone' => 'required|string|max:15',
                'status' => 'required|in:active,inactive',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $Driver = Driver::find($request->driver_id);
            $Driver->f_name = $request->firstName;
            $Driver->l_name = $request->lastName;
            $Driver->email = $request->email;
            $Driver->password = $request->password;
            $Driver->phone = $request->phone;
            $Driver->status = $request->status;
            $Driver->vehicle_type = $request->vehicleType;
            $Driver->brand = $request->brand;
            $Driver->model = $request->model;
            $Driver->KM = $request->km;
            $Driver->milage = $request->mileage;
            $Driver->numberplate = $request->numberPlate;
            $Driver->color = $request->color;
            $Driver->number_passenger = $request->passengers;
            $Driver->bank_name = $request->bank_name;
            $Driver->branch_name = $request->acount_number;
            $Driver->holder_name = $request->branch_name;
            $Driver->account_number = $request->holder_name;
            $Driver->IFSC_Code = $request->ifsc_code;
            $Driver->other_Information = $request->other_info;

            if ($request->hasFile('profileImage')) {
                $imageName = time() . '.' . $request->profileImage->extension();
                $request->profileImage->move(public_path('images'), $imageName);
                $Driver->image = $imageName;
            }

            $Driver->save();
            return redirect()->route('all_drivers.index')->with('success', 'Driver update successfully.');
        } else {
            $validator = Validator::make($request->all(), [
                'firstName' => 'required|string|max:255',
                'lastName' => 'required|string|max:255',
                'password' => 'required',
                'email' => 'required',
                'vehicleType' => 'required',
                'color' => 'required',
                'email' => 'required',
                'profileImage' => 'required',
                'phone' => 'required|string|max:15',
                'status' => 'required|in:active,inactive',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $Driver = new Driver();
            $Driver->f_name = $request->firstName;
            $Driver->l_name = $request->lastName;
            $Driver->email = $request->email;
            $Driver->password = $request->password;
            $Driver->phone = $request->phone;
            $Driver->status = $request->status;
            $Driver->vehicle_type = $request->vehicleType;
            $Driver->brand = $request->brand;
            $Driver->model = $request->model;
            $Driver->KM = $request->km;
            $Driver->milage = $request->mileage;
            $Driver->numberplate = $request->numberPlate;
            $Driver->color = $request->color;
            $Driver->number_passenger = $request->passengers;
            $Driver->bank_name = $request->bank_name;
            $Driver->branch_name = $request->acount_number;
            $Driver->holder_name = $request->branch_name;
            $Driver->account_number = $request->holder_name;
            $Driver->IFSC_Code = $request->ifsc_code;
            $Driver->other_Information = $request->other_info;

            if ($request->hasFile('profileImage')) {
                $imageName = time() . '.' . $request->profileImage->extension();
                $request->profileImage->move(public_path('images'), $imageName);
                $Driver->image = $imageName;
            }

            $Driver->save();

            return redirect()->route('all_drivers.index')->with('success', 'Driver created successfully.');
        }
    }

    public function all_driverscreate()
    {
        $vehicleTypes = Setting_vehicle_type::all();
        $brands = Brand::all();
        $carModels = Car_model::all();

        return view('admin.drivers.add', compact('vehicleTypes', 'brands', 'carModels'));
    }

    public function all_driversedit($id)
    {
        $DriverData = Driver::find($id);
        $vehicleTypes = Setting_vehicle_type::all();
        $brands = Brand::all();
        $carModels = Car_model::all();

        return view('admin.drivers.add', compact('DriverData', 'vehicleTypes', 'brands', 'carModels'));
    }

    public function driver_detals($id)
    {
        $DriverData = Driver::find($id);

        return view('admin.drivers.driver_detals', compact('DriverData'));
    }

    public function all_driversdstroy($id)
    {
        $userdata = Driver::find($id);
        if (!$userdata) {
            return redirect()->back()->with('error', 'Driver Not Found!');
        }
        $userdata->delete();
        return redirect()->back()->with('success', 'Driver Delete successfully.');
    }
}
