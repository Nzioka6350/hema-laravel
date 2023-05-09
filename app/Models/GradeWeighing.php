<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradeWeighing extends Model
{
    use HasFactory, Uuids;

    protected $fillable=[
        'purchase_reciept_id',
        'bulk_outturns',
        'classification',
        'pockets',
        'bags',
    ];
}
