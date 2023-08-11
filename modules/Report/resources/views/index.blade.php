@extends('layouts.dashboard.app')

@section('title', 'Master Data')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style> 
    /* Add a specific class to target the button within the table cell */
    .no-hover-btn {
        pointer-events: none; /* Disable click */
    }

    /* Remove hover effects */
    .no-hover-btn:hover {
        background-color: inherit; /* Reset background color on hover */
        color: inherit; /* Reset text color on hover */
    }
    /* Add padding to the DataTables wrapper with no-footer class */
    .dataTables_wrapper.no-footer {
        padding: 5px; /* Adjust the value as needed */
    }
    @media print {
        /* Hide unnecessary elements for printing */
        header, footer, .card-header, canvas, #printButton {
            display: none !important;
        }

        /* Set the print layout to landscape */
        @page {
            size: landscape;
        }

        /* Customize the table style for printing */
        #reports-table {
            border-collapse: collapse;
            width: 100%;
        }

        #reports-table th,
        #reports-table td {
            padding: 8px;
            text-align: left;
            width: auto !important; /* Span the entire width */
        }

        #reports-table th {
            background-color: #f2f2f2;
        }

        /* Hide chart titles */
        .mb-3.text-center {
            display: none !important;
        }

        .dataTables_length {
            display: none !important;
        }

        .dataTables_filter {
            display: none !important;
        }

        .dataTables_info {
            display: none !important;
        }

        .dataTables_paginate.paging_simple_numbers {
            display: none !important;
        }
    }
</style>
<div class="card">
    <div class="card-header border-bottom-dashed align-items-center d-flex justify-content-between">
        <div class="d-flex align-items-center"> <!-- Left-aligned content -->
            <label class="mb-1 me-2">Filter Menu:</label>
            <div class="d-flex flex-column me-2"> <!-- First set of filters -->
                <select id="showFilter" class="form-select">
                    <option value="">All Show Status</option>
                    <option value="Show">Show</option>
                    <option value="Hide">Hide</option>
                </select>
            </div>
            <div class="d-flex flex-column me-2"> <!-- Second set of filters -->
                <select id="unitFilter" class="form-select">
                    <option value="">All Units</option>
                    <option value="PA I">PA I</option>
                    <option value="PA II">PA II</option>
                    <option value="SASU I">SASU I</option>
                    <option value="SASU II">SASU II</option>
                    <option value="UBB">UBB</option>
                    <option value="ZA 2">ZA II</option>
                    <option value="Gypsum Alf3">Gypsum AlF3</option>
                    <option value="General">General</option>
                </select>
            </div>
            <div class="d-flex flex-column me-2"> <!-- Third set of filters -->
                <select id="statusFilter" class="form-select">
                    <option value="">All Status Pekerjaan</option>
                    <option value="Rutin">Rutin</option>
                    <option value="IP">IP</option>
                    <option value="OK">OK</option>
                    <option value="Belum">Belum</option>
                </select>
            </div>
            <div class="d-flex flex-column"> <!-- Fourth set of filters -->
                <select id="prioritasFilter" class="form-select">
                    <option value="">All Prioritas</option>
                    <option value="Emergency">Emergency</option>
                    <option value="High">High</option>
                    <option value="Medium">Medium</option>
                    <option value="Low">Low</option>
                </select>
            </div>
            <a href="#" id="clearFilters" class="btn btn-link btn-sm text-danger">Clear Filter</a>
        </div>
        <div class="d-flex align-items-center"> <!-- Right-aligned content -->
            <div class="d-flex"> <!-- Flex container for buttons -->
                @if (auth()->user()->hasRole(['Planner', 'Super Admin']))
                    <button type="button" class="btn btn-soft-success btn-m me-3" data-bs-toggle="modal" data-bs-target="#modal-form-add-report">
                        <i class="ri-add-line"></i>
                        Tambah Data
                    </button>
                @endif
                <a href="#" id="printTable" class="btn btn-soft-primary btn-m">Print</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-nowrap mb-0" id="reports-table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Show Status</th>
                        <th scope="col">Unit</th>
                        <th scope="col">Equipment</th>
                        <th scope="col">Program Kerja</th>
                        <th scope="col">Status Pekerjaan</th>
                        <th scope="col">Progress</th>
                        <th scope="col">Target</th>
                        <th scope="col">Prioritas</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                        @php
                        $counter = 1;
                        @endphp
                    @forelse ($reports as $report)
                        <tr class="unit-row" data-unit="{{ $report->unit }}" data-show-status="{{ $report->show_status }}" data-status-pekerjaan="{{ $report->status_pekerjaan }}" data-prioritas="{{ $report->prioritas }}">
                            <td>{{ $counter }}</td>
                <td>
                    <button class="btn btn-sm btn-{{ $report->getShowColor() }} no-hover-btn">
                        {{ $report->show_status }}
                    </button>
                </td>
                <td>{{ $report->unit }}</td>
                <td>{{ $report->equipment }}</td>
                <td>{{ $report->program_kerja }}</td>
                <td>
                    <button class="btn btn-sm btn-{{ $report->getStatusColor() }} no-hover-btn">
                        {{ $report->status_pekerjaan }}
                    </button>    
                </td>
                <td>{{ $report->progress }}</td>
                <td>{{ \Carbon\Carbon::parse($report->target)->format('d/m/Y') }}</td>
                <td>
                    <button class="btn btn-sm btn-{{ $report->getPrioritasColor() }} no-hover-btn">
                        {{ $report->prioritas }}
                    </button>
                </td>
                <td>
                    <div class="dropdown dropup">
                        <button class="btn btn-sm btn-link dropdown-toggle" type="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-lg"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal-form-show-report-{{ $report->id }}">
                                    <i class="far fa-eye"></i> Detail
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal-form-edit-report-{{ $report->id }}">
                                    <i class="far fa-edit"></i> Edit
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('modal-form-delete-report-{{ $report->id }}').submit()">
                                    <i class="far fa-trash-alt"></i> Delete
                                </a>
                            </li>
                        </ul>
                        @include('report::components.form.modal.report.show')
                        @include('report::components.form.modal.report.edit')
                        @include('report::components.form.modal.report.delete')
                    </div>
                </td>
                </tr>
                    @php
                    $counter++;
                    @endphp
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">Belum Ada Data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@if (auth()->user()->hasRole(['Planner', 'Super Admin']))
    @include('report::components.form.modal.report.add')
