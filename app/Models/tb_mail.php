<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tb_mail extends Model
{
    use HasFactory;
    protected $table = 'tb_mail';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    protected $casts = [
        'status' => 'integer',
        'is_deleted' => 'integer',
    ];
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */


}
