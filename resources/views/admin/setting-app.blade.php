@extends('layout.app')

@section('title', $site_name . ' - Pengaturan Aplikasi')

@section('main')
<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 h-100 m-0 p-2 mx-auto bg-white shadow-lg">
    <div class="container">
        <div class="row">
            <div class="col-12 pt-4 pb-5 pl-1 pr-1">
                <a class="btn btn-sm btn-secondary font-weight-light shadow-sm" href="{{ route('setting.index') }}"><i class="fal fa-arrow-circle-left"></i> Kembali</a>
                <h4 class="font-weight-light mt-4">Pengaturan Aplikasi</h4>
                <hr>
                <form class="mt-4" id="form-data" action="javascript:void(0)">
                    <div class="form-group mb-5">
                        <label for="status">Nama Aplikasi</label>
                        <div class="input-group shadow-sm">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fal fa-info-circle"></i></div>
                            </div>
                            <input type="text" class="form-control font-weight-light" id="site_name" autocomplete="off" required value="{{ $site_name }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status">Pendaftaran Akun</label>
                        <div class="input-group shadow-sm">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fal fa-user"></i></div>
                            </div>
                            <select class="form-control font-weight-light" autocomplete="off" id="registration">
                                <option value="1" @if($registration==1) selected @endif>Aktif</option>
                                <option value="0" @if($registration==0) selected @endif>Non-Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group mt-5 mb-5">
                        <button class="btn btn-block btn-success font-weight-light shadow-sm" id="btn-submit" type="submit"><i class="fal fa-check-circle mr-1"></i> Simpan Pengaturan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    APP_URL = "{{ route('setting.app.update') }}";
</script>
<script src="{{ asset('assets/build/js/setting-app.js') }}"></script>
@endpush