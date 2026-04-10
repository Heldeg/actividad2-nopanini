<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classify extends Pivot
{
    use HasFactory, SoftDeletes;
    protected $table = 'classifies';
    public $incrementing = false;

    protected $fillable = [
        'isbn',
        'property_id',
    ];
    public function book()
    {
        return $this->belongsTo(Book::class, 'isbn', 'isbn');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'property_id', 'category_id');
    } 
}
