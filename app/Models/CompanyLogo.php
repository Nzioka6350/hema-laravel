<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyLogo extends Model
{
    use HasFactory, Uuids;

    protected $fillable = ['url'];
    protected $hidden = [
        'company_logo_id',
        'company_logo_type',];

    public function company_logoable(){
        return $this->morphTo();
    }

}
