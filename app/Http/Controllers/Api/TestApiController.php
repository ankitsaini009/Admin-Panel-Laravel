<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Liveuser;
use App\Models\Complaint;
use finfo;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class TestApiController extends Controller
{
    public function index()
    {
        $Complaint = Complaint::all();
        try {
            if (is_null($Complaint)) {
                return response()->json(['message' => 'Complaint Not Found!', 'status' => 0,]);
            } else {
                return response()->json(['message' => 'Complaint Found!', 'status' => 1, 'data' => $Complaint]);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function storedata(Request $request)
    {
        $validator  = Validator::make($request->all(), [
            'drivers' => 'required',
            'user_name' => 'required',
            'title' => 'required',
            'message' => 'required',
        ]);

        try {

            if ($validator->fails()) {
                return response()->json(['message' => 'Velidetio Error!', 'errors' => $validator->errors()], 400);
            } else {

                Complaint::Create($validator->validate());

                return response()->json(['message' => 'Complaint Add SuccessFully!', 'status' => 1,]);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function update_complaints(Request $request, $id)
    {
        try {
            if (!empty($request->all())) {
                if (is_null($id)) {
                    return response()->json(['message' => 'Complaint Id Error!', 'status' => 0]);
                }
                $Complaint = Complaint::find($id);
                if (is_null($Complaint)) {
                    return response()->json(['message' => 'Complent Not Found!', "status" => 0]);
                } else {
                    $Complaint->update($request->all());
                    return response()->json(['message' => 'Complent Update SuccessFully', 'status' => 1]);
                }
            } else {

                return response()->json(['message' => 'Plese Fill Update Data', "status" => 0]);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function Complaints_delete($id)
    {
        try {
            $Complaint = Complaint::find($id);
            if (!is_null($Complaint)) {
                $Complaint->delete();
                return response()->json(['message' => "Complent Delete SuccessFully!", 'status' => 1]);
            } else {
                return response()->json(['message' => 'Complent Note Found!', 'status' => 0]);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }
}
