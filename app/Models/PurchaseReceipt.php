<?php

namespace App\Models;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseReceipt extends Model
{
    use HasFactory, Uuids;
    protected $fillable = [
        'bags_in_outturn',
        'grower_id',
        'coffee_bean_id',
        'bags_in_delivery',
        'delivery_vehicle_no',
        'store',
        'floor',
        'row',
        'row',
        'bay',
        'bags_in',
    ];


    protected $with = ['grower', "coffee_beans"
    ];


    public function coffee_beans()
    {
        return $this->belongsTo(CoffeeBean::class);
    }
    public function grower()
    {
        return $this->belongsTo(Grower::class);
    }


    public function getAllowedRelationships()
    {
        return ['grower', 'coffee_beans'];
    }

    public function scopeWithAllowedRelationships($query, $relationships)
    {
        if (!$relationships) {
            return $query;
        }

        $allowedRelationships = $this->getAllowedRelationships();
        $requestedRelationships = preg_split('/[\s,]+/', $relationships);

        $relationshipsToLoad = collect($requestedRelationships)
            ->map(function ($relationship) use ($allowedRelationships) {
                return in_array($relationship, $allowedRelationships) ? $relationship : null;
            })
            ->filter()
            ->toArray();

        $query = $query->with($relationshipsToLoad);

        return $query;
    }
}
