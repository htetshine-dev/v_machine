<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'total_amount'];

    // Each order has multiple order items
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Each order belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 