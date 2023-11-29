@extends('layouts.dashboard.app')

@section('title', 'Master Data')

@section('content')
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Noto Sans'>
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

    body {
        margin-top: -30px;
        margin-left: -30px;
        background-color: #EFEFEF; /* Set the base background color */
        font-family: 'Noto Sans';
    }

    /* Adjust container padding to accommodate the negative margins */
    .container {
        padding-top: 50px;
        padding-left: 10px;
    }

    .chart-container {
        position: relative;
        width: 100%;
        height: 200px; /* Adjust this height as needed */
        overflow: hidden;
    }

    .custom-card {
        border-radius: 19.784px;
        background: #FFF;
        box-shadow: 0px 4.946048736572266px 72.95421600341797px 0px rgba(50, 50, 71, 0.06), 0px 4.946048736572266px 127.3607406616211px 0px rgba(50, 50, 71, 0.01);
    }

    .card-title-custom {
        color: #000;
        font-style: normal;
        font-weight: 700;
    }

    #showFilter {
        border-radius: 10px;
        border: 1px solid #07834D;
        background: #FFF;
        color: #07834D;
        padding-right: 50px; /* Add space for the custom icon */
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%2307834D' viewBox='0 0 320 512'%3E%3Cpath d='M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 18px 18px;
    }

    #showFilter:focus option {
        color: #000000;
    }

    #unitFilter {
        border-radius: 10px;
        border: 1px solid #07834D;
        background: #FFF;
        color: #07834D;
        padding-right: 40px; /* Add space for the custom icon */
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%2307834D' viewBox='0 0 320 512'%3E%3Cpath d='M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 18px 18px;
    }

    #unitFilter:focus option {
        color: #000000;
    }

    #statusFilter {
        border-radius: 10px;
        border: 1px solid #07834D;
        background: #FFF;
        color: #07834D;
        padding-right: 40px; /* Add space for the custom icon */
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%2307834D' viewBox='0 0 320 512'%3E%3Cpath d='M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 18px 18px;
    }

    #statusFilter:focus option {
        color: #000000;
    }

    #prioritasFilter {
        border-radius: 10px;
        border: 1px solid #07834D;
        background: #FFF;
        color: #07834D;
        padding-right: 45px; /* Add space for the custom icon */
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%2307834D' viewBox='0 0 320 512'%3E%3Cpath d='M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 18px 18px;
    }

    #prioritasFilter:focus option {
        color: #000000;
    }

    #clearFilters {
        color: #E73F33;
        font-size: 12px; /* Adjust the font size as needed */
    }

    #tambahData {
        border-radius: 10px;
        border: 1px solid #FFF;
        background: linear-gradient(180deg, #BF8600 0%, #FEB300 100%);
        box-shadow: 0px -2px 8px 0px rgba(0, 0, 0, 0.10) inset, 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
        color: #FFF;
        font-size: 14px; /* Adjust the font size as needed */
        text-decoration: none; /* Remove the default underline */
        padding: 8px 15px; /* Adjust the padding as needed */
        transition: background-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    /* Add a hover effect */
    #tambahData:hover {
        background: linear-gradient(180deg, #BF8600 0%, #FEB300 100%);
        box-shadow: 0px -2px 8px 0px rgba(0, 0, 0, 0.10) inset, 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
    }

    /* Remove the default focus outline */
    #tambahData:focus {
        outline: none;
    }

    #printTable {
        border-radius: 10px;
        border: 1px solid #FFF;
        background: linear-gradient(180deg, #06693E 0%, #50A245 100%);
        box-shadow: 0px -4px 8px 0px rgba(0, 0, 0, 0.14) inset, 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
        color: #FFF;
        font-size: 14px; /* Adjust the font size as needed */
        text-decoration: none; /* Remove the default underline */
        padding: 8px 15px; /* Adjust the padding as needed */
        transition: background-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    /* Add a hover effect */
    #printTable:hover {
        background: linear-gradient(180deg, #50A245 0%, #06693E 100%);
        box-shadow: 0px 4px 8px 0px rgba(0, 0, 0, 0.14) inset, 0px -4px 4px 0px rgba(0, 0, 0, 0.25);
    }

    /* Remove the default focus outline */
    #printTable:focus {
        outline: none;
    }

    #clearFilters{
        color: #47903E;
    }

    #reports-table {
        color: black;
    }

    #reports-table th,
    #reports-table td {
        color: black;
    }

    #reports-table tbody tr {
        height: 55px; /* Set the desired height */
    }

    #reports-table tbody td {
        vertical-align: middle;
    }

    /* Change font color for search bar */
    .dataTables_filter input {
        color: black;
    }

    /* Change font color for pagination */
    .dataTables_paginate .paginate_button {
        color: black;
    }

    /* Change font color for other elements */
    .dataTables_wrapper {
        color: black;
    }

    #reports-table thead th {
        background: linear-gradient(180deg, #919E98 0%, #575E5B 100%);
        color: white; /* Set font color to white */
    }

    .card.mt-4 {
        margin-left: 15px;
        margin-right: 5px;
        border-radius: 19.784px;
        background: #FFF;
        box-shadow: 0px 4.946048736572266px 72.95421600341797px 0px rgba(50, 50, 71, 0.06), 0px 4.946048736572266px 127.3607406616211px 0px rgba(50, 50, 71, 0.01);
    }
