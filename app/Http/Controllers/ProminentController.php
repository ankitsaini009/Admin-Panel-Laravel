<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Prominent_rlace_ride;
use App\Models\Ride;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;

class ProminentController extends Controller
{
    public function index()
    {
        if (\request()->ajax()) {
            $data = Prominent_rlace_ride::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('prominent.edit', $row->id) . '" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a> <a href="' . route('prominent.destroy', $row->id) . '"  class="btn btn-danger shadow btn-xs sharp" onclick="return confirm(\'Are You Sure Delete This?\')"><i class="fa fa-trash"></i></a>';
                    return $actionBtn;
                })->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.prominent_place_rides.index');
    }

    public function prominentstore(Request $request)
    {
        //dd($request->all());

        if (isset($request->prominent_id) && !empty($request->prominent_id)) {
            $Prominent_rlace_ride = Validator::make($request->all(), [
                'Address' => 'required',
                'Latitude' => 'required',
                'Longitude' => 'required|string|max:15',
                'Start_Date' => 'required',
                'Start_Date' => 'required',
                'End_Date' => 'required',
            ]);

            if ($Prominent_rlace_ride->fails()) {
                return redirect()->back()->withErrors($Prominent_rlace_ride)->withInput();
            }
            $Prominent_rlace_ride = Prominent_rlace_ride::find($request->prominent_id);
            $Prominent_rlace_ride->Address = $request->Address;
            $Prominent_rlace_ride->Latitude = $request->Latitude;
            $Prominent_rlace_ride->Longitude = $request->Longitude;
            $Prominent_rlace_ride->Start_Date = $request->Start_Date;
            $Prominent_rlace_ride->End_Date = $request->End_Date;
            $Prominent_rlace_ride->Short_Description = $request->Short_Description;
            $Prominent_rlace_ride->Radius = $request->Radius;
            $Prominent_rlace_ride->Enabled = $request->Enabled;
            $Prominent_rlace_ride->save();

            $dailyRides = $request->input('Daily_Rides');
            $incentives = $request->input('Incentive');

            if ($dailyRides && $incentives) {
                foreach ($dailyRides as $key => $dailyRide) {
                    if (isset($incentives[$key])) {

                        $existingRide = Ride::where('prominent_id', $request->prominent_id)
                            ->where('Daily_Rides', $dailyRide)
                            ->first();

                        if ($existingRide) {
                            $existingRide->Incentive = $incentives[$key];
                            $existingRide->save();
                        } else {
                            Ride::create([
                                'Daily_Rides' => $dailyRide,
                                'prominent_id' => $request->prominent_id,
                                'Incentive' => $incentives[$key],
                            ]);
                        }
                    }
                }
            }
            return redirect()->route('prominent.index')->with('success', 'Prominent Place Rides update successfully.');
        } else {

            $Prominent_rlace_ride = Validator::make($request->all(), [
                'Address' => 'required',
                'Latitude' => 'required',
                'Longitude' => 'required|string|max:15',
                'Start_Date' => 'required',
                'Start_Date' => 'required',
                'End_Date' => 'required',
            ]);

            if ($Prominent_rlace_ride->fails()) {
                return redirect()->back()->withErrors($Prominent_rlace_ride)->withInput();
            }

            $Prominent_rlace_ride = new Prominent_rlace_ride();
            $Prominent_rlace_ride->Address = $request->Address;
            $Prominent_rlace_ride->Latitude = $request->Latitude;
            $Prominent_rlace_ride->Longitude = $request->Longitude;
            $Prominent_rlace_ride->Start_Date = $request->Start_Date;
            $Prominent_rlace_ride->End_Date = $request->End_Date;
            $Prominent_rlace_ride->Short_Description = $request->Short_Description;
            $Prominent_rlace_ride->Radius = $request->Radius;
            $Prominent_rlace_ride->Enabled = $request->Enabled;
            $Prominent_rlace_ride->save();

            $lastInsertedId = $Prominent_rlace_ride->id;
            $dailyRides = $request->input('Daily_Rides');
            $incentives = $request->input('Incentive');

            if ($dailyRides && $incentives) {
                foreach ($dailyRides as $key => $dailyRide) {
                    if (isset($incentives[$key])) {
                        Ride::create([
                            'Daily_Rides' => $dailyRide,
                            'prominent_id' => $lastInsertedId,
                            'Incentive' => $incentives[$key],
                        ]);
                    }
                }
            }

            return redirect()->route('prominent.index')->with('success', 'Prominent Place Rides created successfully.');
        }
    }

    public function prominentcreate()
    {
        return view('admin.prominent_place_rides.add');
    }

    public function prominentedit($id)
    {
        $Prominent_rlace_ridedata = Prominent_rlace_ride::find($id);
        $Ride = Ride::where('prominent_id', $id)->get();
        return view('admin.prominent_place_rides.add', compact('Prominent_rlace_ridedata', 'Ride'));
    }

    public function prominentdestroy($id)
    {
        $Prominent_rlace_ridedata = Prominent_rlace_ride::find($id);
        if (!$Prominent_rlace_ridedata) {
            return redirect()->back()->with('error', 'Prominent Place Rides Not Found!');
        }
        $Prominent_rlace_ridedata->delete();
        return redirect()->back()->with('success', 'Prominent Place Rides Delete successfully.');
    }

    public function delete_ride($id)
    {
        $Ride = Ride::find($id);
        if (!$Ride) {
            return redirect()->back();
        }
        $Ride->delete();
        return redirect()->back();
    }
}
