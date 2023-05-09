<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\BroadcastsEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoffeeBean extends Model
{
    use HasFactory, Uuids, BroadcastsEvents;

    /**
     * Get the channels that model events should broadcast on.
     *@return array<int, \Illuminate\Broadcasting\Channel|\Illuminate\Database\Eloquent\Model>
     */
    public function broadcastOn(string $event): array
    {
        return [$this];
    }

    protected $fillable = [
        'name',
    ];

    protected $with = [
        'grades',
    ];

    public function grades()
    {
        return $this->belongsToMany(CoffeeGrade::class)->withTimestamps();
    }

    public function getAllowedRelationships()
    {
        return ['grades'];
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
