<form action="{{ route('infrastructure.destroy', $infrastructure->id) }}" method="post" id="modal-form-delete-admin-{{ $infrastructure->id }}">
  @csrf
  @method('DELETE')
</form>
