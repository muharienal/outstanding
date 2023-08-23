@extends('layouts.auth.app')

@section('title', 'Login')

@section('content')
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Noto Sans'>

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
        overflow: hidden; /* Hide both horizontal and vertical scrollbars */
        font-family: 'Noto Sans';
    }

    .row {
        position: relative;
        z-index: 1; /* Ensure the card content appears above the background */
    }

    .card {
        margin-top: -5px;
        padding: 1rem 2rem; /* top right bottom left */
    }

    .card.rounded-30 {
        border-radius: 30px;
        box-shadow: 0px 17px 20px 6px rgba(0, 0, 0, 0.20);
    }

    .form-label {
        color: var(--gray-700, #344054);
        font-weight: 700;
    }

    .scaled-card {
        transform: scale(0.9); /* Scale down to 90% */
        transform-origin: top; /* Keep top as the reference point */
    }

    .custom-text {
        font-weight: normal; /* or any other desired font weight value */
    }
</style>

<div class="background-container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="text-center">
                <img src="{{ asset('assets/images/logo-official.webp') }}" alt="Above Card Image"
                     class="mb-4" style="width: 70%; height: auto; margin-top: -55px;" />
            </div>
            <div class="card rounded-30 scaled-card">
                <div class="card-body p-4">
                    <div class="text-center mt-2">
                        <img src="{{ asset('assets/images/logo-login.webp') }}" alt="" height="150" />
                    </div>
                    <div class="p-2 mt-4">
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="mb-3" id="input-email">
                                <label for="nik" class="form-label"><b>NIK SAP</b></label>
                                <input type="nik" class="form-control" id="nik"
                                       placeholder="Masukan NIK SAP anda" name="nik"
                                       value="{{ old('email') }}" autocomplete="nik" autofocus tabindex="1">
                                <x-form.validation.error name="nik" />
                            </div>
                            <div class="mb-3" id="input-password">
                                <div class="float-end">
                                    <a href="{{ route('password.request') }}" class="text-muted">Lupa password?</a>
                                </div>
                                <label class="form-label" for="password-input"><b>Password</b></label>
                                <div class="position-relative auth-pass-inputgroup mb-3">
                                    <input type="password" class="form-control pe-5 password-input"
                                           placeholder="*******" id="password-input" name="password"
                                           autocomplete="current-password" tabindex="2">
                                    <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                            type="button" id="password-addon">
                                        <i class="ri-eye-fill align-middle"></i>
                                    </button>
                                    <x-form.validation.error name="password" />
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="auth-remember-check"
                                       name="remember" {{ old('remember') ? 'checked' : '' }} tabindex="3">
                                <label class="form-check-label" for="auth-remember-check"><b>Ingat Saya</b></label>
                            </div>
                            <div class="mt-4">
                                <button class="btn btn-success w-100" type="submit" tabindex="4"
                                        style="background-color: #E5A100; border: none; outline: none; border-radius: 8px; box-shadow: 0px 10px 20px 0px rgba(16, 24, 40, 0.20); height: 40px;">
                                    <b>MASUK</b>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <p class="custom-text">Candal Rutin III © 2023</p>
                </div>
            </div>
        </div>
    </div>
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
