<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    use HasFactory, Uuids;

    protected $fillable=[
        'name',
        'address_id',
        'barcode_no',
        'license_no',
        'pin_no',
        'vat_no',
    ];

    protected $with = ['company_logo', 'address'];
}
