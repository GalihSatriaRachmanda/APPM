<div class="modal fade" id="modal-form-users" tabindex="-1" role="dialog" aria-labelledby="modal-formLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal Header</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form autocomplete="off" id="form-item" method="post" class="needs-validation" data-toggle="validator"
                enctype="multipart/form-data">
                {{ csrf_field() }} {{ method_field('POST') }}
                <input type="hidden" id="id" name="id">
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="nama">Nama <small style="color: red;"> *required</small></label>
                                <input type="text" class="form-control" id="nama" name="nama" autofocus required>
                                <span class="text-danger help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="nik">NIK <small style="color: red;"> *required</small></label>
                                <input type="text" class="form-control" id="nik" name="nik" autofocus required>
                                <span class="text-danger help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="email">Email <small style="color: red;"> *required</small></label>
                                <input type="email" class="form-control" id="email" name="email" autofocus required>
                                <span class="text-danger help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="telp">Nomor Telepon</label>
                                <input type="text" value="{{Auth::user()->telp}}" class="form-control" id="telp" name="telp">
                                <span class="text-danger help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Roles</label>
                                <input type="hidden" name="role_name" id="role_name">
                                <div class="row roles"></div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div id="passwordOption" class="form-group my-1 mb-0 custom-radio-ml">
                                <div class="radio radio-primary">
                                    <input checked type="radio" name="is_password_change" id="no_change" value="no_change">
                                    <label for="no_change">Password tidak berubah</label>
                                </div>
                                <div class="radio radio-secondary">
                                    <input type="radio" name="is_password_change" id="change" value="change">
                                    <label for="change">Ganti password</label>
                                </div>
                            </div>
                            <div class="row" id="passwordContent">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </form>
        </div>
    </div>
</div>