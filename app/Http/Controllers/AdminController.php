<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Liveuser;
use App\Models\Driver;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $Userscount = count(Liveuser::all());
        $Drivercount = count(Driver::all());

        $newUsers = Liveuser::whereDate('created_at', '>=', Carbon::now()->subDays(2))
            ->get();
        $newDriver = Driver::whereDate('created_at', '>=', Carbon::now()->subDays(2))
            ->get();

        return view('admin.dashboard', compact('Userscount', 'Drivercount', 'newDriver', 'newUsers'));
    }
}
