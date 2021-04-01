@extends('layouts.app', ['class' => 'bg-gradient-default'], ['title' => __('User Profile')])

@section('content')
<div class="header bg-gradient-primary py-7 mb-7 py-lg-6">
    <div class="container">
        <div class="header-body text-center mb-3">
            <div class="row justify-content-center">    
                <div class="col-lg-12 col-md-6">
                    <h1 class="text-white">{{ __('Detail Laporan') }}</h1>
                    <hr style="width:150px; border: 3px solid white; border-radius: 5px;">
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="container-fluid mt--8">
        <div class="row justify-content-md-center">
            <div class="col-xl-11 mb-5 mb-xl-0">
                <div class="card mb-4 shadow">
                    <div class="card-body bg-secondary">
                        <div class="col-xl-12 mb-4">
                            <div class="row justify-content-center">
                                <h2 class="text-primary">{{ __('Detail Pelapor :') }}</h2>
                            </div>
                            <h3 class="text-default">{{ __('Judul Laporan : ') }}<a class="text text-default ">{{$pengaduan->judul}}</a></h3>
                            <h3 class="text-default">{{ __('Nama Pelapor : ') }}<a class="text text-default ">{{$pengaduan->users->nama}}</a></h3>
                            <h3 class="text-default">{{ __('NIK Pelapor : ') }}<a class="text text-default ">{{$pengaduan->nik}}</a></h3>
                            <h3 class="text-default">{{ __('Tanggal Laporan : ') }}<a class="text text-default ">{{\Carbon\Carbon::parse($pengaduan->tgl_pengaduan)->isoFormat('D MMMM Y HH:mm')}}</a></h3>
                            <h3 class="text-default">{{ __('Status : ') }} 
                            @if($pengaduan->status == 'belum di proses')
                            <span class="badge badge-danger">
                            @elseif($pengaduan->status == 'proses')
                            <span class="badge badge-warning">
                            @elseif($pengaduan->status == 'selesai')
                            <span class="badge badge-success">
                            @endif
                            {{$pengaduan->status}}</span>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="card mb-4 shadow">
                    <div class="card-body bg-secondary">
                        <div class="col-xl-12 mb-4">
                            <div class="row justify-content-center">
                                <h2 class="text-primary">{{ __('Isi Laporan :') }}</h2>
                            </div>
                            <div class="row justify-content-center">
                                <a class="text text-default ">{!!nl2br(str_replace(" ", " &nbsp;", $pengaduan->isi_laporan))!!}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4 shadow">
                    <div class="card-body bg-secondary">
                        <div class="col-xl-12 mb-4">
                            <div class="row justify-content-center">
                                <h2 class="text-primary">{{ __('Foto :') }}</h2>
                            </div>
                            <div class="row justify-content-center">
                                <img id="foto" style="object-fit: cover;" src="{{URL::asset($pengaduan->foto)}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4 shadow">
                    <div class="card-body bg-secondary">
                        <div class="col-xl-12 mb-4">
                            <div class="row justify-content-center">
                                <h2 class="text-primary">{{ __('Tanggapan :') }}</h2>
                            </div>
                            @if(!$tanggapan->isEmpty())
                                @foreach($tanggapan as $a)
                                <div class="row justify-content-left">
                                    <a class="text text-default "><span class="h4 text text-muted">{{\Carbon\Carbon::parse($a->tgl_tanggapan)->isoFormat('D MMMM Y HH:mm')}}  :  </span>{!!nl2br(str_replace(" ", " &nbsp;", $a->tanggapan))!!}</a>
                                </div>
                                @endforeach
                            @else
                                <div class="row justify-content-center">
                                    <a class="text text-muted ">Belum ada Tanggapan</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @hasanyrole('petugas|admin')
                @if($pengaduan->status != 'selesai' )
                <div class="row justify-content-center">
                    <a onclick="tanggapanForm()" id="btn_tanggapan" class="btn btn-info btn-small btn-circle mt-3 text-white">Tanggapi</a> 
                </div>
                @endif
                <div class="row justify-content-center">
                    <a href="/dashboard/print-laporan/{{$pengaduan->id}}" id="btn_tanggapan" class="btn btn-info btn-small btn-circle mt-3 text-white">Eksport PDF</a> 
                </div>
                @endhasanyrole
            </div>
        </div>
    </div>
    @include('layouts.footers.nav')
</div>
<div class="modal fade" id="img-popup" tabindex="-1" role="dialog" aria-labelledby="img-popupLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img class="modal-content" style="object-fit: cover;" id="img01">
      </div>
    </div>
  </div>
</div>

@include('pengaduan.form')
@endsection

@section('script')
<!-- DataTables -->
<script src="{{ asset('assets') }}/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('assets') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Sweet Alert jquery-->
<script src="{{asset('assets')}}/vendor/sweet-alert/sweetalert.min.js" ></script>
<!-- Select2 -->
<script src="{{asset('assets') }}/vendor/select2/select2.full.min.js"></script>
{{-- Validator --}}
<script src="{{ asset('assets') }}/vendor/validator/validator.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    
    $('#modal-form-tanggapan form').validator().on('submit', function (e) {
                let id = $('#modal-form-tanggapan #id').val();
                url = "{{ url('dashboard/tanggapan') }}";
                
                $.ajax({
                    url : url,
                    type : "POST",
                    data: new FormData($("#modal-form-tanggapan form")[0]),
                    contentType: false,
                    processData: false,
                    success : function(data) {
                        console.log(data)
                        $('#modal-form-tanggapan').modal('hide');
                        $('#users-table').DataTable().draw(true)
                        swal({
                            title: 'Success!',
                            text: data.message,
                            type: 'success',
                            timer: '1500'
                        })
                        location.reload();
                    },
                    error : function(data){
                        console.log(data)
                        let response = JSON.parse(data.responseText);
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
        });

    tanggapanForm = function(){
        save_method = "add";
        $('input[name=_method]').val('POST');
        $('#modal-form-tanggapan').modal('show');
        $('#modal-form-tanggapan form')[0].reset();
        $('.modal-title').text('Add Tanggapan');
    }

    var img = document.getElementById("foto");
    var modalImg = document.getElementById("img01");
    img.onclick = function(){
        $('#img-popup').modal('show');
        modalImg.src = this.src;
    }

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() { 
      modal.style.display = "none";
    }
});
</script>
@endsection
