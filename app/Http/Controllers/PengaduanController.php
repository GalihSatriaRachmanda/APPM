<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Pengaduan;
use Illuminate\Http\File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;
use Str;

class PengaduanController extends Controller
{
    
    public function index()
    {
        return view('pengaduan.index');
    }

    public function show($id)
    {
        $pengaduan = Pengaduan::where('id', $id)->first();
        return view('pengaduan.show', ['pengaduan' => $pengaduan]);
    }
    
    public function store(Request $request)
    {
         $this->validate($request, [

            'judul'                     => 'required',
            'isi_laporan'               => 'required',
            'lokasi'                    => 'required',
            'foto'                      => 'required',
        ]);
    
        $foto_Name = $request->id.time().'.'.$request->foto->extension();  
        $request->foto->move(public_path('img/laporan'), $foto_Name);

        Pengaduan::create([

            'judul'                     => $request->judul,
            'nik'                       => $request->nik,
            'isi_laporan'               => $request->isi_laporan,
            'lokasi'                    => $request->lokasi,
            'foto'                      => 'img/laporan/' . $foto_Name,
        ]);

        return redirect()->back()->with('message', 'Berhasil dilaporkan !');;
    }

    public function datatables()
    {
        $pengaduan = pengaduan::all();
        return Datatables::of($pengaduan)
            ->addColumn('periksa', function ($v) {
                return '<a href= "pengaduan/'.$v->id.'\"class="btn btn-info btn-small btn-circle text-white">See more</a> ';
            })
            ->rawColumns(['periksa'])->make(true);
    }
}
