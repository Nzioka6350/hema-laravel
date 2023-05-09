<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory, Uuids;


    protected $fillable = [
        'address',
        'web_url',
        'street',
        'fax_no',
        'telephone',
        'email',
        'postalcode',
        'city',
    ];
}
