@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
    @include('layouts.headers.welcome')
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
                                    <input type="file" accept="image/*" class="custom-file-input{{ $errors->has('foto') ? ' is-invalid' : '' }}" name="foto" value="{{ old('foto') }}" required>
                                    <label class="custom-file-label" for="customFileLang">Select file</label>
                                </div>
                                @if ($errors->has('foto'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('foto') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary mt-4">{{ __('Laporkan') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.nav')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#modal-form form').validator().on('submit', function (e) {
            if (!e.isDefaultPrevented()){
                var id = $('#id').val();
                if (save_method == 'add') url = "{{ url('dashboard/area') }}";
                else url = "{{ url('dashboard/area') . '/' }}" + id;

                $.ajax({
                    url : url,
                    type : "POST",
                    //hanya untuk input data tanpa dokumen
//                      data : $('#modal-form form').serialize(),
                    data: new FormData($("#modal-form form")[0]),
                    contentType: false,
                    processData: false,
                    success : function(data) {
                        console.log(data)
                        $('#modal-form').modal('hide');
                        table.ajax.reload();
                        swal({
                            title: 'Success!',
                            text: data.message,
                            type: 'success',
                            timer: '1500'
                        })
                    },
                    error : function(data){
                        console.log(data)
                        var response = JSON.parse(data.responseText);
                        let str = ''
                        $.each(response.errors, function(key, value) {
                            str += value + ', ';
                        });
                        swal({
                            title: 'Oops...',
                            text: str,
                            type: 'error',
                            timer: '3000'
                        })
                    }
                });
                return false;
            }
        });
    } );
    </script>
@endpush