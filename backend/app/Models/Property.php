<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'property';
    protected $primaryKey = 'property_id';
    public $incrementing = false;

    protected $fillable = [
        'property_id',
        'name',
    ];

    public function interestedClients()
    {
        return $this->belongsToMany(Client::class, 'preferences', 'property_id', 'client_id')->withTimestamps();
    }
}
