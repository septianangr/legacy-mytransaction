@extends('layout.app')

@section('title', $site_name . ' - Detail Profil Akun')

@section('main')
<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 h-100 m-0 p-2 mx-auto bg-white shadow-lg">
    <div class="container">
        <div class="row">
            <div class="col-12 pt-4 pb-5 pl-1 pr-1">
                <h4 class="font-weight-light">Detail Profil Akun</h4>
                <hr>
                <form class="mt-4" id="form-data" action="javascript:void(0)">
                    <div class="form-group mb-5">
                        <div class="input-group shadow-sm">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fal fa-user"></i></div>
                            </div>
                            <input type="text" class="form-control font-weight-light" id="name" autocomplete="off" placeholder="Nama Lengkap" required value="{{ $name }}">
                        </div>
                    </div>
                    <div class="form-group mb-5">
                        <div class="input-group shadow-sm">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fal fa-envelope"></i></div>
                            </div>
                            <input type="email" class="form-control font-weight-light" id="email" autocomplete="off" placeholder="Alamat Email" required value="{{ $email }}">
                        </div>
                    </div>
                    <div class="form-group mb-5">
                        <div class="input-group shadow-sm">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fal fa-lock"></i></div>
                            </div>
                            <input type="password" class="form-control font-weight-light" id="password" autocomplete="off" placeholder="Password Baru">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group shadow-sm">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fal fa-lock-alt"></i></div>
                            </div>
                            <input type="password" class="form-control font-weight-light" id="password_confirmation" autocomplete="off" placeholder="Konfirmasi Password">
                        </div>
                    </div>
                    <div class="form-group mt-5 mb-5">
                        <button class="btn btn-block btn-success font-weight-light shadow-sm" id="btn-submit" type="submit"><i class="fal fa-check-circle mr-1"></i> Perbarui Profil</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    APP_URL = "{{ route('profile.update') }}";
</script>
<script src="{{ asset('assets/build/js/setting-profile.js') }}"></script>
@endpush