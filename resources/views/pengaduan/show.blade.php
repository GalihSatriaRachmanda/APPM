@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
<div class="header bg-gradient-primary py-7 py-lg-8">
</div>
    <div class="container-fluid mt--9">
        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <h3 class="mb-0">{{ __('Info Lebih Lanjut') }}</h3>
                        </div>
                    </div>
                    <div class="card-body bg-secondary">
                        <div class="col-xl-12 mb-4">
                            <h2 class="text-primary">{{ __('Judul Laporan :') }}</h2>
                            <a class="text text-default ">{{$pengaduan->judul}}</a>
                        </div>
                        <div class="col-xl-12 mb-4">
                            <h2 class="text-primary">{{ __('Isi Laporan :') }}</h2>
                            <a class="text text-default ">{!!nl2br(str_replace(" ", " &nbsp;", $pengaduan->isi_laporan))!!}</a>
                        </div>
                    </div>
                    <div class="card-footer text-align-right bg-secondary">
                    <button onclick="tanggapanForm()" class="btn btn-info btn-small btn-circle text-white">Tanggapi</button> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.nav')
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
});
</script>
@endsection
