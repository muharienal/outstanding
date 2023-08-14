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

<!-- Modals add menu -->
<div id="modal-form-edit-report-{{ $report->id }}" class="modal fade" tabindex="-1" aria-labelledby="modal-form-edit-report-{{ $report->id }}-label" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('report.update', $report->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="modal-form-edit-report-{{ $report->id }}-label">Edit Equipment {{ $report->equipment }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">

                    <input type="hidden" name="_c2VuZGVy" value="VXNlcg==">

                    <div class="form-row">
                        <div class="mb-3">
                            <label for="tanggal_input" class="form-label">Tanggal Input</label>
                            <input type="text" class="form-control" id="tanggal_input" name="tanggal_input" value="{{ $report->tanggal_input }}" readonly>
                            <x-form.validation.error name="tanggal_input" />
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value="{{ $report->tanggal_mulai }}">
                            <x-form.validation.error name="tanggal_mulai" />
                        </div>
                    </div>

                    <div class="form-row">
                    <div class="mb-3">
                        <label for="show_status" class="form-label required-label">Show Status</label>
                        <select class="form-select" id="show_status" name="show_status" data-choices data-choices-removeItem required>
                            <option value="Show" {{ $report->show_status === 'Show' ? 'selected' : '' }}>Show</option>
                            <option value="Hide" {{ $report->show_status === 'Hide' ? 'selected' : '' }}>Hide</option>
                        </select>
                        <x-form.validation.error name="show_status" />
                    </div>

                        <div class="mb-3">
                            <label for="unit" class="form-label required-label">Unit Kerja</label>
                            <select class="form-select" id="unit" name="unit" data-choices data-choices-removeItem required>
                                <option value="PA I" {{ $report->unit === 'PA I' ? 'selected' : '' }}>PA I</option>
                                <option value="PA II" {{ $report->unit === 'PA II' ? 'selected' : '' }}>PA II</option>
                                <option value="SASU I" {{ $report->unit === 'SASU I' ? 'selected' : '' }}>SASU I</option>
                                <option value="SASU II" {{ $report->unit === 'SASU II' ? 'selected' : '' }}>SASU II</option>
                                <option value="UBB" {{ $report->unit === 'UBB' ? 'selected' : '' }}>UBB</option>
                                <option value="ZA II" {{ $report->unit === 'ZA II' ? 'selected' : '' }}>ZA II</option>
                                <option value="Gypsum AlF3" {{ $report->unit === 'Gypsum AlF3' ? 'selected' : '' }}>Gypsum AlF3</option>
                                <option value="General" {{ $report->unit === 'General' ? 'selected' : '' }}>General</option>
                            </select>
                            <x-form.validation.error name="unit" />
                        </div>

                        <div class="mb-3">
                            <label for="equipment" class="form-label required-label">Equipment</label>
                            <input type="text" class="form-control" id="equipment" name="equipment" value="{{ $report->equipment }}" required>
                            <x-form.validation.error name="equipment" />
                        </div>

                        <div class="mb-3">
                            <label for="program_kerja" class="form-label required-label">Program Kerja</label>
                            <input type="text" class="form-control" id="program_kerja" name="program_kerja" value="{{ $report->program_kerja }}" required>
                            <x-form.validation.error name="program_kerja" />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="keterangan_pekerjaan" class="form-label required-label">Keterangan Pekerjaan</label>
                        <textarea class="form-control" name="keterangan_pekerjaan" id="keterangan_pekerjaan" required>{{ $report->keterangan_pekerjaan }}</textarea>
                        <x-form.validation.error name="keterangan_pekerjaan" />
                    </div>

                    <div class="form-row">
                    <div class="mb-3">
                        <label for="status_pekerjaan" class="form-label required-label">Status Pekerjaan</label>
                        <select class="form-select" id="status_pekerjaan" name="status_pekerjaan" data-choices data-choices-removeItem required>
                            <option value="Rutin" {{ $report->status_pekerjaan === 'Rutin' ? 'selected' : '' }}>Rutin</option>
                            <option value="IP" {{ $report->status_pekerjaan === 'IP' ? 'selected' : '' }}>IP</option>
                            <option value="OK" {{ $report->status_pekerjaan === 'OK' ? 'selected' : '' }}>OK</option>
                            <option value="Belum" {{ $report->status_pekerjaan === 'Belum' ? 'selected' : '' }}>Belum</option>
                        </select>
                        <x-form.validation.error name="status_pekerjaan" />
                    </div>

                        <div class="mb-3">
                            <label for="progress" class="form-label">Progress</label>
                            <input type="text" class="form-control" id="progress" name="progress" value="{{ $report->progress }}" pattern="^\d{1,3}%$" title="Masukkan angka antara 0 dan 100 diikuti dengan %">
                            <div class="invalid-feedback">
                                Masukkan angka antara 0 dan 100 diikuti dengan %.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="target" class="form-label">Target</label>
                            <input type="date" class="form-control" name="target" id="target" value="{{ $report->target }}">
                            <x-form.validation.error name="target" />
                        </div>

                        <div class="mb-3">
                            <label for="wo_number" class="form-label">WO Number</label>
                            <input class="form-control" name="wo_number" id="wo_number" value="{{ $report->wo_number }}"></input>
                            <x-form.validation.error name="wo_number" />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control" name="keterangan" id="keterangan">{{ $report->keterangan }}</textarea>
                        <x-form.validation.error name="keterangan" />
                    </div>

                    <div class="form-row">
                    <div class="mb-3">
                        <label for="scope_1" class="form-label">Scope 1</label>
                        <select class="form-select" id="scope_1" name="scope_1" data-choices data-choices-removeItem>
                            <option value="Mekanik" {{ $report->scope_1 === 'Mekanik' ? 'selected' : '' }}>Mekanik</option>
                            <option value="Listrik" {{ $report->scope_1 === 'Listrik' ? 'selected' : '' }}>Listrik</option>
                            <option value="Instrumen" {{ $report->scope_1 === 'Instrumen' ? 'selected' : '' }}>Instrumen</option>
                            <option value="Bengkel" {{ $report->scope_1 === 'Bengkel' ? 'selected' : '' }}>Bengkel</option>
                        </select>
                        <x-form.validation.error name="scope_1" />
                    </div>

                        <div class="mb-3">
                            <label for="scope_2" class="form-label">Scope 2</label>
                            <select class="form-select" id="scope_2" name="scope_2" data-choices data-choices-removeItem>
                                <option value="Tidak Ada" {{ $report->scope_2 === 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada</option>
                                <option value="Mekanik" {{ $report->scope_2 === 'Mekanik' ? 'selected' : '' }}>Mekanik</option>
                                <option value="Listrik" {{ $report->scope_2 === 'Listrik' ? 'selected' : '' }}>Listrik</option>
                                <option value="Instrumen" {{ $report->scope_2 === 'Instrumen' ? 'selected' : '' }}>Instrumen</option>
                                <option value="Bengkel" {{ $report->scope_2 === 'Bengkel' ? 'selected' : '' }}>Bengkel</option>
                            </select>
                            <x-form.validation.error name="scope_2" />
                        </div>

                        <div class="mb-3">
                            <label for="pic" class="form-label">PIC</label>
                            <select class="form-select" id="pic" name="pic" data-choices data-choices-removeItem>
                                <option value="Viki" {{ $report->pic === 'Viki' ? 'selected' : '' }}>Viki</option>
                                <option value="Faqih" {{ $report->pic === 'Faqih' ? 'selected' : '' }}>Faqih</option>
                                <option value="Yunianton" {{ $report->pic === 'Yunianton' ? 'selected' : '' }}>Yunianton</option>
                                <option value="Digdyo" {{ $report->pic === 'Digdyo' ? 'selected' : '' }}>Digdyo</option>
                                <option value="Tiar" {{ $report->pic === 'Tiar' ? 'selected' : '' }}>Tiar</option>
                                <option value="Oki" {{ $report->pic === 'Oki' ? 'selected' : '' }}>Oki</option>
                                <option value="Arik" {{ $report->pic === 'Arik' ? 'selected' : '' }}>Arik</option>
                                <option value="Bima" {{ $report->pic === 'Bima' ? 'selected' : '' }}>Bima</option>
                                <option value="Rheza" {{ $report->pic === 'Rheza' ? 'selected' : '' }}>Rheza</option>
                                <option value="Fedrik" {{ $report->pic === 'Fedrik' ? 'selected' : '' }}>Fedrik</option>
                            </select>
                            <x-form.validation.error name="pic" />
                        </div>

                        <div class="mb-3">
                            <label for="prioritas" class="form-label">Prioritas</label>
                            <select class="form-select" id="prioritas" name="prioritas" data-choices data-choices-removeItem>
                                <option value="Emergency" {{ $report->prioritas === 'Emergency' ? 'selected' : '' }}>Emergency</option>
                                <option value="High" {{ $report->prioritas === 'High' ? 'selected' : '' }}>High</option>
                                <option value="Medium" {{ $report->prioritas === 'Medium' ? 'selected' : '' }}>Medium</option>
                                <option value="Low" {{ $report->prioritas === 'Low' ? 'selected' : '' }}>Low</option>
                            </select>
                            <x-form.validation.error name="prioritas" />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Upload Foto</label>
                        <div class="input-group">
                            <input name="upload_foto[]" type="file" class="form-control" accept="image/*">
                        </div>
                        <x-form.validation.error name="upload_foto" />
                    </div>

                    <div class="mb-3">
                        <div class="input-group">
                            <input name="upload_foto[]" type="file" class="form-control" accept="image/*">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Upload Document</label>
                        <div class="input-group">
                            <input name="upload_document[]" type="file" class="form-control" accept=".pdf,.doc,.docx">
                        </div>
                        <x-form.validation.error name="upload_document" />
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary ">Update</button>
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
