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
                            <h3 class="mb-0">{{ __('List of User & Role') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <span></span>
                            <div class="btn-group btn-group-md mb-3">
                                <button onclick="refreshUsersTable()" type="button"
                                    class="btn btn-outline-primary btn-sm" title="Refresh data"><i
                                        class="fa fa-refresh"></i> Refresh</button>
                                <button onclick="addUser()" type="button" class="btn btn-outline-primary btn-sm"
                                    title="Add data"><i class="fa fa-plus"></i> Add</button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="users-table" class="table align-items-center">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Nomor Telepon</th>
                                        <th>Role</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
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
        $('#regional_id').select2()
        var table = $('#area-table').DataTable({
            "bLengthChange": false,
            "bFilter": true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('laporan.datatables') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'kode', name: 'kode'},
                {data: 'nama', name: 'nama'},
                {data: 'kota_count', name: 'kota_count'},
                {data: 'nama_regional', name: 'nama_regional'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

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
        
    function refreshTable() {
        $('#area-table').DataTable().draw(true)
    }

    function addForm() {
        save_method = "add";
        $('input[name=_method]').val('POST');
        $('#modal-form').modal('show');
        $('#modal-form form')[0].reset();
        $('.modal-title').text('Add Area');
    }

    function editForm(id) {
        save_method = 'edit';
        $('input[name=_method]').val('PATCH');
        $('#modal-form form')[0].reset();
        $.ajax({
            url: "{{ url('dashboard/area') }}" + '/' + id + "/edit",
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                console.log(data)
                $('#modal-form').modal('show');
                $('.modal-title').text('Edit Area');

                $('#id').val(data.id);
                $('#regional_id').val(data.regional_id);
                $('#regional_id').select2().trigger('change');
                $('#kode').val(data.kode);
                $('#nama').val(data.nama);
            },
            error : function(err) {
                console.log(err)
                alert("Data not found!");
            }
        });
    }

    function deleteData(id){
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        swal({
          title: "apakah anda yakin?",
          text: "setelah dihapus, data tidak bisa dikembalikan!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                url : "{{ url('dashboard/area') }}" + '/' + id,
                type : "POST",
                data : {'_method' : 'DELETE', '_token' : csrf_token},
                success : function(data) {
                    $('#area-table').DataTable().draw(true);
                    swal({
                        title: 'Success!',
                        text: data.message,
                        type: 'success',
                        timer: '1500'
                    })
                },
                error : function (data) {
                    console.log(data)
                    swal({
                        title: 'Oops...',
                        text: data.message,
                        type: 'error',
                        timer: '3000'
                    })
                }
            });
            }
        });
    }
</script>
@endsection

