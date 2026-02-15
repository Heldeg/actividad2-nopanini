<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contain extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'contains';

    protected $fillable = [
        'order_id',
        'isbn',
        'quantity',
    ];
    public function book()
    {
        return $this->belongsTo(Book::class, 'isbn', 'isbn');
    }
}
