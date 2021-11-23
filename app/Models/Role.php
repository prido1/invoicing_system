<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'permission',
        'role_id'
    ];

    public function permission(){
        return $this->hasOne(Permission::class, 'role_id');
    }
}
