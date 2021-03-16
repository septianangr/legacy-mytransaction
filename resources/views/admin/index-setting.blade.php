@extends('layout.app')

@section('title', $site_name . ' - Pengaturan Umum')

@section('main')
<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 h-100 m-0 p-2 mx-auto bg-white shadow-lg">
    <div class="container">
        <div class="row">
            <div class="col-12 pt-4 pl-1 pr-1">
                <div class="card shadow-sm" onclick="location.href='{{ route("setting.app") }}'" style="cursor: pointer">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="pt-1 mr-3">
                                <i class="fal fa-window fa-4x"></i>
                            </div>
                            <div class="p-2">
                                <h6 class="card-title mb-0">Pengaturan Aplikasi</h6>
                                <p class="card-text mt-2">
                                    Nama aplikasi dan Pendaftaran akun.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow-sm mt-4" onclick="location.href='{{ route("setting.profile") }}'" style="cursor: pointer">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="pt-1 mr-4">
                                <i class="fal fa-user fa-4x"></i>
                            </div>
                            <div class="p-2">
                                <h6 class="card-title mb-0">Pengaturan Profil</h6>
                                <p class="card-text mt-2">
                                    Data profil dan Password login akun.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection