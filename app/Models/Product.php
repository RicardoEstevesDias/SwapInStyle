<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        "title",
        "description",
        "price",
        "status",
        "gender",
        "size",
        "type_id",
        "brand_id",
        "color_id",
        "image"
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function transaction():HasOne
    {
        return $this->hasOne(Transaction::class, 'product_id', 'id');
    }


    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }


    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class);
    }


    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }
}
