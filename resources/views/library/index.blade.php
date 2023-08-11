@extends('layouts.dashboard.app')

@section('title', 'Library')

@section('breadcrumb')
<x-dashboard::breadcrumb title="Library" page="Library" active="Library" route="{{ route('report.index') }}" />
@endsection

@section('content')
<div class="card card-height-100 table-responsive">
    <!-- cardheader -->
    <div class="card-header border-bottom-dashed align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1">Library</h4>
        <div class="flex-shrink-0">
            <button type="button" class="btn btn-soft-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-form-add-report">
                <i class="ri-add-line"></i>
                Add
            </button>
        </div>
    </div>
    <!-- end cardheader -->
    <!-- Hoverable Rows -->
    <table class="table table-hover table-nowrap mb-0">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Tanggal Register</th>
                <th scope="col">Nama Drawing</th>
                <th scope="col">Nomor Drawing</th>
                <th scope="col">Equipment</th>
                <th scope="col">Upload PDF</th>
                <th scope="col">Revisi</th>
                <th scope="col" class="col-1"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($libraries as $library)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $library->tgl_regis }}</td>
                <td>{{ $library->nama }}</td>
                <td>{{ $library->no_draw }}</td>
                <td>{{ $library->equiptment }}</td>
                <td><a href="{{ url('assets/libraries/' . $library->pdf) }}">{{ $library->pdf }}</a></td>
                <td></td>
                <td></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="card-footer py-4">
        <nav aria-label="..." class="pagination justify-content-end">
            {{-- {{ $reports->links() }} --}}
        </nav>
    </div>
</div>

@include('components.form.modal.library.add')
@endsection

@push('script')
<script>
    $('#modalFoto').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var foto = button.data('foto') // Extract info from data-* attributes
        var modal = $(this)
        modal.find('.modal-body-files').html(
            `<img class="w-100 rounded" src="${foto}" />`
        )
        modal.find('.modal-footer a').attr('href', foto)


    })

</script>
@endpush
