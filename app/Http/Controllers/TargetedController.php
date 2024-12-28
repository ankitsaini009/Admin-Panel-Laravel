<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Targeted_ride;
use App\Models\Targeted_rides_daily;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;

class TargetedController extends Controller
{
    public function index()
    {
        if (\request()->ajax()) {
            $data = Targeted_ride::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('targeted.edit', $row->id) . '" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a> <a href="' . route('targeted.destroy', $row->id) . '"  class="btn btn-danger shadow btn-xs sharp" onclick="return confirm(\'Are You Sure Delete This?\')"><i class="fa fa-trash"></i></a>';
                    return $actionBtn;
                })->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.targeted_rides.index');
    }

    public function targetedstore(Request $request)
    {
        //dd($request->all());

        if (isset($request->targeted_id) && !empty($request->targeted_id)) {
            $Targeted_ride = Validator::make($request->all(), [
                'Start_Date' => 'required',
                'End_Date' => 'required',
            ]);

            if ($Targeted_ride->fails()) {
                return redirect()->back()->withErrors($Targeted_ride)->withInput();
            }
            $Targeted_ride = Targeted_ride::find($request->targeted_id);
            $Targeted_ride->Start_Date = $request->Start_Date;
            $Targeted_ride->End_Date = $request->End_Date;
            $Targeted_ride->Short_Description = $request->Short_Description;
            $Targeted_ride->Enabled = $request->Enabled;
            $Targeted_ride->save();

            $dailyRides = $request->input('Daily_Rides');
            $incentives = $request->input('Incentive');

            if ($dailyRides && $incentives) {
                foreach ($dailyRides as $key => $dailyRide) {
                    if (isset($incentives[$key])) {

                        $existingRide = Targeted_rides_daily::where('targeted_rides_id', $request->targeted_id)
                            ->where('Daily_Rides', $dailyRide)
                            ->first();

                        if ($existingRide) {
                            $existingRide->Incentive = $incentives[$key];
                            $existingRide->save();
                        } else {
                            Targeted_rides_daily::create([
                                'Daily_Rides' => $dailyRide,
                                'targeted_rides_id' => $request->targeted_id,
                                'Incentive' => $incentives[$key],
                            ]);
                        }
                    }
                }
            }
            return redirect()->route('targeted.index')->with('success', 'Targeted_ride update successfully.');
        } else {

            $Targeted_ride = Validator::make($request->all(), [
                'Start_Date' => 'required',
                'End_Date' => 'required',
            ]);

            if ($Targeted_ride->fails()) {
                return redirect()->back()->withErrors($Targeted_ride)->withInput();
            }

            $Targeted_ride = new Targeted_ride();
            $Targeted_ride->Start_Date = $request->Start_Date;
            $Targeted_ride->End_Date = $request->End_Date;
            $Targeted_ride->Short_Description = $request->Short_Description;
            $Targeted_ride->Enabled = $request->Enabled;
            $Targeted_ride->save();

            $lastInsertedId = $Targeted_ride->id;
            $dailyRides = $request->input('Daily_Rides');
            $incentives = $request->input('Incentive');

            if ($dailyRides && $incentives) {
                foreach ($dailyRides as $key => $dailyRide) {
                    if (isset($incentives[$key])) {
                        Targeted_rides_daily::create([
                            'Daily_Rides' => $dailyRide,
                            'targeted_rides_id' => $lastInsertedId,
                            'Incentive' => $incentives[$key],
                        ]);
                    }
                }
            }

            return redirect()->route('targeted.index')->with('success', 'Targeted_ride created successfully.');
        }
    }

    public function targetedcreate()
    {
        return view('admin.targeted_rides.add');
    }

    public function targetededit($id)
    {
        $Targeted_ride = Targeted_ride::find($id);
        $Targeted_rides_daily = Targeted_rides_daily::where('targeted_rides_id', $id)->get();
        return view('admin.targeted_rides.add', compact('Targeted_ride', 'Targeted_rides_daily'));
    }

    public function targeteddestroy($id)
    {
        $Prominent_rlace_ridedata = Targeted_ride::find($id);
        if (!$Prominent_rlace_ridedata) {
            return redirect()->back()->with('error', 'Targeted_ride Not Found!');
        }
        $Prominent_rlace_ridedata->delete();
        return redirect()->back()->with('success', 'Targeted_ride Delete successfully.');
    }

    public function delete_targeted($id)
    {
        $Ride = Targeted_rides_daily::find($id);
        if (!$Ride) {
            return redirect()->back();
        }
        $Ride->delete();
        return redirect()->back();
    }
}
