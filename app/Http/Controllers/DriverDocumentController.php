<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver_documnt;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DriverDocumentController extends Controller
{
    public function index()
    {
        if (\request()->ajax()) {
            $data = Driver_documnt::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . route('drive_document.edit', $row->id) . '" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a> <a href="' . route('drive_document.destroy', $row->id) . '"  class="btn btn-danger shadow btn-xs sharp" onclick="return confirm(\'Are You Sure Delete This?\')"><i class="fa fa-trash"></i></a>';
                    return $actionBtn;
                })->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.drive_document.index');
    }

    public function drive_documentstore(Request $request)
    {
        //dd($request->all());
        if (isset($request->document_id) && !empty($request->document_id)) {
            $validator = Validator::make($request->all(), [
                'Title' => 'required|string|max:255',
                'status' => 'required|in:active,inactive',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $Driver_documnt = Driver_documnt::find($request->document_id);
            $Driver_documnt->title = $request->Title;
            $Driver_documnt->status = $request->status;
            $Driver_documnt->save();
            return redirect()->route('drive_document.index')->with('success', 'Driver Document update successfully.');
        } else {

            $validator = Validator::make($request->all(), [
                'Title' => 'required|string|max:255',
                'status' => 'required|in:active,inactive',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $Driver_documnt = new Driver_documnt();
            $Driver_documnt->title = $request->Title;
            $Driver_documnt->status = $request->status;
            $Driver_documnt->save();
            return redirect()->route('drive_document.index')->with('success', 'Driver Document created successfully.');
        }
    }

    public function drive_documentcreate()
    {
        return view('admin.drive_document.add');
    }

    public function drive_documentedit($id)
    {
        $Driver_documnt = Driver_documnt::find($id);
        return view('admin.drive_document.add', compact('Driver_documnt'));
    }

    public function drive_documentstroy($id)
    {
        $userdata = Driver_documnt::find($id);
        if (!$userdata) {
            return redirect()->back()->with('error', 'Driver Document Not Found!');
        }
        $userdata->delete();
        return redirect()->back()->with('success', 'Driver Document Delete successfully.');
    }
}
