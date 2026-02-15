<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'inventories';

    protected $fillable = [
        'quantity',
        'location',
        'library_id'
    ];
    public function library()
    {
        return $this->belongsTo(Library::class, 'library_id', 'library_id');
    }

    public function books()
    {
        return $this->belongsToMany(Book::class, 'belongs', 'inventory_id', 'isbn')
            ->withTimestamps();
    }
}
