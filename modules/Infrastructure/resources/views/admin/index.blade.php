@extends('layouts.dashboard.app')

@section('title', 'Infrastructure')

@section('breadcrumb')
<x-dashboard::breadcrumb title="Infrastructure" page="Infrastructure" active="Infrastructure" route="{{ route('infrastructure.index') }}" />
@endsection

@section('content')
<div class="card card-height-100 table-responsive">
    <!-- cardheader -->
    <div class="card-header border-bottom-dashed align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1">Infrastructure</h4>
        @if (auth()->user()->hasRole('Super Admin'))
        <div class="flex-shrink-0">
            <a href="{{ route('infrastructure.create') }}" type="button" class="btn btn-soft-primary btn-sm d-none">
                <i class="ri-add-line"></i>
                Add
            </a>
        </div>
        @endif
    </div>
    <!-- end cardheader -->
    <!-- Hoverable Rows -->
    <table class="table table-hover table-nowrap mb-0">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Tgl</th>
                <th scope="col">Nama Drawing</th>
                <th scope="col">Nomor Drawing</th>
                <th scope="col">Unit Kerja</th>
                <th scope="col">File Lampiran</th>
                <th scope="col">Drafter</th>
                <th scope="col">PIC</th>
                <th scope="col">Progress</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Revisi</th>
                <th scope="col" class="col-1"></th>
            </tr>
        </thead>
        <tbody>
            @forelse($infrastructures as $infrastructure)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $infrastructure->created_at }}</td>
                <td>{{ $infrastructure->nama_draw }}</td>
                <td>{{ $infrastructure->no_draw }}</td>
                <td>{{ $infrastructure->unit }}</td>
                <td>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalFile" data-pdf="{{ url('assets/infrastructures/' . $infrastructure->file_pdf) }}" download>{{ $infrastructure->file_pdf }}</a>
                </td>
                <td>{{ $infrastructure->drafter }}</td>
                <td>{{ $infrastructure->user->name }}</td>
                <td>{{ $infrastructure->progress }}</td>
                <td>{{ $infrastructure->keterangan }}</td>
                <td>
                    <ul>
                        @foreach ($infrastructure->revisions as $revision)
                        <li>{{ $revision->name }}</li>
                        @endforeach
                    </ul>
                </td>

                <td>
                    <div class="dropdown">
                        <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li>
                                <a class="dropdown-item" href="{{ route('infrastructure.show', $infrastructure->id) }}">
                                    Show
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="{{ route('infrastructure.edit', $infrastructure->id) }}">
                                    Edit
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('modal-form-delete-admin-{{ $infrastructure->id }}').submit()">
                                    Delete
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="{{ route('infrastructure.revisi.create', $infrastructure->id) }}">
                                    Revisi
                                </a>
                            </li>

                        </ul>

                        @include('infrastructure::components.form.modal.admin.delete')
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <th colspan="12" class="text-center">No data to display</th>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="card-footer py-4">
        <nav aria-label="..." class="pagination justify-content-end">
            {{ $infrastructures->links() }}
        </nav>
    </div>
</div>

<div class="modal fade" id="modalFile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalFileLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fs-6 fw-bold" id="modalFileLabel">Lihat Lampiran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="modal-body-files">

                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-soft-primary" download>Download</a>
                <button type="button" class="btn btn-soft-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $('#modalFile').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var pdf = button.data('pdf') // Extract info from data-* attributes
        var modal = $(this)
        modal.find('.modal-body-files').html(
            `<object type="application/pdf" data="${pdf}#toolbar=0" width="100%" height="100%" style="height: 100vh;">No Support</object>`
        )
        modal.find('.modal-footer a').attr('href', pdf)


    })

</script>
@endpush
