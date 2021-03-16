@extends('layout.app')

@section('title', $site_name . ' - Halaman Beranda')

@section('main')
<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 h-100 m-0 p-2 mx-auto bg-white shadow-lg">
    <div class="container">
        <div class="row">
            <div class="col-12 pt-4 pl-1 pb-5 pr-1">
                <h5 class="font-weight-light">{{ $full_name }},</h5>
                <p>Berikut rincian biaya pengeluaran Kamu.</p>
                <div class="card shadow-sm mt-4">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="mr-3 pt-3">
                                <i class="fal fa-money-check-alt fa-4x"></i>
                            </div>
                            <div class="p-2">
                                <h6 class="card-title mb-0">Pengeluaran Bulan Lalu</h6>
                                <small class="text-muted">{{ date('M Y', strtotime('-1 month')) }}</small>
                                <p class="card-text mt-2 text-danger">
                                    Rp. {{ number_format($epLastMonth) }}
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
                                <h6 class="card-title mb-0">Pengeluaran Bulan Ini</h6>
                                <small class="text-muted">{{ date('M Y') }}</small>
                                <p class="card-text mt-2 text-danger">
                                    Rp. {{ number_format($epThisMonth) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow-sm mt-4">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="mr-3 pt-3">
                                <i class="fal @if ($epThisMonth >= $epLastMonth) fa-chart-line @else fa-chart-line-down @endif fa-4x"></i></i>
                            </div>
                            <div class="ml-3 p-2">
                                <h6 class="card-title mb-0">Presentase Pengeluaran</h6>
                                <small class="text-muted">{{ date('M Y', strtotime('-1 month')) }} - {{ date('M Y') }}</small>
                                <p class="card-text mt-2 @if ($epThisMonth >= $epLastMonth) text-danger @else text-success @endif">
                                    @if ($epThisMonth >= $epLastMonth) Naik @else Turun @endif {{ $presentase }}%</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow-sm mt-4 mb-5 pb-2">
                    <div class="card-body pt-2 pb-2 pl-3">
                        <h6 class="card-title mb-0">Total Keseluruhan</h6>
                        <p class="card-text mt-1 text-danger">
                            Rp. {{ number_format($epTotal) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection