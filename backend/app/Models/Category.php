<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'categories';

    protected $primaryKey = 'category_id';
    public $incrementing = false;
    protected $keyType = 'int';
    protected $fillable = [
        'category_id',
        'name',
        'parent_category_id'
    ];

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_category_id', 'category_id');
    }
    public function property()
    {
        return $this->belongsTo(Property::class, 'category_id', 'category_id');
    }

    public function books()
    {
        return $this->belongsToMany(Book::class, 'classifies', 'property_id', 'isbn')->withTimestamps();
    }
}
