<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Model
{
    use SoftDeletes;
    protected $table = 'admins';

    protected $primaryKey = 'admin_id';


    public $incrementing = false;

    protected $keyType = 'int';

    protected $fillable = [
        'admin_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'admin_id', 'id');
    }
}
