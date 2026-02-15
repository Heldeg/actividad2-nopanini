<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Library extends Model
{
    use HasFactory, SoftDeletes;
      protected $fillable = [
        'name',
        'address',
        'tel_number',
    ];

    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'library_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'library_id', 'id');
    }
    
}
