<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AP extends Model
{
    public $timestamps = false;
    protected $table = 'tb_ap';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_bts', 'nama_ap', 'perangkat', 'tipe', 'installed_at', 'ip_address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    // protected $hidden = [
    //     'password',
    // ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
}
