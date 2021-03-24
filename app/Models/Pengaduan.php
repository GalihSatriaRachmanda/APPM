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
            'status',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'nik');
    }
}
