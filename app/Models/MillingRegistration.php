<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MillingRegistration extends Model
{
    use HasFactory, Uuids;

    protected $fillable=[
        'name_of_miller',
        'month',
        'milling_date',
        'company_profile_id',
        'purchase_reciept_id',
        'grower_id',
        'physical_address',
    ];
}
