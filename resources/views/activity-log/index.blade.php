@extends('layouts.dashboard.app')

@section('title', 'Log Aktivitas')

@section('content')
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Noto Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>

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
    
    body {
        margin-top: -55px;
        margin-left: -20px;
        margin-right: 5px;
        background-color: #EFEFEF; /* Set the base background color */
        font-family: 'Noto Sans';
    }

    /* Adjust container padding to accommodate the negative margins */
    .container {
        padding-top: 50px;
        padding-left: 10px;
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

    #userFilter {
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

    #userFilter:focus option {
        color: #000000;
    }

    #activityFilter {
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

    #activityFilter:focus option {
        color: #000000;
    }

    #clearFilters {
        color: #E73F33;
        font-size: 12px; /* Adjust the font size as needed */
    }

    #activityLogsTable tbody tr {
        height: 55px; /* Set the desired height */
    }

    #activityLogsTable tbody td {
        vertical-align: middle;
    }

    #activityLogsTable {
        color: black;
    }

    #activityLogsTable th,
    #activityLogsTable td {
        color: black;
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

    #activityLogsTable thead th {
        background: linear-gradient(180deg, #919E98 0%, #575E5B 100%);
        color: white; /* Set font color to white */
    }

    .card.mt-4 {
        border-radius: 19.784px;
        background: #FFF;
        box-shadow: 0px 4.946048736572266px 72.95421600341797px 0px rgba(50, 50, 71, 0.06), 0px 4.946048736572266px 127.3607406616211px 0px rgba(50, 50, 71, 0.01);
    }

    #clearFilters{
        color: #47903E;
    }
</style>

<div style="margin-right: 5px; margin-top: 25px;">
    <div class="d-flex flex-wrap align-items-center justify-content-between">
        <div class="d-flex align-items-center">
        <label class="mb-0 me-2" style="color: black; font-weight: bold; font-size: 13px;">Filter Menu:</label>
            <div class="d-flex flex-column me-2"> <!-- First set of filters -->
                <select id="userFilter" class="form-select">
                    <option value="">All Users</option>
                    <option value="Viki">Viki</option>
                    <option value="Faqih">Faqih</option>
                    <option value="Yunianton">Yunianton</option>
                    <option value="Digdyo">Digdyo</option>
                    <option value="Tiar">Tiar</option>
                    <option value="Oki">Oki</option>
                    <option value="Arik">Arik</option>
                    <option value="Bima">Bima</option>
                    <option value="Rheza">Rheza</option>
                    <option value="Fedrik">Fedrik</option>
                </select>
            </div>
            <div class="d-flex flex-column me-2"> <!-- Third set of filters -->
                <select id="activityFilter" class="form-select">
                    <option value="">All Activity</option>
                    <option value="Create">Create</option>
                    <option value="Update">Update</option>
                    <option value="Delete">Delete</option>
                </select>
            </div>
            <a href="#" id="clearFilters" class="btn btn-link btn-sm">Clear Filter</a>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-nowrap mb-0" id="activityLogsTable">
            <thead>
                <tr>
                    <th style="text-align: center;">No</th>
                    <th style="text-align: center;">Nama</th>
                    <th style="text-align: center;">Aktivitas</th>
                    <th>Perubahan Data</th>
                    <th style="text-align: center;">Timestamp</th>
                </tr>
            </thead>
            <tbody>
                @foreach($activityLogs as $index => $activityLog)
                <tr data-user="{{ $activityLog->user->name }}">
                    <td class="row-number" style="text-align: center;"></td>
                    <td style="text-align: center;">{{ $activityLog->user->name }}</td>
                    <td style="text-align: center;">{{ $activityLog->activity }}</td>
                    <td style="white-space: pre-line; width: 300px;">{{ $activityLog->changed_data }}</td>
                    <td style="text-align: center;" data-order="{{ $activityLog->created_at->timestamp }}">{{ $activityLog->created_at->addHours(7)->format('d/m/Y H:i:s') }}</td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function() {
        var activityTable = $('#activityLogsTable').DataTable({
            pageLength: 10,
            searching: true,
            ordering: true,
            paging: true,
            order: [[4, 'desc']], // Sort by the 4th column (timestamp) in descending order
        });

        // Filter logic for user and activity
        $('#userFilter, #activityFilter').on('change', function () {
            var userValue = $('#userFilter').val();
            var activityValue = $('#activityFilter').val();

            activityTable.columns(1).search(userValue).draw(); // Filter column 0 (User)
            activityTable.columns(2).search(activityValue).draw(); // Filter column 1 (Activity)
        });

        activityTable.on('order.dt search.dt', function () {
            activityTable.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();

        $('#clearFilters').on('click', function () {
            $('#userFilter, #activityFilter').val('').change();
            activityTable.search('').columns().search('').order([0, 'asc']).draw();
        });
    });
</script>
@endpush
