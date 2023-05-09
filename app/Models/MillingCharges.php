<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MillingCharges extends Model
{
    use HasFactory, Uuids;

    protected $fillable=[
        'machine_repair',
        'drying',
        'seedling',
        'advance',
        'parchment_transport',
        'clean_coffee_transport',
        'export_bags',
        'handling',
        'milling',
    ];
}
