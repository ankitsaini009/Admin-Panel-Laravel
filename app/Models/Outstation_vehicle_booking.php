<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outstation_vehicle_booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'Vehicle_Type',
        'Customer',
        'Days',
        'Start_Date',
        'End_Date',
        'Status',
    ];
}
