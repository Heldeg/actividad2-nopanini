<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'clients';

    protected $primaryKey = 'client_id';

    public $incrementing = false;

    protected $keyType = 'int';

    protected $fillable = [
        'client_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'client_id', 'id');
    }
    public function preferences()
    {
        return $this->belongsToMany(Property::class, 'preferences', 'client_id', 'property_id')->withTimestamps();
    }

    public function likedBooks()
    {
        return $this->belongsToMany(Book::class, 'user_likes', 'client_id', 'isbn')->withTimestamps();
    }

}
