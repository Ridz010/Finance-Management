<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;

    protected $table = 'pengeluaran';

    protected $fillable = ['tanggal', 'jenis_pengeluaran', 'keterangan', 'keperluan', 'jumlah', 'id_users'];
}
