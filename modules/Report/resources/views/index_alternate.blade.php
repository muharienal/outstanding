@extends('layouts.dashboard.app')

@section('title', 'Master Data')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
<div class="container">
    <div class="row">
        <div class="col-md-4 mb-4">
            <h4 class="mb-3 text-center">Unit</h4>
            <div class="card">
                <div class="card-body">
                    <canvas id="unitChart" width="200" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <h4 class="mb-3 text-center">Status Pekerjaan</h4>
            <div class="card">
                <div class="card-body">
                    <canvas id="statusChart" width="200" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <h4 class="mb-3 text-center">Prioritas</h4>
            <div class="card">
                <div class="card-body">
                    <canvas id="prioritasChart" width="200" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
    
    <div class="card">
        <div class="card-header border-bottom-dashed align-items-center d-flex justify-content-between">
            <div class="d-flex align-items-center">
                <label class="mb-0 me-2">Filter Menu:</label>
                <div class="d-flex flex-column me-2">
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
                <a href="#" id="printTable" class="btn btn-soft-primary btn-m">Print</a>
            </div>
        </div>
        <div class="card mt-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-nowrap mb-0" id="reports-table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Unit</th>
                            <th scope="col">Equipment</th>
                            <th scope="col">Program Kerja</th>
                            <th scope="col">Status Pekerjaan</th>
                            <th scope="col">Progress</th>
                            <th scope="col">Target</th>
                            <th scope="col">Prioritas</th>
                            <th scope="col">Detail</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @php
                        $counter = 1;
                        $unitChartData = [];
                        $statusChartData = [];
                        $prioritasChartData = [];
                        @endphp
                        @forelse ($reports as $report)
                        @if ($report->show_status === 'Show')
                            <tr class="unit-row" data-unit="{{ $report->unit }}" data-status-pekerjaan="{{ $report->status_pekerjaan }}" data-prioritas="{{ $report->prioritas }}">
                                <td>{{ $counter }}</td>
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
                                    <button class="btn btn-m btn-link" type="button" data-bs-toggle="modal" data-bs-target="#modal-form-show-report-{{ $report->id }}">
                                        <i class="far fa-eye"></i>
                                    </button>
                                    @include('report::components.form.modal.report.show')
                                </div>
                                </td>
                            </tr>
                            @php
                            $counter++;
                            $unitChartData[$report->unit] = ($unitChartData[$report->unit] ?? 0) + 1;
                            $statusChartData[$report->status_pekerjaan] = ($statusChartData[$report->status_pekerjaan] ?? 0) + 1;
                            $prioritasChartData[$report->prioritas] = ($prioritasChartData[$report->prioritas] ?? 0) + 1;
                            @endphp
                            @endif
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

        $('#unitFilter, #prioritasFilter, #statusFilter').change(function() {
            filterTable();
        });

        $('#clearFilters').click(function() {
            $('#unitFilter, #prioritasFilter, #statusFilter').val('');
            filterTable();
        });
    });

    function loadTableData() {
        // Load the table initially, e.g., when the page loads
        // You can add your initial loading logic here
    }

    function filterTable() {
        var selectedUnit = $('#unitFilter').val();
        var selectedPrioritas = $('#prioritasFilter').val();
        var selectedStatusPekerjaan = $('#statusFilter').val();

        $('.unit-row').each(function() {
            var row = $(this);
            var rowUnit = row.data('unit');
            var rowPrioritas = row.data('prioritas');
            var rowStatusPekerjaan = row.data('status-pekerjaan'); // Corrected variable name

            var unitPass = selectedUnit === '' || rowUnit === selectedUnit;
            var prioritasPass = selectedPrioritas === '' || rowPrioritas === selectedPrioritas;
            var statusPekerjaanPass = selectedStatusPekerjaan === '' || rowStatusPekerjaan === selectedStatusPekerjaan;

            if (unitPass && prioritasPass && statusPekerjaanPass) {
                row.show();
            } else {
                row.hide();
            }
        });
    }
</script>
<script>
    // Function to create a pie chart
    function createPieChart(canvasId, data, labels) {
        const ctx = document.getElementById(canvasId).getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: [
                        '#007bff', // Blue
                        '#28a745', // Green
                        '#ffc107', // Yellow
                        '#dc3545', // Red
                        // Add more colors if needed
                    ],
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        });
    }

    // Calculated chart data from the PHP loop
    const unitChartData = {!! json_encode(array_values($unitChartData)) !!};
    const unitChartLabels = {!! json_encode(array_keys($unitChartData)) !!};
    const statusChartData = {!! json_encode(array_values($statusChartData)) !!};
    const statusChartLabels = {!! json_encode(array_keys($statusChartData)) !!};
    const prioritasChartData = {!! json_encode(array_values($prioritasChartData)) !!};
    const prioritasChartLabels = {!! json_encode(array_keys($prioritasChartData)) !!};

    // Create charts using the calculated data
    createPieChart('unitChart', unitChartData, unitChartLabels);
    createPieChart('statusChart', statusChartData, statusChartLabels);
    createPieChart('prioritasChart', prioritasChartData, prioritasChartLabels);
</script>

<script>
    document.getElementById('printTable').addEventListener('click', function() {
        window.print();
    });
</script>

@endpush
