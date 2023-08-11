@extends('layouts.dashboard.app')

@section('title', 'User Profile')

@section('content')
<div class="card">
    <div class="card-header">
        Profile
    </div>
    <div class="card-body">
        <form action="{{ route('user.profile.update', auth()->user()->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="email" class="form-label">email</label>
                <input type="text" class="form-control" id="email" value="{{ auth()->user()->email }}" disabled>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}">
                <x-form.validation.error name="name" />
            </div>

            <div class="mb-3">
                <label for="nik" class="form-label">NIK</label>
                <input type="number" class="form-control" id="nik" name="nik" value="{{ auth()->user()->nik }}">
                <x-form.validation.error name="nik" />
            </div>

            <div class="mb-3">
                <label for="jabatan" class="form-label">Jabatan</label>
                <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{ auth()->user()->jabatan }}">
                <x-form.validation.error name="jabatan" />
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">No HP</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ auth()->user()->phone }}">
                <x-form.validation.error name="phone" />
            </div>

            <div class="mb-3">
                <label for="avatar" class="form-label">Foto</label>
                <input type="file" class="form-control" id="avatar" name="avatar">
                <x-form.validation.error name="avatar" />
            </div>

            <button type="submit" class="btn btn-primary mt-3">Update</button>
        </form>
    </div>
</div>
@endsection

@push('plugin-css')
<!-- swiper css -->
<link rel="stylesheet" href="{{ asset('assets/libs/swiper/swiper-bundle.min.css') }}">
@endpush

@push('plugin-script')
<!-- swiper js -->
<script src="{{ asset('assets/libs/swiper/swiper-bundle.min.js') }}"></script>

<!-- profile init js -->
<script src="{{ asset('assets/js/pages/profile.init.js') }}"></script>
@endpush
