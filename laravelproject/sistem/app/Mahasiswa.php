<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'tb_mahasiswa';
    protected $fillable = ['nim','foto','nama','tanggal_lahir','program_studi','dokumen'];
    protected $primaryKey = 'nim';
}
