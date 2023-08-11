<!-- Modals add menu -->
<div id="modal-form-add-report" class="modal fade" tabindex="-1" aria-labelledby="modal-form-add-report-label" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('libraries.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="modal-form-add-report-label">Add Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="tgl_regis" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tgl_regis" name="tgl_regis">
                        <x-form.validation.error name="tgl_regis" />
                    </div>

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama">
                        <x-form.validation.error name="nama" />
                    </div>

                    <div class="mb-3">
                        <label for="no_draw" class="form-label">No Drawing</label>
                        <input type="text" class="form-control" id="no_draw" name="no_draw">
                        <x-form.validation.error name="no_draw" />
                    </div>

                    <div class="mb-3">
                        <label for="equiptment" class="form-label">Equipment</label>
                        <textarea class="form-control" name="equiptment" id="equiptment"></textarea>
                        <x-form.validation.error name="equiptment" />
                    </div>

                    <div class="mb-3">
                        <label for="pdf" class="form-label">PDF</label>
                        <input type="file" class="form-control" id="pdf" name="pdf">
                        <x-form.validation.error name="pdf" />
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary ">Save</button>
                </div>
            </form>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
