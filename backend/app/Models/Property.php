<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
    ];

    public function interestedClients()
    {
        return $this->belongsToMany(Client::class, 'preferences', 'property_id', 'client_id')->withTimestamps();
    }
}
