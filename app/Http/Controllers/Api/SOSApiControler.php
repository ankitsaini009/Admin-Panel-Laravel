<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Sose;

class SOSApiControler extends Controller
{
    public function index()
    {

        $Rides = Sose::all();

        try {
            if (is_null($Rides)) {

                return response()->json(['message' => 'SOS Not Found!', 'status' => 0,]);
            } else {
                return response()->json(['message' => 'SOS Found!', 'status' => 1, 'data' => $Rides]);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function StoreSOS(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'ride_id' => 'required',
            'user_name' => 'required',
            'driver_name' => 'required',
            'status' => 'required',
        ]);

        try {

            if ($validator->fails()) {
                return response()->json(['message' => 'SOS Error!', 'errors' => $validator->errors()], 400);
            } else {

                Sose::Create($validator->validate());

                return response()->json(['message' => 'SOS Add SuccessFully!', 'status' => 1,]);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function UpdateSOS(Request $request, $id)
    {
        try {
            if (!empty($request->all())) {
                if (is_null($id)) {
                    return response()->json(['message' => 'SOS Id Error!', 'status' => 0]);
                }
                $All_ride = Sose::find($id);
                if (is_null($All_ride)) {
                    return response()->json(['message' => 'SOS Ride Not Found!', "status" => 0]);
                } else {
                    $All_ride->update($request->all());
                    return response()->json(['message' => 'SOS Ride Update SuccessFully', 'status' => 1]);
                }
            } else {

                return response()->json(['message' => 'Plese Fill Update Data', "status" => 0]);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function DeleteSOS($id)
    {
        try {
            $All_ride = Sose::find($id);
            if (!is_null($All_ride)) {
                $All_ride->delete();
                return response()->json(['message' => "SOS Delete SuccessFully!", 'status' => 1]);
            } else {
                return response()->json(['message' => 'SOS Note Found!', 'status' => 0]);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }
}
