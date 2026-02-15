<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Belong extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'belongs';

    public $incrementing = false;
    protected $fillable = [
        'inventory_id',
        'isbn',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class, 'isbn', 'isbn');
    }
    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id', 'inventory_id');
    }
}
