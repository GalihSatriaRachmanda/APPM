@extends('layouts.app',['class' => 'bg-gradient-default'],  ['title' => __('User Profile')])

@section('content')
<div class="header bg-gradient-primary py-7 py-lg-8">
</div>
    <div class="container-fluid mt--9 pb-5">
        <div class="row justify-content-md-center">
            <div class="col-xl-11 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">{{ __('Edit Profile') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" id="update" autocomplete="off" enctype="multipart/form-data">
                            {{ csrf_field() }} {{ method_field('POST') }}

                            <h6 class="heading-small text-muted mb-4">{{ __('User information') }}</h6>
                            
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <input type="hidden" id="id" value="{{auth()->user()->id}}" name="id">

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('nama') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Nama') }}</label>
                                    <input type="text" name="nama" id="input-name" class="form-control form-control-alternative{{ $errors->has('nama') ? ' is-invalid' : '' }}" placeholder="{{ __('Nama') }}" value="{{ old('nama', auth()->user()->nama) }}" required autofocus>

                                    @if ($errors->has('nama'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nama') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('nik') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">{{ __('NIK') }}</label>
                                        <input class="form-control{{ $errors->has('nik') ? ' is-invalid' : '' }}" placeholder="{{ __('nik') }}" type="text" name="nik" value="{{ old('nik', auth()->user()->nik) }}" required autofocus>
                                    
                                    @if ($errors->has('nik'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('nik') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('telp') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">{{ __('Nomor Telepon') }}</label>
                                        <input class="form-control{{ $errors->has('telp') ? ' is-invalid' : '' }}" placeholder="{{ __('telp') }}" type="text" name="telp" value="{{ old('telp', auth()->user()->telp) }}" required autofocus>
                                    
                                    @if ($errors->has('telp'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('telp') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                    <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email', auth()->user()->email) }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                        <hr class="my-4" />
                        <form method="post" id="password" autocomplete="off" enctype="multipart/form-data">
                            {{ csrf_field() }} {{ method_field('POST') }}

                            <h6 class="heading-small text-muted mb-4">{{ __('Password') }}</h6>

                            @if (session('password_status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('password_status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <input type="hidden" id="id" value="{{auth()->user()->id}}" name="id">

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-current-password">{{ __('Current Password') }}</label>
                                    <input type="password" name="old_password" id="input-current-password" class="form-control form-control-alternative{{ $errors->has('old_password') ? ' is-invalid' : '' }}" placeholder="{{ __('Current Password') }}" value="" required>
                                    
                                    @if ($errors->has('old_password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('old_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-password">{{ __('New Password') }}</label>
                                    <input type="password" name="password" id="input-password" class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" value="" required>
                                    
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-password-confirmation">{{ __('Confirm New Password') }}</label>
                                    <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control form-control-alternative" placeholder="{{ __('Confirm New Password') }}" value="" required>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Change password') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.nav')
    </div>
@endsection

@section('script')
<!-- Sweet Alert jquery-->
<script src="{{asset('assets')}}/vendor/sweet-alert/sweetalert.min.js" ></script>
<!-- Validator -->
<script src="{{ asset('assets') }}/vendor/validator/validator.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#password').validator().on('submit', function (e) {
        if (!e.isDefaultPrevented()){
            let id = $('#id').val();
            url = "{{ url('dashboard/profile/password') . '/' }}" + id;

            $.ajax({
                url : url,
                type : "POST",
                //hanya untuk input data tanpa dokumen
//                     data : $('#modal-form-users form').serialize(),
                data: new FormData($("#password")[0]),
                contentType: false,
                processData: false,
                success : function(data) {
                    console.log(data)
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

    $('#update').validator().on('submit', function (e) {
        if (!e.isDefaultPrevented()){
            let id = $('#id').val();
            url = "{{ url('dashboard/profile/data') . '/' }}" + id;

            $.ajax({
                url : url,
                type : "POST",
                //hanya untuk input data tanpa dokumen
//                     data : $('#modal-form-users form').serialize(),
                data: new FormData($("#update")[0]),
                contentType: false,
                processData: false,
                success : function(data) {
                    console.log(data)
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
</script>
@endsection