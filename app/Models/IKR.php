<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IKR extends Model
{
    public $timestamps = false;
    protected $table = 'tb_ikr';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_spk', 'id_teknisi',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    public function spk()
    {
        return $this->belongsTo('App\Models\SPK');
    }

    public function teknisi()
    {
        return $this->belongsTo('App\Models\User');
    }
}
