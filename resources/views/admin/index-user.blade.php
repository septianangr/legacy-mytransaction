@extends('layout.app')

@section('title', $site_name . ' - Daftar Data Pengguna')

@section('main')
<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 h-auto m-0 p-2 mx-auto bg-white shadow-lg" style="min-height: 100%">
    <div class="container">
        <div class="row">
            <div class="col-12 pt-4 pb-5 pl-1 pr-1">
                <h4 class="font-weight-light">Daftar Pengguna</h4>
                <hr>
                <div class="d-flex mb-4">
                    <div class="w-50">
                        <div class="input-group shadow-sm">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fal fa-list"></i></div>
                            </div>
                            <select class="form-control form-control-sm font-weight-light" autocomplete="off" id="length">
                                <option value="10" selected>10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="0">Semua Data</option>
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
                <div class="mb-5 pb-5" id="content"></div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    APP_URL_1 = "{{ route('user.get') }}";
    APP_URL_2 = "{{ route('user.update') }}";
    APP_URL_3 = "{{ route('user.delete') }}";
</script>
<script src="{{ asset('assets/build/js/user.js') }}"></script>
@endpush