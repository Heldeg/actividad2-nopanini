<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contain extends Pivot
{
    use HasFactory, SoftDeletes;
    protected $table = 'contains';

    public $incrementing = false;

    protected $fillable = [
        'order_id',
        'isbn',
        'quantity',
    ];
    
    public function book()
    {
        return $this->belongsTo(Book::class, 'isbn', 'isbn');
    }
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
