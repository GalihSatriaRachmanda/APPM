@extends('layouts.app',['class' => 'bg-default'], ['title' => __('User Profile')])

@section('content')
<div class="header bg-gradient-primary py-7 py-lg-8">
</div>
    <div class="container-fluid mt--9">
        <div class="row justify-content-md-center">
            <div class="col-xl-11 mb-5 mb-xl-0">
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
@include('users.form')
@endsection

@section('script')
<!-- DataTables -->
<script src="{{ asset('assets') }}/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('assets') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Sweet Alert jquery-->
<script src="{{asset('assets')}}/vendor/sweet-alert/sweetalert.min.js" ></script>
<!-- Select2 -->
<script src="{{ asset('assets') }}/vendor/select2/select2.full.min.js"></script>
<!-- Validator -->
<script src="{{ asset('assets') }}/vendor/validator/validator.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        
        $('input[type=radio][name=is_password_change]').change(function() {
            $('#passwordContent').empty()
            if (this.value == 'change') {
                $('#passwordContent').append(`<div class="col-12">
                                <div class="form-group">
                                    <label for="password">Password Baru<small style="color: red;"> *required</small></label>
                                    <input required type="password" class="form-control" id="password" name="password">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="password_confirmation">Konfirmasi Password <small style="color: red;">
                                            *required</small></label>
                                    <input required type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation">
                                </div>
                            </div>`)
            }
        });

        var usersTable = $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            "oLanguage": {
                "oPaginate": {
                    "sPrevious": "<", 
                    "sNext": ">", 
                }
                },
            ajax: "{{ route('users.datatables') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'nik', name: 'nik'},
                {data: 'nama', name: 'nama'},
                {data: 'email', name: 'email'},
                {data: 'telp', name: 'telp'},
                {
                    data: 'role_name',
                    render: function (data, type, row) {
                        if(type == 'sort' || type == 'type'){
                            return data
                        } else {
                            let str = ''
                            $.each(row.roles, (key, val)=>{
                                str += `<span class="badge badge-success">${val.name}</span> `
                            })
                            return str;
                        }
                    }
                },
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

        $('#modal-form-users form').validator().on('submit', function (e) {
            if (!e.isDefaultPrevented()){
                let id = $('#modal-form-users #id').val();
                if (save_method == 'add') url = "{{ url('dashboard/users') }}";
                else url = "{{ url('dashboard/users') . '/' }}" + id;

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
//                      data : $('#modal-form-users form').serialize(),
                    data: new FormData($("#modal-form-users form")[0]),
                    contentType: false,
                    processData: false,
                    success : function(data) {
                        console.log(data)
                        $('#modal-form-users').modal('hide');
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

       
    });
        
    function refreshUsersTable() {
        $('#users-table').DataTable().draw(true)
    }

    function addUser() {
        removeUpload()
        initRoles()
        save_method = "add";
        $('#passwordOption').hide()
        $('#passwordContent').empty()
        $('#passwordContent').append(`<div class="col-12">
                            <div class="form-group">
                                <label for="password">Password <small style="color: red;"> *required</small></label>
                                <input required type="password" class="form-control" id="password" name="password">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="password_confirmation">Password Confirmation <small style="color: red;">
                                        *required</small></label>
                                <input required type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation">
                            </div>
                        </div>`)
        $('input[name=_method]').val('POST');
        $('#modal-form-users').modal('show');
        $('#modal-form-users form')[0].reset();
        $('.modal-title').text('Add User');
    }

    function editUser(id) {
        removeUpload()
        initRoles()
        save_method = 'edit';
        $('#passwordOption').show()
        $('#passwordContent').empty()
        $('input[name=_method]').val('PATCH');
        $('#modal-form-users form')[0].reset();
        $.ajax({
            url: "{{ url('dashboard/users') }}" + '/' + id + "/edit",
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                console.log(data)
                $('#modal-form-users').modal('show');
                $('.modal-title').text('Edit User');

                let rCheckboxes = $('.cb_role')
                let roles = data.roles
                $.each(rCheckboxes, (k,v)=>{
                    roles.forEach(r => {
                        if(v.value == r.name) {
                            v.checked = true
                        }
                    });
                })
                $('#modal-form-users #id').val(data.id);
                $('#modal-form-users #nik').val(data.nik);
                $('#modal-form-users #nama').val(data.nama);
                $('#modal-form-users #telp').val(data.telp);
                $('#modal-form-users #email').val(data.email);
            },
            error : function(err) {
                console.log(err)
                alert("Data not found!");
            }
        });
    }

    function deleteUser(id){
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then(function () {
            $.ajax({
                url : "{{ url('dashboard/users') }}" + '/' + id,
                type : "POST",
                data : {'_method' : 'DELETE', '_token' : csrf_token},
                success : function(data) {
                    $('#users-table').DataTable().draw(true);
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
        });
    }
    
    function initRoles(){
        $.ajax({
            url: "{{ url('dashboard/roles') }}",
            type: "GET",
            async: false,
            dataType: "JSON",
            success: function(roles) {
                let str = ''
                $.each(roles, (k,v)=>{
                    str += `<div class="col-md-6 col-12">
                                <div class="form-check">
                                    <input type="radio" for="roles" name="roles" class="cb_role form-check-input" id="${v.id}" value="${v.name}">
                                    <label class="form-check-label" for="${v.id}">${v.name}</label>
                                </div>
                            </div>`
                })
                $('.roles').html(str)
            },
            error : function(err) {
                console.log(err)
                alert("Data not found!");
            }
        });
    }

    let base_url = "{{url('/')}}"
    function readURL(input) {
        if (input.files && input.files[0]) {
            let reader = new FileReader();

            reader.onload = function(e) {
                // $('.image-upload-wrap').hide();
                $(".image-upload-wrap").css({
                    "background-image": `url(${e.target.result})`,
                    border: "0px solid #fff"
                });
                $(".image-upload-wrap h5").hide();

                $('.file-upload-input').attr('src', e.target.result);
                $(".box-remove").css("display", "absolute");
                $(".box-remove").show();

                $(".image-title").html(input.files[0].name);
            };
            $('#image_available').val(true)
            reader.readAsDataURL(input.files[0]);
        } else {
            $(".image-upload-wrap").css({
                "background-image": `url(${base_url}/assets/img/attachment-3.jpg)`,
                border: "2px dashed #949494"
            });
            $('#image_available').val(false)
            $(".image-upload-wrap h5").show();
            $(".box-remove").hide();
        }
    }

    function removeUpload() {
        $(".file-upload-input").val(null);
        $(".box-remove").hide();
        // $('.image-upload-wrap').show();
        $(".image-upload-wrap").css({
            "background-image": `url(${base_url}/assets/img/attachment-3.jpg)`,
            border: "2px dashed #949494"
        });
        $('#image_available').val(false)
        $(".image-upload-wrap h5").show();
    }
</script>
@endsection