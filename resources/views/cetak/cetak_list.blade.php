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

    <h6 class="text-center">List Laporan</h6>

    <hr class="solid">
    <table class="table text-center table-bordered">
      <thead class="thead bg-primary ">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Judul</th>
          <th scope="col">Nama Pelapor</th>
          <th scope="col">NIK Pelapor</th>
          <th scope="col">Tanggal Laporan</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
      @foreach($pengaduan as $item)
      <tr>
        <td>{{ $item->id}}</td>
        <td>{{ $item->judul}}</td>
        <td>{{ $item->users->nama}}</td>
        <td>{{ $item->nik}}</td>
        <td>{{\Carbon\Carbon::parse($item->tgl_tanggapan)->isoFormat('D MMMM Y HH:mm')}}</td>
        <td>{{ $item->status}}</td>
      </tr>
      @endforeach
      </tbody>
    </table>
    <hr class="solid">
  </div>
</body>
</html>