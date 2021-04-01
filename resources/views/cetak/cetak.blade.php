<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
		<meta charset="UTF-8">	
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Laporan</title>
  <style>
    img{
      height: 100px;;
    }
    hr.solid {
    border-top: 2px solid #3B82F6;
    }
  </style>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <div class="title text-center mb-5">
      <h2>Layanan Pengaduan Masyarakat Online</h2>
    </div>
    <hr class="solid">

    <div>
      <h6 class="text-center">Info Laporan</h6>

      <h6>Nama Pelapor : {{$pengaduan->users->nama }}</h6>
      <h6>NIK  :  {{$pengaduan->nik}}</h6>      
      <h6>No. Telepon  : {{ $pengaduan->users->telp }}</h6>      
      <h6>Lokasi  : {{ $pengaduan->lokasi }}</h6>      
      <h6>Tanggal Laporan  : {{\Carbon\Carbon::parse($pengaduan->tgl_tanggapan)->isoFormat('D MMMM Y HH:mm')}}</h6>
      <h6>Status : {{ $pengaduan->status }}</h6>      
    </div>

    <hr class="solid">
    <table class="table table-bordered">
      <thead class="thead text-center">
        <tr>
          <th scope="col">{{ $pengaduan->judul}}</th>
        </tr>
      </thead>
      <tbody>
        <td>{!!nl2br(str_replace(" ", " &nbsp;", $pengaduan->isi_laporan))!!}</td>
      </tbody>
    </table>
    <hr class="solid">
    <h6 class="text-center mb-3">Foto Bukti :</h6>
    <div class="containter mt-5 text-center">
      <img style="width: 200px; height: 200px" src="{{public_path($pengaduan->foto)}}">
    </div>
    <hr class="solid">
  </div>
</body>
</html>