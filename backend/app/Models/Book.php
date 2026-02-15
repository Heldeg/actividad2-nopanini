<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'books';

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
        'editorial_id',
    ];
    protected $casts = [
        'price' => 'decimal:2',
    ];
    public function editorial()
    {
        return $this->belongsTo(Editorial::class, 'editorial_id', 'editorial_id');
    }
    public function authors()
    {
        return $this->belongsToMany(Author::class, 'author_writes', 'isbn', 'author_id')->withTimestamps();
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'classifies', 'isbn', 'property_id')->withTimestamps();
    }

    public function likedByUsers()
    {
        return $this->belongsToMany(Client::class, 'user_likes', 'isbn', 'client_id')->withTimestamps();
    }

    public function books()
    {
        return $this->belongsToMany(Book::class, 'contains', 'order_id', 'isbn')
            ->withPivot(['quantity', 'price']) 
            ->withTimestamps();
    }

}
