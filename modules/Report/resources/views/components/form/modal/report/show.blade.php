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
    /* Custom class for the status label */
    .status-label {
        display: block;
        margin-top: 5px; /* Adjust the spacing between label and status */
    }

    /* Custom class for the status span */
    .status-span {
        display: inline-block;
        padding: 2px 6px; /* Adjust the padding for the button-like appearance */
        font-size: 12px; /* Adjust the font size to make it small */
        border: 1px solid #ccc; /* Add a border to make it look like a button */
        border-radius: 4px; /* Rounded corners for the button-like appearance */
        pointer-events: none; /* Disable mouse events on the status span */
        color: #ffffff
    }

    /* Custom class for the status label */
    .prioritas-label {
        display: block;
        margin-top: 5px; /* Adjust the spacing between label and status */
    }

    /* Custom class for the status span */
    .prioritas-span {
        display: inline-block;
        padding: 2px 6px; /* Adjust the padding for the button-like appearance */
        font-size: 12px; /* Adjust the font size to make it small */
        border: 1px solid #ccc; /* Add a border to make it look like a button */
        border-radius: 4px; /* Rounded corners for the button-like appearance */
        pointer-events: none; /* Disable mouse events on the status span */
        color: #ffffff
    }
</style>

<!-- Modals add menu -->
<div id="modal-form-show-report-{{ $report->id }}" class="modal fade" tabindex="-1" aria-labelledby="modal-form-show-report-{{ $report->id }}-label" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modal-form-show-report-{{ $report->id }}-label">Detail Equipment {{ $report->equipment }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>

            <div class="modal-body">

            <div class="form-row">
                <div class="mb-3 ">
                    <label for="tanggal_input" class="form-label">Tanggal Input</label>
                    <input type="date" class="form-control" id="tanggal_input" name="tanggal_input" value="{{ \Carbon\Carbon::parse($report->tanggal_input)->format('d/m/Y') }}" readonly>
                    <x-form.validation.error name="tanggal_input" />
                </div>

                <div class="mb-3">
                    <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                    <input type="text" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value="{{ \Carbon\Carbon::parse($report->tanggal_mulai)->format('d/m/Y') }}" readonly>
                    <x-form.validation.error name="tanggal_mulai" />
                </div>
            </div>

            <div class="form-row">
                <div class="mb-3">
                    <label for="unit" class="form-label">Unit Kerja</label>
                    <input type="text" class="form-control" id="unit" name="unit" value="{{ $report->unit }}" readonly>
                    <x-form.validation.error name="unit" />
                </div>

                <div class="mb-3">
                    <label for="equipment" class="form-label">Equipment</label>
                    <input type="text" class="form-control" id="equipment" name="equipment" value="{{ $report->equipment }}" readonly>
                    <x-form.validation.error name="equipment" />
                </div>

                <div class="mb-3">
                    <label for="program_kerja" class="form-label">Program Kerja</label>
                    <input type="text" class="form-control" id="program_kerja" name="program_kerja" value="{{ $report->program_kerja }}" readonly>
                    <x-form.validation.error name="program_kerja" />
                </div>
            </div>

            <div class="mb-3">
                <label for="keterangan_pekerjaan" class="form-label">Keterangan Pekerjaan</label>
                <textarea class="form-control" name="keterangan_pekerjaan" id="keterangan_pekerjaan"readonly>{{ $report->keterangan_pekerjaan }}</textarea>
                <x-form.validation.error name="keterangan_pekerjaan" />
            </div>

            <div class="form-row">
                <div class="mb-3">
                    <label for="status_pekerjaan" class="form-label">Status Pekerjaan</label>
                    <span class="status-label">
                        <span class="status-span bg-{{ $report->getStatusColor() }}">{{ $report->status_pekerjaan }}</span>
                    </span>
                    <x-form.validation.error name="status_pekerjaan" />
                </div>

                <div class="mb-3">
                    <label for="progress" class="form-label">Progress</label>
                    @php
                        $progressColorClass = '';
                        $progress = intval($report->progress);
                        if ($progress >= 0 && $progress <= 33) {
                            $progressColorClass = 'bg-danger';
                        } elseif ($progress >= 34 && $progress <= 67) {
                            $progressColorClass = 'bg-warning';
                        } elseif ($progress >= 67 && $progress <= 100) {
                            $progressColorClass = 'bg-success';
                        }
                    @endphp
                    <div class="progress" style="height: 25px; margin-top: 5px;">
                        <div class="progress-bar {{ $progressColorClass }}" role="progressbar" style="width: {{ $progress }}%;" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">{{ $report->progress }}</div>
                    </div>
                    <x-form.validation.error name="progress" />
                </div>
                <div class="mb-3">
                    <label for="target" class="form-label">Target</label>
                    <input type="text" class="form-control" id="target" name="target" value="{{ \Carbon\Carbon::parse($report->target)->format('d/m/Y') }}" readonly>
                    <x-form.validation.error name="target" />
                </div>
                
                <div class="mb-3">
                    <label for="wo_number" class="form-label">WO Number</label>
                    <input type="text" class="form-control" id="wo_number" name="wo_number" value="{{ $report->wo_number }}" readonly>
                    <x-form.validation.error name="wo_number" />
                </div>
            </div>

            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea class="form-control" id="keterangan" name="keterangan" readonly>{{ $report->keterangan }}</textarea>
                <x-form.validation.error name="keterangan" />
            </div>

            <div class="form-row">
                <div class="mb-3">
                    <label for="scope_1" class="form-label">Scope 1</label>
                    <input type="text" class="form-control" id="scope_1" name="scope_1" value="{{ $report->scope_1 }}" readonly>
                    <x-form.validation.error name="scope_1" />
                </div>

                <div class="mb-3">
                    <label for="scope_2" class="form-label">Scope 2</label>
                    <input type="text" class="form-control" id="scope_2" name="scope_2" value="{{ $report->scope_2 }}" readonly>
                    <x-form.validation.error name="scope_2" />
                </div>

                <div class="mb-3">
                    <label for="pic" class="form-label">PIC</label>
                    <input type="text" class="form-control" id="pic" name="pic" value="{{ $report->pic }}" readonly>
                    <x-form.validation.error name="pic" />
                </div>

                <div class="mb-3">
                    <label for="prioritas" class="form-label">Prioritas</label>
                    <span class="status-label">
                        <span class="prioritas-span bg-{{ $report->getPrioritasColor() }}">{{ $report->prioritas }}</span>
                    </span>
                    <x-form.validation.error name="prioritas" />
                </div>
            </div>

            <div class="mb-3">
                <label for="upload_foto" class="form-label">Upload foto</label>
                <ul>
                    @foreach($report->upload_foto as $photo)
                        <li>
                            <a href="{{ asset('assets/files/upload_foto/' . $photo) }}" target="_blank">{{ $photo }}</a>
                        </li>
                    @endforeach
                </ul>
                <x-form.validation.error name="upload_foto" />
            </div>

            <div class="mb-3">
                <label for="upload_document" class="form-label">Upload Document</label>
                <ul>
                    @foreach($report->upload_document as $document)
                        <li>
                            <a href="{{ asset('assets/files/upload_document/' . $document) }}" target="_blank">{{ $document }}</a>
                        </li>
                    @endforeach
                </ul>
                <x-form.validation.error name="upload_document" />
            </div>

            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
