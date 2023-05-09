<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grower extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'name',
        'code',
    ];
    public function reciept(){
        $this->belongsToMany(PurchaseReceipt::class);
    }
}
