<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Conversation extends Model
{
    use HasFactory;

    public function conversationUser(): HasMany
    {
        return $this->hasMany(ConversationUser::class);
    }


    public function message(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}
