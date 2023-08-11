@extends('layouts.dashboard.app')

@section('title', 'Infrastructure')

@section('breadcrumb')
<x-dashboard::breadcrumb title="Infrastructure" page="Infrastructure" active="Create" route="{{ route('infrastructure.index') }}" />
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title mb-0">Infrastructure Edit ({{ $infrastructure->id }})</h4>
    </div><!-- end card header -->

    <form action="{{ route('infrastructure.update', $infrastructure->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="card-body">

            <div class="mb-3">
                <p class="text-muted">File PDF</p>
                <input type="file" name="file_pdf" id="file_pdf" class="form-control">
                <x-form.validation.error name="file_pdf" />
            </div>

            <div class="mb-3">
                <p class="text-muted">Drafter</p>
                <input type="text" name="drafter" id="drafter" class="form-control" value="{{ $infrastructure->drafter }}">
                <x-form.validation.error name="drafter" />
            </div>

            <div class="mb-3">
                <p class="text-muted">Nama Draw</p>
                <input type="text" name="nama_draw" id="nama_draw" class="form-control" value="{{ $infrastructure->nama_draw }}">
                <x-form.validation.error name="nama_draw" />
            </div>

            <div class="mb-3">
                <p class="text-muted">Equipment</p>
                <input type="text" name="equipment" id="equipment" class="form-control" value="{{ $infrastructure->equipment }}">
                <x-form.validation.error name="equipment" />
            </div>

            <div class="mb-3">
                <p class="text-muted">Unit</p>
                <input type="text" name="unit" id="unit" class="form-control">
                <x-form.validation.error name="unit" />
            </div>

            <div class="mb-3">
                <label for="pic" class="form-label">PIC</label>
                <select class="form-select" id="pic" name="pic" data-choices data-choices-removeItem>
                    @foreach ($users as $user)
                    <option @checked($infrastructure->user_create == $user->id) value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                <x-form.validation.error name="pic" />
            </div>

            <div class="mb-3">
                <label for="user_id" class="form-label">User Request</label>
                <select class="form-select" id="user_id" name="user_id" data-choices data-choices-removeItem>
                    @foreach ($users as $user)
                    <option @checked($infrastructure->user_id == $user->id) value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                <x-form.validation.error name="user_id" />
            </div>

            <div class="mb-3">
                <p class="text-muted">Progress</p>
                <input type="text" name="progress" id="progress" class="form-control" value="{{ $infrastructure->progress }}">
                <x-form.validation.error name="progress" />
            </div>

            <div class="mb-3">
                <p class="text-muted">Keterangan</p>
                <textarea name="keterangan" id="keterangan" class="form-control" rows="10">{{ $infrastructure->keterangan }}</textarea>
                <x-form.validation.error name="keterangan" />
            </div>

        </div><!-- end card-body -->

        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary ">Save</button>
        </div>

    </form>

</div><!-- end card -->
@endsection
