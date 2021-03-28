<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
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
        Carbon::createFromFormat('Y-m-d H:i:s', $pengaduan->tgl_pengaduan)->isoFormat('D MMMM Y HH:mm');
        $tanggapan = Tanggapan::where('id_pengaduan', $id)->get();
        return view('pengaduan.show', ['pengaduan' => $pengaduan, 'tanggapan' => $tanggapan]);
    }
    
    public function store(Request $request)
    {
         $this->validate($request, [

            'judul'                     => 'required',
            'isi_laporan'               => 'required',
            'lokasi'                    => 'required',
            'foto'                      => 'required',
        ]);

        if($request->has('visible')){
            $data_visible = $request->visible;
        }else{
            $data_visible = 'public';
        };
        
        $foto_Name = $request->id.time().'.'.$request->foto->extension();  
        $request->foto->move(public_path('img/laporan'), $foto_Name);

        Pengaduan::create([

            'judul'                     => $request->judul,
            'nik'                       => $request->nik,
            'isi_laporan'               => $request->isi_laporan,
            'lokasi'                    => $request->lokasi,
            'foto'                      => 'img/laporan/' . $foto_Name,
            'visible'                   => $data_visible,
        ]);

        return redirect()->back()->with('message', 'Berhasil dilaporkan !');;
    }

    public function datatables()
    {
        $pengaduan = pengaduan::all();
        return Datatables::of($pengaduan)
            ->addColumn('periksa', function ($v) {
                return '<a href="/dashboard/pengaduan/' .$v->id.'\" class="btn btn-info btn-small btn-circle text-white">See more</a> ';
            })
            ->editColumn('tgl_pengaduan', function ($user) {
                return $user->tgl_pengaduan ? with(new Carbon($user->tgl_pengaduan))->isoFormat('D MMMM Y HH:mm') : '';
            })
            ->rawColumns(['periksa'])->make(true);
    }
    public function datatables_none()
    {
        $pengaduan = pengaduan::where('status' , 'belum di proses');
        return Datatables::of($pengaduan)
            ->addColumn('nama', function ($v) {
                return $v->users? $v->users->nama:'-';
            })
            ->editColumn('tgl_pengaduan', function ($user) {
                return $user->tgl_pengaduan ? with(new Carbon($user->tgl_pengaduan))->isoFormat('D MMMM Y HH:mm') : '';
            })
            ->addColumn('periksa', function ($v) {
                return '<a href="/dashboard/pengaduan/' .$v->id.'\" class="btn btn-info btn-small btn-circle text-white">See more</a> ';
            })
            ->rawColumns(['periksa'])->make(true);
    }
    public function datatables_proses()
    {
        $pengaduan = pengaduan::where('status' , 'proses');
        return Datatables::of($pengaduan)
            ->addColumn('nama', function ($v) {
                return $v->users? $v->users->nama:'-';
            })
            ->editColumn('tgl_pengaduan', function ($user) {
                return $user->tgl_pengaduan ? with(new Carbon($user->tgl_pengaduan))->isoFormat('D MMMM Y HH:mm') : '';
            })
            ->addColumn('last_update', function ($v) {
                $p = Tanggapan::where('id_pengaduan',$v->id)->orderBy('tgl_tanggapan', 'DESC')->first();
                $parse = Carbon::parse($p['tgl_tanggapan']);
                $time = Carbon::createFromFormat('Y-m-d H:i:s',  $parse)->isoFormat('D MMMM Y HH:mm');
                return $time;
            })
            ->addColumn('periksa', function ($v) {
                return '<a href="/dashboard/pengaduan/' .$v->id.'\" class="btn btn-info btn-small btn-circle text-white">See more</a> ';
            })
            ->rawColumns(['periksa'])->make(true);
    }
    public function datatables_selesai()
    {
        $pengaduan = pengaduan::where('status' , 'selesai');
        return Datatables::of($pengaduan)
            ->addColumn('nama', function ($v) {
                return $v->users? $v->users->nama:'-';
            })
            ->editColumn('tgl_pengaduan', function ($user) {
                return $user->tgl_pengaduan ? with(new Carbon($user->tgl_pengaduan))->isoFormat('D MMMM Y HH:mm') : '';
            })
            ->addColumn('periksa', function ($v) {
                return '<a href="/dashboard/pengaduan/' .$v->id.'\" class="btn btn-info btn-small btn-circle text-white">See more</a> ';
            })
            ->rawColumns(['periksa'])->make(true);
    }
    public function datatables_public()
    {
        $pengaduan = pengaduan::where('visible' , 'public');
        return Datatables::of($pengaduan)
            ->addColumn('nama', function ($v) {
                return $v->users? $v->users->nama:'-';
            })
            ->editColumn('tgl_pengaduan', function ($user) {
                return $user->tgl_pengaduan ? with(new Carbon($user->tgl_pengaduan))->isoFormat('D MMMM Y HH:mm') : '';
            })
            ->addColumn('periksa', function ($v) {
                return '<a href="/dashboard/pengaduan/' .$v->id.'\" class="btn btn-info btn-small btn-circle text-white">See more</a> ';
            })
            ->rawColumns(['periksa'])->make(true);
    }
    public function datatables_private()
    {
        $pengaduan = pengaduan::where('nik' , Auth::user()->nik);
        return Datatables::of($pengaduan)
            ->addColumn('periksa', function ($v) {
                return '<a href="/dashboard/pengaduan/' .$v->id.'\" class="btn btn-info btn-small btn-circle text-white">See more</a> ';
            })
            ->editColumn('tgl_pengaduan', function ($user) {
                return $user->tgl_pengaduan ? with(new Carbon($user->tgl_pengaduan))->isoFormat('D MMMM Y HH:mm') : '';
            })
            ->rawColumns(['periksa'])->make(true);
    }
}