@endif

<div class="modal fade" id="modalFoto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalFotoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fs-6 fw-bold" id="modalFotoLabel">Lihat Foto</h5>
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
    $(document).ready(function() {
        $('#reports-table').DataTable({
            pageLength: 10, // Number of records per page
            searching: true, // Enable search functionality
            ordering: true, // Enable sorting
            paging: true, // Enable pagination
        });
        
        $('#modalFoto').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var foto = button.data('foto'); // Extract info from data-* attributes
        var modal = $(this);
        modal.find('.modal-body-files').html(
            `<img class="w-100 rounded" src="${foto}" />`
        );
        modal.find('.modal-footer a').attr('href', foto);
        });
    });
</script>

<script>
    $(document).ready(function() {
        loadTableData();

        $('#unitFilter, #showFilter, #prioritasFilter, #statusFilter').change(function() {
            filterTable();
        });

        $('#clearFilters').click(function() {
            $('#unitFilter, #showFilter, #prioritasFilter, #statusFilter').val('');
            filterTable();
        });
    });

    function loadTableData() {
        // Load the table initially, e.g., when the page loads
        // You can add your initial loading logic here
    }

    function filterTable() {
        var selectedUnit = $('#unitFilter').val();
        var selectedShowStatus = $('#showFilter').val();
        var selectedPrioritas = $('#prioritasFilter').val();
        var selectedStatusPekerjaan = $('#statusFilter').val();

        $('.unit-row').each(function() {
            var row = $(this);
            var rowUnit = row.data('unit');
            var rowShowStatus = row.data('show-status');
            var rowPrioritas = row.data('prioritas');
            var rowStatusPekerjaan = row.data('status-pekerjaan'); // Corrected variable name

            var unitPass = selectedUnit === '' || rowUnit === selectedUnit;
            var showStatusPass = selectedShowStatus === '' || rowShowStatus === selectedShowStatus;
            var prioritasPass = selectedPrioritas === '' || rowPrioritas === selectedPrioritas;
            var statusPekerjaanPass = selectedStatusPekerjaan === '' || rowStatusPekerjaan === selectedStatusPekerjaan;

            if (unitPass && showStatusPass && prioritasPass && statusPekerjaanPass) {
                row.show();
            } else {
                row.hide();
            }
        });
    }
</script>

<script>
    document.getElementById('printTable').addEventListener('click', function() {
        window.print();
    });
</script>
@endpush
