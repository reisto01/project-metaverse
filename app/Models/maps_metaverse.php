<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class maps_metaverse extends Model
{
    use HasFactory;
    protected $table = 'tb_metamap';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    protected $casts = [
        'price' => 'decimal:2',
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
