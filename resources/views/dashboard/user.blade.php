<div class="container-fluid mt--7 ">
        <div class="row justify-content-md-center">
            <div class="col-xl-7 mb-5 mb-xl-0">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-gradient-default">
                        <div class="row align-items-center">
                            <div class="col">
                                <h2 class="text-white mb-0">Sampaikan Laporan Anda</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <form role="form" enctype="multipart/form-data" method="POST" data-toggle="validator" action="{{ route('pengaduan.store') }}">
                        {{ csrf_field() }} {{ method_field('POST') }}
                        
                        @auth()
                            <input type="hidden" id="nik" name="nik" value="{{Auth::user()->nik}}">
                        @endauth

                            <div class="form-group{{ $errors->has('judul') ? ' has-danger' : '' }}">
                                <label class="form-label">Judul :</label>
                                <div class="input-group  mb-3">
                                    <input class="form-control{{ $errors->has('judul') ? ' is-invalid' : '' }}" placeholder="{{ __('Ketik judul laporan anda*') }}" type="text" name="judul" value="{{ old('judul') }}" required autofocus>
                                </div>
                                @if ($errors->has('judul'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('judul') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('isi_laporan') ? ' has-danger' : '' }}">
                                <label class="form-label">Isi Laporan :</label>
                                <div class="input-group  mb-3">
                                    <textarea class="form-control{{ $errors->has('isi_laporan') ? ' is-invalid' : '' }}" style="resize:none" rows="5" placeholder="{{ __('Ketik isi laporan anda*') }}" type="text" name="isi_laporan" value="{{ old('isi_laporan') }}" required autofocus></textarea>
                                </div>
                                @if ($errors->has('isi_laporan'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('isi_laporan') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('lokasi') ? ' has-danger' : '' }}">
                                <label class="form-label">Lokasi :</label>
                                <div class="input-group  mb-3">
                                    <input class="form-control{{ $errors->has('lokasi') ? ' is-invalid' : '' }}" placeholder="{{ __('Ketik lokasi laporan anda*') }}" type="text" name="lokasi" value="{{ old('lokasi') }}" required autofocus>
                                </div>
                                @if ($errors->has('lokasi'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('lokasi') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <div class="custom-file">
                                    <label class="form-label">Foto Bukti :</label>
                                    <input type="file" accept="image/*" class="form-control{{ $errors->has('foto') ? ' is-invalid' : '' }}" placeholder="{{ __('Masukan foto bukti*') }}" name="foto" value="{{ old('foto') }}" required>
                                </div>
                                @if ($errors->has('foto'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('foto') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="text-left">
                                <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" for="visible" name="visible" class="cb_role custom-control-input" id="visible1" value="anonim">
                                    <label class="custom-control-label" for="visible1">Laporkan sebagai anonim</label>
                                    <label class="h6 label text-muted ml-2" for="visible1"><span style="color:red;">*</span>Hanya bisa dilihat petugas</label>
                                </div>
                            </div>
                            <div class="text-left">
                            @guest
                            <a type="button" href="{{route('login')}}" class="btn btn-primary mt-4">{{ __('Login Dulu') }}</a>
                            @endguest
                            @auth
                            <button type="submit" class="btn btn-primary mt-4">{{ __('Laporkan') }}</button>
                            @endauth
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.nav')
    </div>