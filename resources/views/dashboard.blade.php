@extends('layouts.app', ['class' => 'bg-gradient-default'])

@section('content')
    @guest()
        @include('layouts.headers.welcome')
        @include('dashboard.user')
    @endguest
    @hasanyrole('user')
        @include('layouts.headers.welcome')
        @include('dashboard.user')
    @endhasanyrole
    @hasanyrole('admin|petugas')
        @include('layouts.headers.cards')
        @include('dashboard.petugas')
    @endhasanyrole
@endsection

@push('js')
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
            var table1 = $('#tabel_none').DataTable({
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
                ajax: "{{ route('laporan.datatables.none') }}",
                columns: [
                    {data: 'judul', name: 'judul'},
                    {data: 'nama', name: 'nama'},
                    {data: 'tgl_pengaduan', name: 'tgl_pengaduan'},
                    {data: 'status', name: 'status'},
                    {data: 'periksa', name: 'periksa', orderable: false, searchable: false}
                ]
            });
            var table2 = $('#tabel_proses').DataTable({
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
                ajax: "{{ route('laporan.datatables.proses') }}",
                columns: [
                    {data: 'judul', name: 'judul'},
                    {data: 'nama', name: 'nama'},
                    {data: 'tgl_pengaduan', name: 'tgl_pengaduan'},
                    {data: 'status', name: 'status'},
                    {data: 'last_update', name:'last_update'},
                    {data: 'periksa', name: 'periksa', orderable: false, searchable: false}
                ]
            });
            var table3 = $('#tabel_selesai').DataTable({
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
                ajax: "{{ route('laporan.datatables.selesai') }}",
                columns: [
                    {data: 'judul', name: 'judul'},
                    {data: 'nama', name: 'nama'},
                    {data: 'tgl_pengaduan', name: 'tgl_pengaduan'},
                    {data: 'status', name: 'status'},
                    {data: 'periksa', name: 'periksa', orderable: false, searchable: false}
                ]
            });
           
        } );
            
        function refreshTable() {
            $('#tabel_none').DataTable().draw(true)
            $('#tabel_proses').DataTable().draw(true)
            $('#tabel_selesai').DataTable().draw(true)
        }
    </script>
@endpush