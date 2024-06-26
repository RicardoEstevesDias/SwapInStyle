<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConversationUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        "conversation_id",
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
