<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_roles extends Model
{
    use HasFactory;
    protected $table = 'tb_users_roles';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    
    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
