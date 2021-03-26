<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $table = 'pengaduan';
    protected $fillable = [
            'judul',
            'nik',
            'isi_laporan',
            'lokasi',
            'foto',
            'visible',
            'status',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'nik', 'nik');
    }
    public function tanggapans()
    {
        return $this->hasMany(Tanggapan::class, 'id', 'id_pengaduan');
    }
}
