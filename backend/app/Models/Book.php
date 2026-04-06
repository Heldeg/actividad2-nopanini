<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'book';
    protected $primaryKey = 'isbn';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'isbn',
        'title',
        'description',
        'edition_num',
        'language',
        'price',
        'cover_image',
        'editorial',
    ];
    protected $casts = [
        'price' => 'decimal:2',
    ];
    public function editorial()
    {
        return $this->belongsTo(Editorial::class, 'editorial', 'property_id');
    }
    public function author()
    {
        return $this->belongsToMany(Author::class, 'author_write', 'isbn', 'property_id')->withTimestamps();
    }
    public function category()
    {
        return $this->belongsToMany(Category::class, 'classify', 'isbn', 'property_id')->withTimestamps();
    }

    public function likedByUsers()
    {
        return $this->belongsToMany(Client::class, 'user_likes', 'isbn', 'client_id')->withTimestamps();
    }

    public function order()
    {
        return $this->belongsToMany(Order::class, 'contain', 'isbn', 'order_id')
            ->withPivot(['quantity']) 
            ->withTimestamps();
    }

}
