<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CouponsController extends Controller
{
    public function index()
    {
        if (\request()->ajax()) {
            $data = Coupon::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('coupons.edit', $row->id) . '" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a> <a href="' . route('coupons.destroy', $row->id) . '"  class="btn btn-danger shadow btn-xs sharp" onclick="return confirm(\'Are You Sure Delete This?\')"><i class="fa fa-trash"></i></a>';
                    return $actionBtn;
                })->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.coupons.index');
    }

    public function couponstore(Request $request)
    {
        //dd($request->all());

        if (isset($request->coupons_id) && !empty($request->coupons_id)) {
            $Coupon = Validator::make($request->all(), [
                'Code' => 'required',
                'Discount' => 'required',
                'Expire_date' => 'required|string|max:15',
                'Discount_Type' => 'required',
            ]);

            if ($Coupon->fails()) {
                return redirect()->back()->withErrors($Coupon)->withInput();
            }
            $Coupon = Coupon::find($request->coupons_id);
            $Coupon->code = $request->Code;
            $Coupon->discount = $request->Discount;
            $Coupon->expire_date = $request->Expire_date;
            $Coupon->discount_type = $request->Discount_Type;
            $Coupon->description = $request->Description;
            $Coupon->enabled = $request->Enabled;
            $Coupon->save();
            return redirect()->route('coupons.index')->with('success', 'Coupon update successfully.');
        } else {
            $Coupon = Validator::make($request->all(), [
                'Code' => 'required|unique:coupons,code',
                'Discount' => 'required',
                'Expire_date' => 'required',
                'Discount_Type' => 'required',
            ]);

            if ($Coupon->fails()) {
                return redirect()->back()->withErrors($Coupon)->withInput();
            }
            $Coupon = new Coupon();
            $Coupon->code = $request->Code;
            $Coupon->discount = $request->Discount;
            $Coupon->expire_date = $request->Expire_date;
            $Coupon->discount_type = $request->Discount_Type;
            $Coupon->description = $request->Description;
            $Coupon->enabled = $request->Enabled;
            $Coupon->save();
            return redirect()->route('coupons.index')->with('success', 'Coupon created successfully.');
        }
    }

    public function couponcreate()
    {
        return view('admin.coupons.add');
    }

    public function couponedit($id)
    {
        $Coupondata = Coupon::find($id);
        return view('admin.coupons.add', compact('Coupondata'));
    }

    public function coupondestroy($id)
    {
        $Coupondata = Coupon::find($id);
        if (!$Coupondata) {
            return redirect()->back()->with('error', 'Coupon Not Found!');
        }
        $Coupondata->delete();
        return redirect()->back()->with('success', 'Coupon Delete successfully.');
    }
}
