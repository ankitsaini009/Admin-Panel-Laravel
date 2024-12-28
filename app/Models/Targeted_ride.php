<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Targeted_ride extends Model
{
    use HasFactory;
    protected $fillable = [
        'Start_Date',
        'End_Date',
        'Short_Description',
        'Enabled',
    ];
}
