<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function index()
    {
        if (\request()->ajax()) {
            $data = Brand::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('brand.edit', $row->id) . '" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a> <a href="' . route('brand.destroy', $row->id) . '"  class="btn btn-danger shadow btn-xs sharp" onclick="return confirm(\'Are You Sure Delete This?\')"><i class="fa fa-trash"></i></a>';
                    return $actionBtn;
                })->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.brands.index');
    }

    public function brandstore(Request $request)
    {
        //dd($request->all());
        if (isset($request->brand_id) && !empty($request->brand_id)) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'status' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $Brand = Brand::find($request->brand_id);
            $Brand->name = $request->name;
            $Brand->status = $request->status;
            $Brand->save();
            return redirect()->route('brand.index')->with('success', 'Brand update successfully.');
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'status' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $Brand = new Brand();
            $Brand->name = $request->name;
            $Brand->status = $request->status;
            $Brand->save();
            return redirect()->route('brand.index')->with('success', 'Brand created successfully.');
        }
    }

    public function brandcreate()
    {
        return view('admin.brands.add');
    }

    public function brandedit($id)
    {
        $Brand = Brand::find($id);
        return view('admin.brands.add', compact('Brand'));
    }

    public function brandstroy($id)
    {
        $Brand = Brand::find($id);
        if (!$Brand) {
            return redirect()->back()->with('error', 'Brand Not Found!');
        }
        $Brand->delete();
        return redirect()->back()->with('success', 'Brand Delete successfully.');
    }
}
