<form action="{{ route('report.destroy', $report->id) }}" method="post" id="modal-form-delete-report-{{ $report->id }}">
  @csrf
  @method('DELETE')
</form>
