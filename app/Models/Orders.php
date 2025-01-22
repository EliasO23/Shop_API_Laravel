<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Users;

class Orders extends Model
{
    /** @use HasFactory<\Database\Factories\OrdersFactory> */
    use HasFactory;

    protected $fillable = ['product', 'quantity', 'total', 'user_id'];

    /**
     * Foreing key relationship with users table.
     */
    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }
}
