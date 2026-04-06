<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'category';

    protected $primaryKey = 'property_id';
    public $incrementing = false;
    protected $keyType = 'int';
    protected $fillable = [
        'property_id',
        'name',
        'parent_property_id'
    ];

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_property_id', 'property_id');
    }
    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id', 'property_id');
    }

    public function books()
    {
        return $this->belongsToMany(Book::class, 'classify', 'property_id', 'isbn')->withTimestamps();
    }
}
