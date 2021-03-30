<div class="container-fluid mt--7 ">
        <div class="row justify-content-md-center">
            <div class="col-xl-11 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <h3 class="mb-0">{{ __('Laporan') }}</h3>
                        </div>
                    </div>
                    <div class="card-body bg-secondary">
                        <div class="default-tab">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-none-tab" data-toggle="tab" href="#nav-none"
                                        role="tab" aria-controls="nav-none" aria-selected="true">Belum</a>
                                    <a class="nav-item nav-link" id="nav-proses-tab" data-toggle="tab" href="#nav-proses"
                                        role="tab" aria-controls="nav-proses" aria-selected="false">Proses</a>
                                    <a class="nav-item nav-link" id="nav-selesai-tab" data-toggle="tab" href="#nav-selesai"
                                        role="tab" aria-controls="nav-selesai" aria-selected="false">Selesai</a>
                                </div>
                            </nav>
                            <div class="tab-content pl-3 pt-4" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-none" role="tabpanel"aria-labelledby="nav-none-tab">
                                    <div class="d-flex justify-content-between mb-3">
                                        <span></span>
                                        <div class="btn-group btn-group-md mb-3">
                                            <button onclick="refreshTable()" type="button"
                                            class="btn btn-outline-primary btn-sm" title="Refresh data"><i
                                            class="fa fa-refresh"></i> Refresh</button>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table style="width: 100% !important" id="tabel_none" class="table align-items-center">
                                            <thead>
                                                <tr>
                                                    <th>Judul</th>
                                                    <th>Nama Pengirim</th>
                                                    <th>Tanggal Laporan</th>
                                                    <th>Status</th>
                                                    <th>Option</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-proses" role="tabpanel"aria-labelledby="nav-proses-tab">
                                    <div class="d-flex justify-content-between mb-3">
                                        <span></span>
                                        <div class="btn-group btn-group-md mb-3">
                                            <button onclick="refreshTable()" type="button"
                                            class="btn btn-outline-primary btn-sm" title="Refresh data"><i
                                            class="fa fa-refresh"></i> Refresh</button>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table style="width: 100% !important" id="tabel_proses" class="table align-items-center">
                                            <thead>
                                                <tr>
                                                    <th>Judul</th>
                                                    <th>Nama Pengirim</th>
                                                    <th>Tanggal Laporan</th>
                                                    <th>Tanggapan Terakhir</th>
                                                    <th>Status</th>
                                                    <th>Option</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-selesai" role="tabpanel"aria-labelledby="nav-selesai-tab">
                                    <div class="d-flex justify-content-between mb-3">
                                        <span></span>
                                        <div class="btn-group btn-group-md mb-3">
                                            <button onclick="refreshTable()" type="button"
                                            class="btn btn-outline-primary btn-sm" title="Refresh data"><i
                                            class="fa fa-refresh"></i> Refresh</button>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table style="width: 100% !important" id="tabel_selesai" class="table align-items-center">
                                            <thead>
                                                <tr>
                                                    <th>Judul</th>
                                                    <th>Nama Pengirim</th>
                                                    <th>Tanggal Laporan</th>
                                                    <th>Status</th>
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