<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tax_setting;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserReportController extends Controller
{
    public function index()
    {
        return view('admin.userreport.add');
    }


    public function userreportstore(Request $request)
    {
        dd($request->all());

        if (isset($request->tax_id) && !empty($request->tax_id)) {

            // $validator = Validator::make($request->all(), [
            //     'name' => 'required|string|max:255',
            //     'email' => 'required',
            //     'phone' => 'required|string|max:15',
            //     'status' => 'required|in:active,inactive',
            // ]);

            // if ($validator->fails()) {
            //     return redirect()->back()->withErrors($validator)->withInput();
            // }

            $Tax_setting = Tax_setting::find($request->tax_id);
            $Tax_setting->Enable = $request->enable;
            $Tax_setting->Tax = $request->tax;
            $Tax_setting->Type = $request->Type;
            $Tax_setting->Label = $request->Label;
            if ($Tax_setting->save()) {

                return redirect()->route('userreport.index')->with('success', 'User Report Download successfully.');
            } else {
                die('A Error Downloads Plese Check');
            }
        }
    }
}
