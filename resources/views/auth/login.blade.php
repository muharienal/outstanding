@extends('layouts.auth.app')

@section('title', 'Login')

@section('content')
<div class="background-container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card" style="margin-top: -40px;">
                <div class="card-body p-4" style="font-family: 'Dosis', sans-serif;">
                    <div class="text-center mt-2">
                        <img src="{{ asset('assets/images/logo-login.webp') }}" alt="" height="175" />
                        <h5 class="mt-3 text-muted">Selamat Datang, Silahkan Login!</h5>
                    </div>
                    <div class="p-2 mt-4">
                        <form action="{{ route('login') }}" method="POST">
                            @csrf

                            <div class="mb-3" id="input-email">
                                <label for="nik" class="form-label"><b>NIK<b></label>
                                <input type="nik" class="form-control" id="nik" placeholder="Masukkan NIK"
                                    name="nik" value="{{ old('email') }}" autocomplete="nik" autofocus tabindex="1">
                                <x-form.validation.error name="nik" />
                            </div>

                            <div class="mb-3" id="input-password">
                                <div class="float-end">
                                    <a href="{{ route('password.request') }}" class="text-muted">Forgot password?</a>
                                </div>
                                <label class="form-label" for="password-input"><b>Password<b></label>
                                <div class="position-relative auth-pass-inputgroup mb-3">
                                    <input type="password" class="form-control pe-5 password-input"
                                        placeholder="Masukkan Password" id="password-input" name="password"
                                        autocomplete="current-password" tabindex="2">
                                    <button
                                        class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                        type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                    <x-form.validation.error name="password" />
                                </div>
                            </div>

                            {{-- <div class="mb-3 d-none" id="input-nik">
              <label for="nik" class="form-label">No NIK</label>
              <input type="teks" class="form-control" id="nik" placeholder="Enter NO NIK" name="nik"
                value="{{ old('nik') }}">
              <x-form.validation.error name="nik" />
            </div> --}}

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="auth-remember-check"
                                    name="remember" {{ old('remember') ? 'checked' : '' }} tabindex="3">
                                <label class="form-check-label" for="auth-remember-check"><b>Ingat Saya<b></label>
                            </div>

                            <div class="mt-4">
                            <button class="btn btn-success w-100" type="submit" tabindex="4" style="background-color: #ff6b18; border: none; outline: none;"><b>MASUK<b></button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
</div>
@endsection

@push('script')
<script>
        $(document).ready(() => {
            // Add fade-in animation to the login card
            $('#login-card').hide().fadeIn(200);

            const btnLoginWithEmail = $('#btn-login-with-email');
            const btnLoginWithnik = $('#btn-login-with-nik');

            const inputEmail = $('#input-email');
            const inputPassword = $('#input-password');
            const inputNik = $('#input-nik');

            btnLoginWithEmail.click(() => {
                // show input email, password
                inputEmail.removeClass('d-none');
                inputPassword.removeClass('d-none');

                // hide input nik
                inputNik.addClass('d-none');
            });

            btnLoginWithnik.click(() => {
                // show input nik
                inputNik.removeClass('d-none');

                // hide input email, password
                inputEmail.addClass('d-none');
                inputPassword.addClass('d-none');
            });
        });
    </script>
@endpush

<style>
    /* Custom styles for the background image */
    body {
        margin: 0;
        padding: 0;
        background-image: url('assets/images/pabrik-pg.webp');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        min-height: 100vh;
        position: relative;
    }

    .row {
        position: relative;
        z-index: 1; /* Ensure the card content appears above the background */
    }
</style>