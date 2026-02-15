<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserLike extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'user_likes';
    public $incrementing = false;
    

    protected $fillable = [
        'client_id',
        'isbn',
    ];
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'client_id');
    }
    public function book()
    {
        return $this->belongsTo(Book::class, 'isbn', 'isbn');
    }


}
