<?php

namespace App\Http\Controllers\APi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Outstation_vehicle_booking;

class VehicleBookingController extends Controller
{
    public function index()
    {

        $Rides = Outstation_vehicle_booking::all();

        try {
            if (is_null($Rides)) {

                return response()->json(['message' => 'Vehicle Booking Not Found!', 'status' => 0,]);
            } else {
                return response()->json(['message' => 'Vehicle Booking Found!', 'status' => 1, 'data' => $Rides]);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function Store(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'Vehicle_Type' => 'required',
            'Customer' => 'required',
            'Days' => 'required',
            'Start_Date' => 'required',
            'End_Date' => 'required',
            'Status' => 'required',
        ]);

        try {

            if ($validator->fails()) {
                return response()->json(['message' => 'Vehicle Booking Error!', 'errors' => $validator->errors()], 400);
            } else {

                Outstation_vehicle_booking::Create($validator->validate());

                return response()->json(['message' => 'Vehicle Booking Add SuccessFully!', 'status' => 1,]);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function Update(Request $request, $id)
    {
        try {
            if (!empty($request->all())) {
                if (is_null($id)) {
                    return response()->json(['message' => 'Vehicle Booking Id Error!', 'status' => 0]);
                }
                $All_ride = Outstation_vehicle_booking::find($id);
                if (is_null($All_ride)) {
                    return response()->json(['message' => 'Vehicle Booking Not Found!', "status" => 0]);
                } else {
                    $All_ride->update($request->all());
                    return response()->json(['message' => 'Vehicle Booking Update SuccessFully', 'status' => 1]);
                }
            } else {

                return response()->json(['message' => 'Plese Fill Update Data', "status" => 0]);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function Delete($id)
    {
        try {
            $All_ride = Outstation_vehicle_booking::find($id);
            if (!is_null($All_ride)) {
                $All_ride->delete();
                return response()->json(['message' => "Vehicle Booking Delete SuccessFully!", 'status' => 1]);
            } else {
                return response()->json(['message' => 'Vehicle Booking Note Found!', 'status' => 0]);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }
}
