@extends('layout.app')

@section('title', $site_name . ' - Daftar Data Transaksi')

@section('main')
<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 h-auto m-0 p-2 mx-auto bg-white shadow-lg" style="min-height: 100%">
    <div class="container">
        <div class="row">
            <div class="col-12 pt-4 pl-1 pr-1">
                <h4 class="font-weight-light">Daftar Transaksi</h4>
                <hr>
                <div class="d-flex mb-4">
                    <div class="w-50">
                        <div class="input-group shadow-sm">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fal fa-calendar"></i></div>
                            </div>
                            <select class="form-control form-control-sm font-weight-light" autocomplete="off" id="period">
                                <option value="yesterday">Kemarin</option>
                                <option value="today">Hari Ini</option>
                                <option value="last7" selected>7 Hari Terakhir</option>
                                <option value="last30">30 Hari Terakhir</option>
                                <option value="all">Semua Tanggal</option>
                            </select>
                        </div>
                    </div>
                    <div class="w-50 ml-1">
                        <div class="input-group shadow-sm">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fal fa-search"></i></div>
                            </div>
                            <input type="text" class="form-control form-control-sm font-weight-light" autocomplete="off" id="keyword" placeholder="Kata Kunci">
                        </div>
                    </div>
                </div>
                <div id="content"></div>
                <p class="mb-5 pb-5 text-center">
                    <a href="#" class="btn btn-dark font-weight-light shadow-sm" id="to-top" style="display: none;" title="Kembali ke atas"><i class="fal fa-chevron-up"></i></a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    APP_URL_1 = "{{ route('mtrans.get') }}";
    APP_URL_2 = "{{ route('mtrans.delete') }}";
</script>
<script src="{{ asset('assets/build/js/transaction.js') }}"></script>
@endpush