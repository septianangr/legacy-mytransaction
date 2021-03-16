@extends('layout.app')

@section('title', $site_name . ' - Tambah Data Transaksi')

@push('styles')
<link href="{{ asset('assets/vendor/datetimepicker/css/DateTimePicker.min.css') }}" rel="stylesheet">
@endpush

@section('main')
<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 h-100 m-0 p-2 mx-auto bg-white shadow-lg">
    <div class="container">
        <div class="row">
            <div class="col-12 pt-4 pb-5 pl-1 pr-1">
                <h4 class="font-weight-light">Tambah Data Transaksi</h4>
                <hr>
                <form class="mt-4" id="form-data" action="javascript:void(0)">
                    <div class="form-group mb-5">
                        <div class="input-group shadow-sm">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fal fa-calendar"></i></div>
                            </div>
                            <input type="text" class="form-control font-weight-light bg-white" readonly id="date" data-field="date" autocomplete="off" placeholder="Tanggal Transaksi" required>
                        </div>
                    </div>
                    <div class="form-group mb-5">
                        <div class="input-group shadow-sm">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fal fa-clock"></i></div>
                            </div>
                            <input type="text" class="form-control font-weight-light bg-white" readonly id="time" data-field="time" autocomplete="off" placeholder="Waktu Transaksi" required>
                        </div>
                    </div>
                    <div class="form-group mb-5">
                        <div class="input-group shadow-sm">
                            <div class="input-group-prepend">
                                <div class="input-group-text font-weight-light">Rp. </div>
                            </div>
                            <input type="text" pattern="[0-9]*" inputmode="numeric" class="form-control font-weight-light number" id="amount" autocomplete="off" maxlength="16" placeholder="0" required>
                        </div>
                    </div>
                    <div class="form-group mb-5">
                        <div class="input-group shadow-sm">
                            <div class="input-group-prepend">
                                <div class="input-group-text font-weight-light"><i class="fal fa-info-circle"></i></div>
                            </div>
                            <input type="text" class="form-control font-weight-light" id="info" autocomplete="off" maxlength="64" placeholder="Keterangan" required>
                        </div>
                    </div>
                    <div class="form-group mt-5 mb-5">
                        <button class="btn btn-block btn-success font-weight-light shadow-sm" id="btn-submit" type="submit"><i class="fal fa-check-circle mr-1"></i> Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="date-time-box"></div>
@endsection

@push('scripts')
<script>
    APP_URL = "{{ route('mtrans.save') }}";
</script>
<script src="{{ asset('assets/vendor/datetimepicker/js/DateTimePicker.min.js') }}"></script>
<script src="{{ asset('assets/build/js/transaction-add.js') }}"></script>
@endpush