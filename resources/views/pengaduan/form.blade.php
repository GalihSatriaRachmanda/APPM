<div class="modal fade" id="modal-form-tanggapan" tabindex="-1" role="dialog" aria-labelledby="modal-formLabel" aria-hidden="true">
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
                        <input type="hidden" for="id_pengaduan" id="id_pengaduan" name="id_pengaduan" value="{{$pengaduan->id}}">
                        <input type="hidden" for="id_user" id="id_user" name="id_user" value="{{Auth::user()->id}}">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="tanggapan">Tanggapan</label>
                                <textarea class="form-control" style="resize:none" rows="5" placeholder="{{ __('Ketik isi tanggapan anda*') }}" type="text" name="tanggapan" required autofocus></textarea>
                                <span class="text-danger help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Status</label>
                                <input type="hidden" name="status" id="status">
                                <div class="row ">
                                    <div class="col-md-6 col-12">
                                        <div class="form-check">
                                            <input type="radio" for="status" name="status" class="cb_role form-check-input" id="status1" value="belum di proses">
                                            <label class="form-check-label" for="status1">Belum di proses</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-check">
                                            <input type="radio" for="status" name="status" class="cb_role form-check-input" id="status2" value="proses">
                                            <label class="form-check-label" for="status2">Proses</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-check">
                                            <input type="radio" for="status" name="status" class="cb_role form-check-input" id="status3" value="selesai">
                                            <label class="form-check-label" for="status3">Selesai</label>
                                        </div>
                                    </div>
                                </div>
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

<div class="modal fade" id="modal-form-roles" tabindex="-1" role="dialog" aria-labelledby="modal-formLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal Header</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="form-item" method="post" class="form-horizontal" data-toggle="validator"
                enctype="multipart/form-data">
                {{ csrf_field() }} {{ method_field('POST') }}
                <input type="hidden" id="id" name="id">
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name">Name <small style="color: red;"> *required</small></label>
                                <input type="text" class="form-control" id="name" name="name" required autofocus>
                                <span class="text-danger help-block with-errors"></span>
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