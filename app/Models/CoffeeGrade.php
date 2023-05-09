<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoffeeGrade extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'name',
    ];

    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['beans'];

    public function beans() {
        return $this->belongsToMany(CoffeeBean::class);
    }
}
