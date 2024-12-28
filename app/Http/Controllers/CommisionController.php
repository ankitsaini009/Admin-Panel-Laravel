<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin_commision;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CommisionController extends Controller
{
    public function index()
    {
        $Admin_commision = Admin_commision::orderBy('id', 'desc')->first();
        return view('admin.commision.add', compact('Admin_commision'));
    }


    public function commissionstore(Request $request)
    {
        //dd($request->all());

        if (isset($request->commission_id) && !empty($request->commission_id)) {

            // $validator = Validator::make($request->all(), [
            //     'name' => 'required|string|max:255',
            //     'email' => 'required',
            //     'phone' => 'required|string|max:15',
            //     'status' => 'required|in:active,inactive',
            // ]);

            // if ($validator->fails()) {
            //     return redirect()->back()->withErrors($validator)->withInput();
            // }

            $Admin_commision = Admin_commision::find($request->commission_id);
            $Admin_commision->Enable = $request->enable;
            $Admin_commision->admin_commission = $request->admin_commission;
            $Admin_commision->commission_type = $request->commission_type;
            if ($Admin_commision->save()) {

                return redirect()->route('commission.index')->with('success', 'Commission Save successfully.');
            } else {
                die('A Error Plese Check');
            }
        }
    }
}
