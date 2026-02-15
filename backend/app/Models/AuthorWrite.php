<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AuthorWrite extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'author_writes';

    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = [
        'author_id',
        'isbn',
    ];

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id', 'author_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'isbn', 'isbn');
    }   
}
