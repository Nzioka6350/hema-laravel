<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory, Uuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'msg_id',
        'type',
        'preview_url',
        'incoming',
        'contact_id',
    ];

    protected $casts = [
        'preview_url' => 'boolean',
        'incoming' => 'boolean',
    ];

    protected $with = [
        'text',
        // 'sticker',
        // 'interactive',
        // 'contact',
        // 'location',
        // 'image',
        // 'video',
        // 'document',
    ];

    /**
     * Get the text associated with the message.
     */
    public function text()
    {
        return $this->hasOne(Text::class);
    }
}
