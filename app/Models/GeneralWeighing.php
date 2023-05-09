<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralWeighing extends Model
{
    use HasFactory, Uuids;

    protected $fillable=[
        'purchase_reciept_id',
        'name_of_marketing',
        'bag_weight_after',
        'bag_weight_before',
        'crop_year',
        'outrun_no',
    ];
}
