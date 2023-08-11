<!-- Modals add menu -->
<style>
     /* Custom CSS to create a horizontal layout */
     .form-row {
        display: flex;
        flex-wrap: wrap;
    }

    .form-row > div {
        flex: 1;
        margin-right: 10px;
    }
    /* Custom CSS to make modals wider */
    .modal-dialog {
        max-width: 800px; /* You can adjust this width to your preference */
    }

    .required-label::after {
        content: ' *';
        color: red;
    }
</style>

<div id="modal-form-add-report" class="modal fade" tabindex="-1" aria-labelledby="modal-form-add-report-label" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('report.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title" id="modal-form-add-report-label">Tambah Data Pemeliharaan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    @if(auth()->user()->isValidated())
                    
                    <div class="form-row">
                    <div class="mb-3">
                        <label for="tanggal_input" class="form-label">Tanggal Input</label>
                        <input type="text" class="form-control" id="tanggal_input" name="tanggal_input" value="{{ now()->format('d/m/Y') }}" readonly>
                        <x-form.validation.error name="tanggal_input" />
                    </div>
                        <div class="mb-3">
                            <label for="tanggal_mulai" class="form-label required-label">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" required>
                            <x-form.validation.error name="tanggal_mulai" />
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="mb-3">
                            <label for="show_status" class="form-label required-label">Show Status</label>
                            <select class="form-select" id="show_status" name="show_status" data-choices data-choices-removeItem required>
                                <option value="Show">Show</option>
                                <option value="Hide">Hide</option>
                            </select>
                            <x-form.validation.error name="show_status" />
                        </div>

                        <div class="mb-3">
                            <label for="unit" class="form-label required-label">Unit Kerja</label>
                            <select class="form-select" id="unit" name="unit" data-choices data-choices-removeItem required>
                                <option value="PA I">PA I</option>
                                <option value="PA II">PA II</option>
                                <option value="SASU I">SASU I</option>
                                <option value="SASU II">SASU II</option>
                                <option value="UBB">UBB</option>
                                <option value="ZA 2">ZA II</option>
                                <option value="Gypsum Alf3">Gypsum AlF3</option>
                                <option value="General">General</option>
                            </select>
                            <x-form.validation.error name="unit" />
                        </div>

                        <div class="mb-3">
                            <label for="equipment" class="form-label required-label">Equipment</label>
                            <input type="text" class="form-control" id="equipment" name="equipment" required>
                            <x-form.validation.error name="equipment" />
                        </div>

                        <div class="mb-3">
                            <label for="program_kerja" class="form-label required-label">Program Kerja</label>
                            <input type="text" class="form-control" id="program_kerja" name="program_kerja" required>
                            <x-form.validation.error name="program_kerja" />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="keterangan_pekerjaan" class="form-label required-label">Keterangan Pekerjaan</label>
                        <textarea class="form-control" name="keterangan_pekerjaan" id="keterangan_pekerjaan" required></textarea>
                        <x-form.validation.error name="keterangan_pekerjaan" />
                    </div>

                    <div class="form-row">
                        <div class="mb-3">
                            <label for="status_pekerjaan" class="form-label required-label">Status Pekerjaan</label>
                            <select class="form-select" id="status_pekerjaan" name="status_pekerjaan" data-choices data-choices-removeItem required>
                                <option value="Rutin">Rutin</option>
                                <option value="IP">IP</option>
                                <option value="OK">OK</option>
                                <option value="Belum">Belum</option>
                            </select>
                            <x-form.validation.error name="status_pekerjaan" />
                        </div>
                        <div class="mb-3">
                            <label for="progress" class="form-label required-label">Progress</label>
                            <input type="text" class="form-control" id="progress" name="progress" pattern="^\d{1,3}%$" title="Masukkan angka antara 0 dan 100 diikuti dengan %" required>
                            <div class="invalid-feedback">
                                Masukkan angka antara 0 dan 100 diikuti dengan %.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="target" class="form-label required-label">Target</label>
                            <input type="date" class="form-control" name="target" id="target" required>
                            <x-form.validation.error name="target" />
                        </div>

                        <div class="mb-3">
                            <label for="wo_number" class="form-label required-label">WO Number</label>
                            <input class="form-control" name="wo_number" id="wo_number" required></input>
                            <x-form.validation.error name="wo_number" />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control" name="keterangan" id="keterangan"></textarea>
                        <x-form.validation.error name="keterangan" />
                    </div>

                    <div class="form-row">
                        <div class="mb-3">
                            <label for="scope_1" class="form-label required-label">Scope 1</label>
                            <select class="form-select" id="scope_1" name="scope_1" data-choices data-choices-removeItem required>
                                <option value="Mekanik">Mekanik</option>
                                <option value="Listrik">Listrik</option>
                                <option value="Instrumen">Instrumen</option>
                                <option value="Bengkel">Bengkel</option>
                            </select>
                            <x-form.validation.error name="scope_1" />
                        </div>

                        <div class="mb-3">
                            <label for="scope_2" class="form-label">Scope 2</label>
                            <select class="form-select" id="scope_2" name="scope_2" data-choices data-choices-removeItem>
                                <option value="Tidak Ada">Tidak Ada</option>
                                <option value="Mekanik">Mekanik</option>
                                <option value="Listrik">Listrik</option>
                                <option value="Instrumen">Instrumen</option>
                                <option value="Bengkel">Bengkel</option>
                            </select>
                            <x-form.validation.error name="scope_2" />
                        </div>

                        <div class="mb-3">
                            <label for="pic" class="form-label required-label">PIC</label>
                            <select class="form-select" id="pic" name="pic" data-choices data-choices-removeItem required>
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
                            <x-form.validation.error name="pic" />
                        </div>

                        <div class="mb-3">
                            <label for="prioritas" class="form-label required-label">Prioritas</label>
                            <select class="form-select" id="prioritas" name="prioritas" data-choices data-choices-removeItem required>
                                <option value="Emergency">Emergency</option>
                                <option value="High">High</option>
                                <option value="Medium">Medium</option>
                                <option value="Low">Low</option>
                            </select>
                            <x-form.validation.error name="prioritas" />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="upload_foto" class="form-label">Upload Foto</label>
                        <input id="upload_foto" name="upload_foto[]" type="file" class="filepond filepond-input-multiple form-control" multiple data-allow-reorder="true" data-max-file-size="3MB" data-max-files="3">
                        <x-form.validation.error name="upload_foto" />
                    </div>

                    <div class="mb-3">
                        <label for="upload_document" class="form-label">Upload Document</label>
                        <input id="upload_document" name="upload_document[]" type="file" class="filepond filepond-input-multiple form-control" multiple data-allow-reorder="true" data-max-file-size="3MB" data-max-files="3">
                        <x-form.validation.error name="upload_document" />
                    </div>

                    @else
                    <p>Validate your account first to do reporting!</p>
                    @endif

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    @if(auth()->user()->isValidated())
                    <button type="submit" class="btn btn-primary ">Save</button>
                    @else
                    <a href="{{ route('user.validation.index') }}" type="button" class="btn btn-primary">Validate</a>
                    @endif
                </div>
            </form>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    const progressInput = document.getElementById('progress');
    const submitButton = document.getElementById('submitButton');

    submitButton.addEventListener('click', function() {
        if (progressInput.checkValidity()) {
            // The input is valid, submit the form
            document.querySelector('form').submit();
        } else {
            // The input is invalid, display custom error message
            alert(progressInput.title);
        }
    });
</script>