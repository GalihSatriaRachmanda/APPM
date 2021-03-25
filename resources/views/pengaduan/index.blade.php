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
                            <h3 class="mb-0">{{ __('List Pengaduan') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <span></span>
                            <div class="btn-group btn-group-md mb-3">
                                <button onclick="refreshTable()" type="button"
                                    class="btn btn-outline-primary btn-sm" title="Refresh data"><i
                                        class="fa fa-refresh"></i> Refresh</button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="pengaduan-table" class="table align-items-center">
                                <thead>
                                    <tr>
                                        <th>Judul</th>
                                        <th>Lokasi</th>
                                        <th>tanggal laporan</th>
                                        <th>Periksa</th>
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
        var table = $('#pengaduan-table').DataTable({
            "bLengthChange": false,
            "bFilter": true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('laporan.datatables') }}",
            columns: [
                {data: 'judul', name: 'judul'},
                {data: 'lokasi', name: 'lokasi'},
                {data: 'tgl_pengaduan', name: 'tgl_pengaduan'},
                {data: 'periksa', name: 'periksa', orderable: false, searchable: false}
            ]
        });
    } );
        
    function refreshTable() {
        $('#pengaduan-table').DataTable().draw(true)
    }
</script>
@endsection

