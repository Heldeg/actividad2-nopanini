<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'authors';

    protected $primaryKey = 'author_id';
    public $incrementing = false;
    protected $keyType = 'int';
    protected $fillable = [
        'author_id',
        'full_name',
        'gender',
        'country',
        'birth_date',
        'death_date',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'death_date' => 'date', // Importante para que null no de error
    ];

    public function property() //author
    {
        return $this->belongsTo(Property::class, 'author_id', 'id');
    }

    public function books()
    {
        return $this->belongsToMany(Book::class, 'author_writes', 'author_id', 'isbn')->withTimestamps();
    }
}
