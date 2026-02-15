<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'employees';

    protected $primaryKey = 'employee_id';
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'employee_id',
        'dni',
        'tel_number',
        'bank_account',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'employee_id', 'id');
    }
}
