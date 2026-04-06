<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Editorial extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'editorial';

    protected $primaryKey = 'property_id';
    public $incrementing = false;
    protected $keyType = 'int';
    protected $fillable = [
        'property_id',
        'tel_number',
    ];
    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id', 'property_id');
    }
}
