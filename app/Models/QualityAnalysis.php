<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualityAnalysis extends Model
{
    use HasFactory, Uuids;

    protected $fillable=[
        'liqour',
        'defects',
        'moisture',
        'roasts',,
    ];
}
