<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'inventory';
    protected $primaryKey = 'inventory_id';

    protected $fillable = [
        'inventory_id',
        'library_id',
        'quantity',
        'location'
    ];
    public function library()
    {
        return $this->belongsTo(Library::class, 'library_id', 'library_id');
    }

    public function books()
    {
        return $this->belongsToMany(Book::class, 'belong', 'inventory_id', 'isbn')
            ->withTimestamps();
    }
}
