<div class="header bg-gradient-primary py-7 py-lg-7">
    @if(session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <span class="alert-icon"><i class="ni ni-like-2"></i></span>
        <span class="alert-text">{{ session()->get('message') }}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="container">
        <div class="header-body text-center mb-3">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-6">
                    <h1 class="text-white">{{ __('Layanan Pelaporan Pengaduan Online Masyarakat') }}</h1>
                    <h3 class="text-white lead">{{ __('Sampaikan Laporan anda kepada pihak berwenang') }}</h3>
                    <hr style="width:150px; border: 3px solid white; border-radius: 5px;">
                </div>
            </div>
        </div>
    </div>
</div>
