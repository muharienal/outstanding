@extends('layouts.dashboard.app')

@section('title', 'Log Aktivitas')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>

<style>
    /* Add padding to the DataTables wrapper with no-footer class */
    .dataTables_wrapper.no-footer {
        padding: 5px; /* Adjust the value as needed */
    }
</style>

<div class="card">
    <div class="card-header">
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-nowrap mb-0" id="activityLogsTable">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Aktivitas</th>
                        <th>Perubahan Data</th>
                        <th>Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($activityLogs as $activityLog)
                    <tr>
                        <td>{{ $activityLog->user->name }}</td>
                        <td>{{ $activityLog->activity }}</td>
                        <td>{{ $activityLog->changed_data }}</td>
                        <td>{{ $activityLog->created_at->addHours(7)->format('d/m/Y H:i:s') }}</td>
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
        $('#activityLogsTable').DataTable({
            pageLength: 10, // Number of records per page
            searching: true, // Enable search functionality
            ordering: true, // Enable sorting
            paging: true, // Enable pagination
        });
    });
</script>
@endpush
