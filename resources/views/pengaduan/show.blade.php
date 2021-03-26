@extends('layouts.app', ['class' => 'bg-default'], ['title' => __('User Profile')])

@section('content')
<div class="header bg-gradient-primary py-7 py-lg-8">
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
                            <h3 class="text-default">{{ __('Tanggal Laporan : ') }}<a class="text text-default ">{{$pengaduan->tgl_pengaduan}}</a></h3>
                            <h3 class="text-default">{{ __('Status : ') }}<a class="text text-default ">{{$pengaduan->status}}</a></h3>
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
                                <img id="foto" src="{{URL::asset($pengaduan->foto)}}">
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
                            @if(!empty($tanggapan))
                                @foreach($tanggapan as $a)
                                <div class="row justify-content-center">
                                    <a class="text text-default ">{!!nl2br(str_replace(" ", " &nbsp;", $a->tanggapan))!!}</a>
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
            </div>
            @hasanyrole('petugas|admin')
            <div class="col-xl-12 mb-4">
                <button onclick="tanggapanForm()" class="btn btn-info btn-small btn-circle mt-3 text-white">Tanggapi</button> 
            </div>
            @endhasanyrole
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
        <img class="modal-content" id="img01">
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
            if (!e.isDefaultPrevented()){
                let id = $('#modal-form-tanggapan #id').val();
                url = "{{ url('dashboard/tanggapan') }}";
                let rCheckboxes = $('.cb_role')
                let roleNameArr = ''
                $.each(rCheckboxes, (k,v)=>{
                    if(v.checked){
                        if(roleNameArr == '') roleNameArr += v.value
                        else roleNameArr += '|' + v.value
                    }
                })
                $('#role_name').val(roleNameArr)

                $.ajax({
                    url : url,
                    type : "POST",
                    //hanya untuk input data tanpa dokumen
//                      data : $('#modal-form-tanggapan form').serialize(),
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
            }
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
