@extends('layouts.app', ['title' => __('User Profile')] , ['class' => 'bg-default'])

@section('content')
<div class="header bg-gradient-primary py-7 mb-7 py-lg-6">
    <div class="container">
        <div class="header-body text-center mb-3">
            <div class="row justify-content-center">    
                <div class="col-lg-12 col-md-6">
                    <h1 class="text-white">{{ __('List Laporan') }}</h1>
                    <hr style="width:150px; border: 3px solid white; border-radius: 5px;">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid mt--9 ">
        <div class="row justify-content-md-center">
            <div class="col-xl-11 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-body bg-secondary">
                        <div class="default-tab">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-public-tab" data-toggle="tab" href="#nav-public"
                                        role="tab" aria-controls="nav-public" aria-selected="true">Public</a>
                                    <a class="nav-item nav-link" id="nav-private-tab" data-toggle="tab" href="#nav-private"
                                        role="tab" aria-controls="nav-private" aria-selected="false">Private</a>
                                </div>
                            </nav>
                            <div class="tab-content pl-3 pt-4" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-public" role="tabpanel"aria-labelledby="nav-public-tab">
                                    <div class="d-flex justify-content-between mb-3">
                                        <span></span>
                                        <div class="btn-group btn-group-md mb-3">
                                            <button onclick="refreshTable()" type="button"
                                            class="btn btn-outline-primary btn-sm" title="Refresh data"><i
                                            class="fa fa-refresh"></i> Refresh</button>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table style="width: 100% !important" id="tabel_public" class="table align-items-center">
                                            <thead>
                                                <tr>
                                                    <th>Judul</th>
                                                    <th>tanggal laporan</th>
                                                    <th>status</th>
                                                    <th>Option</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-private" role="tabpanel"aria-labelledby="nav-private-tab">
                                    <div class="d-flex justify-content-between mb-3">
                                        <span></span>
                                        <div class="btn-group btn-group-md mb-3">
                                            <button onclick="refreshTable()" type="button"
                                            class="btn btn-outline-primary btn-sm" title="Refresh data"><i
                                            class="fa fa-refresh"></i> Refresh</button>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table style="width: 100% !important" id="tabel_private" class="table align-items-center">
                                            <thead>
                                                <tr>
                                                    <th>Judul</th>
                                                    <th>tanggal laporan</th>
                                                    <th>tipe</th>
                                                    <th>status</th>
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
            </div>
        </div>
    </div>
    @include('layouts.footers.nav')
</div>

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
    var table1 = $('#tabel_public').DataTable({
        "bLengthChange": false,
        "bFilter": true,
        processing: true,
        serverSide: true,
        responsive: true,
        "oLanguage": {
        "oPaginate": {
            "sPrevious": "<", 
            "sNext": ">", 
        }
        },
        ajax: "{{ route('laporan.datatables.public') }}",
        columns: [
            {data: 'judul', name: 'judul'},
            {data: 'tgl_pengaduan', name: 'tgl_pengaduan'},
            {data: 'status',  
                render: function (data, type, row) {
                    if(row.status == 'belum di proses'){
                        return  `<span class="badge badge-danger">${row.status}</span> `;
                    }else if(row.status == 'proses'){
                        return  `<span class="badge badge-warning">${row.status}</span> `;
                    }else if(row.status == 'selesai'){
                        return  `<span class="badge badge-success">${row.status}</span> `;
                    }
            }},
            {data: 'periksa', name: 'periksa', orderable: false, searchable: false}
        ]
    });
    var table2 = $('#tabel_private').DataTable({
        "bLengthChange": false,
        "bFilter": true,
        processing: true,
        serverSide: true,
        responsive: true,
        "oLanguage": {
        "oPaginate": {
            "sPrevious": "<", 
            "sNext": ">", 
        }
        },
        ajax: "{{ route('laporan.datatables.private') }}",
        columns: [
            {data: 'judul', name: 'judul'},
            {data: 'tgl_pengaduan', name: 'tgl_pengaduan'},
            {data: 'visible', name: 'visible'},
            {data: 'status',  
                render: function (data, type, row) {
                    if(row.status == 'belum di proses'){
                        return  `<span class="badge badge-danger">${row.status}</span> `;
                    }else if(row.status == 'proses'){
                        return  `<span class="badge badge-warning">${row.status}</span> `;
                    }else if(row.status == 'selesai'){
                        return  `<span class="badge badge-success">${row.status}</span> `;
                    }
            }},
            {data: 'periksa', name: 'periksa', orderable: false, searchable: false}
        ]
    });
});
        
    function refreshTable() {
        $('#tabel_private').DataTable().draw(true)
        $('#tabel_public').DataTable().draw(true)
    }
</script>
@endsection