</style>

<div style="margin-left: 15px; margin-right: 5px;">
    <div class="d-flex flex-wrap align-items-center justify-content-between">
        <div class="d-flex align-items-center">
        <label class="mb-0 me-2" style="color: black; font-weight: bold; font-size: 13px;">Filter Menu:</label>
            <div class="d-flex flex-column me-2"> <!-- First set of filters -->
                <select id="showFilter" class="form-select">
                    <option value="">All Show Status</option>
                    <option value="Show">Show</option>
                    <option value="Hide">Hide</option>
                </select>
            </div>
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
                    <option value="">All Job Status</option>
                    <option value="Rutin">Rutin</option>
                    <option value="IP">IP</option>
                    <option value="OK">OK</option>
                    <option value="Belum">Belum</option>
                </select>
            </div>
            <div class="d-flex flex-column"> <!-- Fourth set of filters -->
                <select id="prioritasFilter" class="form-select">
                    <option value="">All Priority</option>
                    <option value="Emergency">Emergency</option>
                    <option value="High">High</option>
                    <option value="Medium">Medium</option>
                    <option value="Low">Low</option>
                </select>
            </div>
            <a href="#" id="clearFilters" class="btn btn-link btn-sm">Clear Filter</a>
        </div>
        <div class="d-flex align-items-center"> <!-- Right-aligned content -->
            <div class="d-flex"> <!-- Flex container for buttons -->
                <a href="#" id="printTable" class="btn btn-soft-primary btn-m me-2">
                    <i class="fas fa-print"></i> Print
                </a>
                @if (auth()->user()->hasRole(['Planner', 'Super Admin']))
                <button id="tambahData" type="button" class="btn btn-soft-success btn-m" data-bs-toggle="modal" data-bs-target="#modal-form-add-report">
                <i class="fas fa-file-medical"></i>
                    Tambah Data
                </button>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="card mt-4">
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-hover table-nowrap mb-0" id="reports-table">
                <thead>
                    <tr>
                        <th scope="col" style="text-align: center;">No</th>
                        <th scope="col" style="text-align: center;">Show Status</th>
                        <th scope="col" style="text-align: center;">Unit</th>
                        <th scope="col" style="text-align: center;">Equipment</th>
                        <th scope="col">Program Kerja</th>
                        <th scope="col" style="text-align: center;">Status Pekerjaan</th>
                        <th scope="col" style="text-align: center;">Progress</th>
                        <th scope="col" style="text-align: center;">Target</th>
                        <th scope="col" style="text-align: center;">Prioritas</th>
                        <th scope="col" style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                        @php
                        $counter = 1;
                        @endphp
                    @forelse ($reports as $report)
                        <tr class="unit-row" data-unit="{{ $report->unit }}" data-show-status="{{ $report->show_status }}" data-status-pekerjaan="{{ $report->status_pekerjaan }}" data-prioritas="{{ $report->prioritas }}">
                            <td style="text-align: center;">{{ $counter }}</td>
                <td style="text-align: center;">
                    @php
                        $showColor = $report->getShowColor();
                        $fontColor = in_array($showColor, ['#F44336', '#7EB45F']) ? 'white' : 'black';
                    @endphp
                    <button class="btn btn-sm btn-{{ $showColor }} no-hover-btn" style="background-color: {{ $showColor }}; color: {{ $fontColor }}; font-weight: 400;">
                        {{ $report->show_status }}
                    </button> 
                </td>
                <td style="text-align: center;">{{ $report->unit }}</td>
                <td style="text-align: center;">{{ $report->equipment }}</td>
                <td style="white-space: pre-line; width: 300px;">{{ $report->program_kerja }}</td>
                <td style="text-align: center;">
                    @php
                        $statusColor = $report->getStatusColor();
                        $fontColor = in_array($statusColor, ['#59B44D', '#07834D']) ? 'white' : 'black';
                    @endphp
                    <button class="btn btn-sm btn-{{ $statusColor }} no-hover-btn" style="background-color: {{ $statusColor }}; color: {{ $fontColor }}; font-weight: 400;">
                        {{ $report->status_pekerjaan }}
                    </button>    
                </td>
                <td style="text-align: center;">{{ $report->progress }}%</td>
                <td style="text-align: center;">{{ \Carbon\Carbon::parse($report->target)->format('d/m/Y') }}</td>
                <td style="text-align: center;">
                    @php
                        $prioritasColor = $report->getPrioritasColor();
                        $fontColorPrioritas = in_array($prioritasColor, ['#F44336', '#7EB45F']) ? 'white' : 'black';
                    @endphp
                    <button class="btn btn-sm btn-{{ $prioritasColor }} no-hover-btn" style="background-color: {{ $prioritasColor }}; color: {{ $fontColorPrioritas }}; font-weight: 400;">
                        {{ $report->prioritas }}
                    </button>
                </td>
                <td style="text-align: center;">
                    <div class="dropdown dropup">
                        <button class="btn btn-sm btn-link dropdown-toggle" type="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 32 32" fill="none">
                                <path d="M12.8 32.0001H19.2C25.2336 32.0001 28.2512 32.0001 30.1248 30.1265C32 28.2513 32 25.2321 32 19.2001C32 13.1681 32 10.1489 30.1248 8.27531C29.5456 7.69451 28.8544 7.29451 28 7.01771V11.4545C28.0048 11.9985 28.0144 12.9121 27.6224 13.7473C27.232 14.5825 26.5248 15.1617 26.1024 15.5073C26.0608 15.5393 26.0208 15.5729 25.9856 15.6033L23.5744 17.6113C22.1984 18.7601 20.9984 19.7585 19.92 20.4529C18.76 21.1985 17.504 21.7521 16 21.7521C14.496 21.7521 13.2416 21.1985 12.08 20.4513C11.0016 19.7585 9.8032 18.7601 8.4256 17.6129L6.0144 15.6033C5.97558 15.5712 5.93665 15.5392 5.8976 15.5073C5.4752 15.1617 4.7696 14.5825 4.3776 13.7473C3.9872 12.9121 3.9936 11.9985 3.9984 11.4545L4 11.3009V7.01611C3.1456 7.29291 2.4544 7.69451 1.8752 8.27531C-1.90735e-07 10.1489 0 13.1665 0 19.2001C0 25.2337 -1.90735e-07 28.2513 1.8752 30.1265C3.7488 32.0001 6.7664 32.0001 12.8 32.0001Z" fill="#595959"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.55186 13.76L9.85426 15.68C12.7935 18.128 14.2623 19.352 15.9999 19.352C17.7375 19.352 19.2079 18.128 22.1455 15.6784L24.4495 13.7584C25.0143 13.288 25.2975 13.0512 25.4495 12.7296C25.5999 12.4064 25.5999 12.0384 25.5999 11.3008V8C25.5999 7.488 25.5999 7.008 25.5967 6.5632C25.5775 3.7296 25.4399 2.184 24.4287 1.1712C23.2575 1.90735e-07 21.3727 0 17.5999 0H14.3999C10.6287 0 8.74386 1.90735e-07 7.57106 1.1712C6.55986 2.184 6.41906 3.7296 6.39986 6.5632C6.39666 7.0096 6.39986 7.4864 6.39986 8V11.3008C6.39986 12.0368 6.39986 12.4064 6.55186 12.7296C6.70226 13.0512 6.98386 13.288 7.55186 13.76ZM11.5999 6.4C11.5999 6.08174 11.7263 5.77652 11.9513 5.55147C12.1764 5.32643 12.4816 5.2 12.7999 5.2H19.1999C19.5181 5.2 19.8233 5.32643 20.0484 5.55147C20.2734 5.77652 20.3999 6.08174 20.3999 6.4C20.3999 6.71826 20.2734 7.02349 20.0484 7.24853C19.8233 7.47358 19.5181 7.6 19.1999 7.6H12.7999C12.4816 7.6 12.1764 7.47358 11.9513 7.24853C11.7263 7.02349 11.5999 6.71826 11.5999 6.4ZM13.1999 11.2C13.1999 10.8817 13.3263 10.5765 13.5513 10.3515C13.7764 10.1264 14.0816 10 14.3999 10H17.5999C17.9181 10 18.2233 10.1264 18.4484 10.3515C18.6734 10.5765 18.7999 10.8817 18.7999 11.2C18.7999 11.5183 18.6734 11.8235 18.4484 12.0485C18.2233 12.2736 17.9181 12.4 17.5999 12.4H14.3999C14.0816 12.4 13.7764 12.2736 13.5513 12.0485C13.3263 11.8235 13.1999 11.5183 13.1999 11.2Z" fill="#595959"/>
                            </svg>
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
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modal-form-delete-report-{{ $report->id }}">
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
                            <td colspan="9" class="text-center">No data available in table</td>
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
