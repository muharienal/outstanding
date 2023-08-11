@extends('layouts.dashboard.app')

@section('title', 'User Validate')

@section('breadcrumb')
<x-dashboard::breadcrumb title="User Validate" page="User Validate" active="User Validate" route="{{ route('user.validation.index') }}" />
@endsection

@section('content')
<div class="card card-height-100 table-responsive">
  <!-- cardheader -->
  <div class="card-header border-bottom-dashed align-items-center d-flex">
    <h4 class="card-title mb-0 flex-grow-1">User Validate</h4>
    <div class="flex-shrink-0">
    </div>
  </div>
  <!-- end cardheader -->
  <!-- Hoverable Rows -->
  <form action="{{ route('user.validation.store') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="modal-body">

      <div class="row">
        <div class="col-lg-6">
          <div class="mb-3">
            <label for="user_selfie" class="form-label">User Selfie</label>
            <input type="file" class="form-control" id="user_selfie" placeholder="User Selfie" name="user_selfie">
            <x-form.validation.error name="user_selfie" />
          </div>
        </div>

        <div class="col-lg-6">
          <div class="mb-3">
            <label for="user_card_id" class="form-label">User Card ID</label>
            <input type="file" class="form-control" id="user_card_id" placeholder="Role Name" name="user_card_id">
            <x-form.validation.error name="user_card_id" />
          </div>
        </div>

      </div>

    </div>
    <div class="card-footer py-4">
      <nav aria-label="..." class="pagination justify-content-end">
        <button type="submit" class="btn btn-primary ">Save</button>
      </nav>
    </div>
  </form>
</div>

@endsection