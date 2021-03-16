@extends('layout.app')

@section('title', $site_name . ' - Halaman Beranda')

@section('main')
<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 h-100 m-0 p-2 mx-auto bg-white shadow-lg">
    <div class="container">
        <div class="row">
            <div class="col-12 pt-4 pb-5 pl-1 pr-1">
                <h5 class="font-weight-light">Halo {{ $full_name }},</h5>
                <p>Berikut rincian data aplikasi.</p>
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="mr-3 pt-3">
                                <i class="fal fa-users fa-4x"></i>
                            </div>
                            <div class="p-2">
                                <h6 class="card-title mb-0">Total Admin</h6>
                                <p class="card-text mt-2">
                                    {{ number_format($admins) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow-sm mt-4">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="mr-3 pt-3">
                                <i class="fal fa-users fa-4x"></i>
                            </div>
                            <div class="p-2">
                                <h6 class="card-title mb-0">Total Pengguna</h6>
                                <p class="card-text mt-2">
                                    {{ number_format($users) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow-sm mt-4">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="mr-3 pt-3">
                                <i class="fal fa-money-check-alt fa-4x"></i>
                            </div>
                            <div class="p-2">
                                <h6 class="card-title mb-0">Total Transaksi</h6>
                                <p class="card-text mt-2">
                                    Rp. {{ number_format($transactions) }}
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