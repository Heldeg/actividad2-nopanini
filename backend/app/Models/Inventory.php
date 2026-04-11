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
        'library_id',
        'isbn'
    ];
    public function library()
    {
        return $this->belongsTo(Library::class, 'library_id', 'id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'isbn', 'isbn');
    }
}
