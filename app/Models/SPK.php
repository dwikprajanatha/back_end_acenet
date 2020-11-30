<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\DB;

class SPK extends Model
{
    public $timestamps = false;
    protected $table = 'tb_spk';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'no_spk', 'ket_pekerjaan', 'tgl_pekerjaan', 'jam_mulai', 'jam_selesai', 'download_speed', 'upload_speed', 'ket_lanjutan', 'status'
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
    public function tandaTangan()
    {
        return $this->hasMany('App\Models\TandaTangan');
    }

    public function ikr()
    {
        return $this->hasMany('App\Models\IKR');
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    public function admin()
    {
        return $this->belongsTo('App\Models\Admin');
    }
}
