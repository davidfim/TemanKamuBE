<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model 
{
    protected $table = 'dokter';

    protected $fillable = [
        'id_dokter',
        'nama_dokter',
        'spesialis',
        'harga_konsul',
        'foto_dokter',
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}