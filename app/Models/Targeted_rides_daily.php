<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Targeted_rides_daily extends Model
{
    use HasFactory;
    protected $fillable = [
        'targeted_rides_id',
        'Daily_Rides',
        'Incentive',
    ];
}
