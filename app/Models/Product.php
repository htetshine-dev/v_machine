<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'quantity_available', 'in_stock', 'out_stock', 'created_user_id', 'updated_user_id'];

    // Define the relationship to the User model
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_user_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_user_id');
    }
}