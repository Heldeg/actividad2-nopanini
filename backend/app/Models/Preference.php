<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Preference extends Model
{
    use HasFactory, SoftDeletes;

    public $incrementing = false;

    protected $fillable = [
        'property_id',
        'client_id'
    ];
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'client_id');
    }
    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id', 'property_id');
    }
}
