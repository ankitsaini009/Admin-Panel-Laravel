<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle_type extends Model
{
    use HasFactory;
    protected $fillable = [
        'Name',
        'Par_Day_Price',
        'Image',
        'Number_Of_Passenger',
        'Vehicle_Type',
        'Status',

    ];
}
