<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prominent_rlace_ride extends Model
{
    use HasFactory;
    protected $fillable = [
        'Address',
        'Latitude',
        'Longitude',
        'Start_Date',
        'End_Date',
        'Short_Description',
        'Enabled',
    ];
}
