
<div class="container-fluid mt--8 ">
    <div class="row mb-7 justify-content-md-center">
        <div class="col-xl-12 mb-5 mb-xl-0 text-center">
        <a type="button"  href="{{ url('login')}}" class="btn btn-info mt-4"><i class="fas fa-bullhorn"></i>{{ __(' Laporkan') }}</a>
        </div>
    </div>
    <div class="row justify-content-md-center">
        <div class="col-xl-3 mb-5 mb-xl-0">
            <div class="card bg-secondary shadow">
                <div class="card-body px-lg-2">
                    <div class="container px-lg-5">
                        <img alt="Tulis" style="object-fit: contain; width:100%;" class="my-10 transform transition hover:scale-125 duration-300 ease-in-out"
                        src="{{ asset('img/assets/writing.svg')}}" />
                    </div>
                    <div class="container mt-4 text-center ">
                        <h1 class="text-lg font-bold">1. Tulis Laporan</h1>
                        <p class="text-grey-darker text-sm">
                        Tulis laporan keluhan Anda dengan jelas.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 mb-5 mb-xl-0">
            <div class="card bg-secondary shadow">
                <div class="card-body px-lg-2">
                    <div class="container px-lg-5">
                        <img alt="Tulis" style="object-fit: contain; width:100%;" class="my-10 transform transition hover:scale-125 duration-300 ease-in-out"
                        src="{{ asset('img/assets/process.svg')}}" />
                    </div>
                    <div class="container mt-4 text-center ">
                        <h1 class="text-lg font-bold">2. Proses Verifikasi</h1>
                        <p class="text-grey-darker text-sm">
                        Tunggu sampai laporan Anda di proses.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 mb-5 mb-xl-0">
            <div class="card bg-secondary shadow">
                <div class="card-body px-lg-2">
                    <div class="container px-lg-5">
                        <img alt="Tulis" style="object-fit: contain; width:100%;" class="my-10 transform transition hover:scale-125 duration-300 ease-in-out"
                        src="{{ asset('img/assets/settings.svg')}}" />
                    </div>
                    <div class="container mt-4 text-center ">
                        <h1 class="text-lg font-bold">3. Tindak Lanjut</h1>
                        <p class="text-grey-darker text-sm">
                        Laporan Anda sedang dalam tindak lanjut.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 mb-5 mb-xl-0">
            <div class="card bg-secondary shadow">
                <div class="card-body px-lg-2">
                    <div class="container px-lg-5">
                        <img alt="Tulis" style="object-fit: contain; width:100%;" class="my-10 transform transition hover:scale-125 duration-300 ease-in-out"
                        src="{{ asset('img/assets/shield.svg')}}" />
                    </div>
                    <div class="container mt-4 text-center ">
                        <h1 class="text-lg font-bold">4. Selesai</h1>
                        <p class="text-grey-darker text-sm">
                        Laporan pengaduan telah selesai ditindak.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.nav')
</div>