<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;
use Str;

class TanggapanController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [

           'id_pengaduan'               => 'required',
           'tanggapan'                  => 'required',
           'id_user'                    => 'required',
           'status'                     => 'required',
       ]);
   

       Tanggapan::create([
           'id_pengaduan'              => $request->id_pengaduan,
           'tanggapan'                 => $request->tanggapan,
           'id_user'                   => $request->id_user,
       ]);

        $pengaduan = Pengaduan::findOrFail($request->id_pengaduan);
        $pengaduan->update([
            'status'                   =>$request->status,
        ]);

        return response()->json([
        'message' => 'Unit created.',
        ], 201);
   }
}
