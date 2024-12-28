<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Liveuser;
use Illuminate\Support\Facades\Validator;

class UserApiController extends Controller
{
    public function index()
    {

        $Liveuser = Liveuser::all();

        try {
            if (is_null($Liveuser)) {

                return response()->json(['message' => 'Users Not Found!', 'status' => 0,]);
            } else {
                return response()->json(['message' => 'Users Found!', 'status' => 1, 'data' => $Liveuser]);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function Storeusers(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required',
            'phone' => 'required',
            'status' => 'required',
        ]);

        try {

            if ($validator->fails()) {
                return response()->json(['message' => 'User Error!', 'errors' => $validator->errors()], 400);
            } else {

                Liveuser::Create($validator->validate());

                return response()->json(['message' => 'User Add SuccessFully!', 'status' => 1,]);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }
}
