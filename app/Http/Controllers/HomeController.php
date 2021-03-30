<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Pengaduan;
use App\Models\User;
use Auth;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if(Auth::user()->getRoleNames() == 'petugas' || 'admin'){
            $pengaduan_total = Pengaduan::count();
            $pengaduan_none = Pengaduan::where('status' , 'belum di proses')->count();
            $pengaduan_proses = Pengaduan::where('status' , 'proses')->count();
            $pengaduan_selesai = Pengaduan::where('status' , 'selesai')->count();
            $akun = User::count();
            $user = User::role('user')->count();
            $admin = User::role('admin')->count();
            $petugas = User::role('petugas')->count();
            return view('dashboard', ['akun' => $akun, 'user' => $user, 'admin' => $admin, 'petugas' => $petugas, 'pengaduan_total' => $pengaduan_total, 'pengaduan_none' => $pengaduan_none, 'pengaduan_proses' => $pengaduan_proses, 'pengaduan_selesai' => $pengaduan_selesai]);
        }else{
            return view('dashboard');
        }
    }
}
