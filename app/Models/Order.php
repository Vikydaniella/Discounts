<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsArray;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    
    protected $fillable = ['customer_id', 'items', 'total'];

    protected $casts = [
        'items' => AsArray::class,
    ];

    public function customer_id()
    {
        return $this->belongsTo('App\Customer');
    }
}

