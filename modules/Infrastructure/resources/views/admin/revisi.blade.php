@extends('layouts.dashboard.app')

@section('title', 'Infrastructure')

@section('breadcrumb')
<x-dashboard::breadcrumb title="Revisi" page="Revisi" active="Create" route="{{ route('infrastructure.index') }}" />
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title mb-0">Revisi Create</h4>
    </div><!-- end card header -->

    <form action="{{ route('infrastructure.revisi.store', $infrastructure->id) }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="card-body">

            <div class="mb-3">
                <p class="text-muted">Name</p>
                <input type="text" name="name" id="name" class="form-control">
                <x-form.validation.error name="name" />
            </div>

            <div class="mb-3">
                <p class="text-muted">Revisi</p>
                <textarea name="revisi" id="revisi" class="form-control" rows="10"></textarea>
                <x-form.validation.error name="revisi" />
            </div>

        </div><!-- end card-body -->

        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary ">Save</button>
        </div>

    </form>

</div><!-- end card -->
@endsection
