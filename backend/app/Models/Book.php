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
        return $this->belongsToMany(Author::class, 'author_writes', 'isbn', 'author_id')
        ->using(AuthorWrite::class)
        ->withTimestamps();
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'classifies', 'isbn', 'property_id')
        ->using(Classify::class)
        ->withTimestamps();
    }

    public function likedByUsers()
    {
        return $this->belongsToMany(Client::class, 'user_likes', 'isbn', 'client_id')
        ->using(UserLike::class)
        ->withTimestamps();
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'contains', 'isbn', 'order_id')
            ->using(Contain::class)
            ->withPivot(['quantity'])
            ->withTimestamps();
    }
    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'isbn', 'isbn');
    }

}
