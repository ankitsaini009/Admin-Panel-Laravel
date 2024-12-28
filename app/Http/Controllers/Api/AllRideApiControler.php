<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\All_ride;

class AllRideApiControler extends Controller
{
    public function index()
    {

        $Rides = All_ride::all();

        try {
            if (is_null($Rides)) {

                return response()->json(['message' => 'All Rides Not Found!', 'status' => 0,]);
            } else {
                return response()->json(['message' => 'All Rides Found!', 'status' => 1, 'data' => $Rides]);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function StoreRide(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'ride_id' => 'required',
            'user_name' => 'required',
            'driver_name' => 'required',
            'amount' => 'required',
            'ride_type' => 'required',
            'status' => 'required',
        ]);

        try {

            if ($validator->fails()) {
                return response()->json(['message' => 'Ride Error!', 'errors' => $validator->errors()], 400);
            } else {

                All_ride::Create($validator->validate());

                return response()->json(['message' => 'Ride Add SuccessFully!', 'status' => 1,]);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }
    public function UpdateRide(Request $request, $id)
    {
        try {
            if (!empty($request->all())) {
                if (is_null($id)) {
                    return response()->json(['message' => 'Ride Id Error!', 'status' => 0]);
                }
                $All_ride = All_ride::find($id);
                if (is_null($All_ride)) {
                    return response()->json(['message' => 'All Ride Not Found!', "status" => 0]);
                } else {
                    $All_ride->update($request->all());
                    return response()->json(['message' => 'All Ride Update SuccessFully', 'status' => 1]);
                }
            } else {

                return response()->json(['message' => 'Plese Fill Update Data', "status" => 0]);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function DeleteRide($id)
    {
        try {
            $All_ride = All_ride::find($id);
            if (!is_null($All_ride)) {
                $All_ride->delete();
                return response()->json(['message' => "Ride Delete SuccessFully!", 'status' => 1]);
            } else {
                return response()->json(['message' => 'Ride Note Found!', 'status' => 0]);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }
}
