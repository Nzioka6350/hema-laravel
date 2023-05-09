<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Text extends Model
{
    use HasFactory, Uuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'body',
        'message_id',
    ];

    /**
     * Get the message that owns the text.
     */
    public function message()
    {
        return $this->belongsTo(Message::class);
    }
}
