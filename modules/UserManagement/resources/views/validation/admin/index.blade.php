@extends('layouts.dashboard.app')

@section('title', 'User Validation')

@section('breadcrumb')
<x-dashboard::breadcrumb title="User Validation" page="User Validation" active="Validation" route="{{ route('user.validation.index') }}" />
@endsection

@section('content')
<div class="card card-height-100 table-responsive">
  <!-- cardheader -->
  <div class="card-header border-bottom-dashed align-items-center d-flex">
    <h4 class="card-title mb-0 flex-grow-1">Validation</h4>
    {{-- <div class="flex-shrink-0">
      <button type="button" class="btn btn-soft-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-form-add-user">
        <i class="ri-add-line"></i>
        Add
      </button>
    </div> --}}
  </div>
  <!-- end cardheader -->
  <!-- Hoverable Rows -->
  <table class="table table-hover table-nowrap mb-0">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">User</th>
        <th scope="col">Selfie</th>
        <th scope="col">Card ID</th>
        <th scope="col"></th>
        <th scope="col" class="col-1"></th>
      </tr>
    </thead>
    <tbody>
      @forelse ($validations as $validation)
      @if($validation->user?->name)
      <tr>
        <th scope="row">{{ $loop->iteration }}</th>
        <td>{{ $validation->user->name }}</td>
        <td>
          <img src="{{ asset('assets/files/' . $validation->img_self) }}" alt="" class="img-thumbnail">
        </td>
        <td>
          <img src="{{ asset('assets/files/' . $validation->img_card) }}" alt="" class="img-thumbnail">
        </td>
        <td>
          @if($validation->user->isValidated())
          <button type="button" class="btn btn-soft-success">Verified</button>
          @else
          <button class="btn btn-soft-primary rounded rounded-circle" onclick="event.preventDefault(); document.getElementById('validation-update-{{ $validation->id }}').submit()">
            <i class="ri-check-line"></i>
          </button>
          <button class="btn btn-soft-danger rounded rounded-circle" onclick="event.preventDefault(); document.getElementById('validation-delete-{{ $validation->id }}').submit()">
            <i class="ri-close-line"></i>
          </button>
          <form action="{{ route('user.validation.update', $validation->id) }}" method="POST" id="validation-update-{{ $validation->id }}">
            @csrf
            @method('PUT')
          </form>
          <form action="{{ route('user.validation.destroy', $validation->id) }}" method="POST" id="validation-delete-{{ $validation->id }}">
            @csrf
            @method('DELETE')
          </form>
          @endif
        </td>
        <td>
          <div class="dropdown">
            <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-ellipsis-v"></i>
            </a>

            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <li>
                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal-form-edit-user-{{ $validation->id }}">
                  Edit
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('modal-form-delete-user-{{ $validation->id }}').submit()">
                  Delete
                </a>
              </li>
            </ul>

            {{-- @include('usermanagement::components.form.modal.user.edit') --}}
            {{-- @include('usermanagement::components.form.modal.user.delete') --}}
          </div>
        </td>
      </tr>
      @endif
      @empty
      <tr>
        <th colspan="6" class="text-center">No data to display</th>
      </tr>
      @endforelse
    </tbody>
  </table>
  <div class="card-footer py-4">
    <nav aria-label="..." class="pagination justify-content-end">
      {{-- $validations->links() --}}
    </nav>
  </div>
</div>

{{-- @include('usermanagement::components.form.modal.user.add') --}}
@endsection
