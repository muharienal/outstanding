<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Noto Sans'>

<!-- Modals add menu -->
<style>
    body {
        font-family: 'Noto Sans';
    }

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
        width: 800px;
    }

    .required-label::after {
        content: ' *';
        color: red;
    }

    input[type="range"].form-range::-webkit-slider-thumb {
        background: linear-gradient(180deg, #06693E 0%, #50A245 100%);
    }

    input[type="range"].form-range::-moz-range-thumb {
        background: linear-gradient(180deg, #06693E 0%, #50A245 100%);
    }

    input[type="range"].form-range::-ms-thumb {
        background: linear-gradient(180deg, #06693E 0%, #50A245 100%);
    }
</style>

<div id="modal-form-add-report" class="modal fade" tabindex="-1" aria-labelledby="modal-form-add-report-label" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="text-align: left; flex-shrink: 0; border-radius: 20px; border: 10px solid rgba(255, 255, 255, 0); background: var(--surface-normal, #EFEFEF); box-shadow: 0px 25px 40px 0px rgba(0, 0, 0, 0.10);">
        <div class="modal-content" style="border-radius: 10px">
            <form action="{{ route('report.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="modal-header" style="border-radius: 10px 10px 0 0; background: var(--dark-green-normal, #07834D); box-shadow: 0px 0px 40px 6px rgba(0, 0, 0, 0.25);">
                    <h5 class="modal-title" id="modal-form-add-report-label" style="color: #FFFFFF; font-family: 'Noto Sans', sans-serif; font-style: normal; font-weight: 600; font-size: 16px;">Tambah Data Pemeliharaan</h5>
                    <select style="border-radius: 20px; width: 100px; height: 35px; margin-right: 375px;" class="form-select" id="show_status" name="show_status" data-choices data-choices-removeItem required>
                        <option value="Show">Show</option>
                        <option value="Hide">Hide</option>
                    </select>
                    <x-form.validation.error name="show_status" />
                    <svg style="height: 30px; width: 30px;" data-bs-dismiss="modal" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
                </div>


                <div class="modal-body">

                    @if(auth()->user()->isValidated())
                    
                    <div class="form-row" style="margin-top: 5px; margin-bottom: 30px; margin-left: 10px;">
                        <div>
                            <label for="tanggal_input" class="form-label">Tanggal Input</label>
                            <input style="border-radius: 5px;" type="text" class="form-control" id="tanggal_input" name="tanggal_input" value="{{ now()->format('d/m/Y') }}" readonly>
                            <x-form.validation.error name="tanggal_input" />
                        </div>
                        <div>
                            <label for="tanggal_mulai" class="form-label required-label">Tanggal Mulai</label>
                            <input style="border-radius: 5px;" type="date" class="form-control date-input" id="tanggal_mulai" name="tanggal_mulai" required>
                            <x-form.validation.error name="tanggal_mulai" />
                        </div>
                        <div>
                            <label for="target" class="form-label required-label">Target</label>
                            <input style="border-radius: 5px;" type="date" class="form-control" name="target" id="target" required>
                            <x-form.validation.error name="target" />
                        </div>
                    </div>
                    
                    <div style="padding-left: 28px; padding-right: 17px; padding-top: 20px; padding-bottom: 27px; margin-left: -17px; margin-right: -17px; background: var(--surface-normal, #EFEFEF); box-shadow: 0px 8px 20px 0px rgba(0, 0, 0, 0.10) inset;">
                        <div class="form-row">
                            <div style="flex: 1;">
                                <label for="equipment" class="form-label required-label">Nama Equipment</label>
                                <input style="border-radius: 5px;" type="text" class="form-control" id="equipment" name="equipment" required>
                                <x-form.validation.error name="equipment" />
                            </div>

                            <div style="flex: 1;">
                                <label for="unit" class="form-label required-label">Unit Kerja</label>
                                <select style="border-radius: 5px;" class="form-select" id="unit" name="unit" data-choices data-choices-removeItem required>
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

                            <div style="flex: 1;">
                                <label for="wo_number" class="form-label required-label">WO Number</label>
                                <input style="border-radius: 5px;" class="form-control" name="wo_number" id="wo_number" required></input>
                                <x-form.validation.error name="wo_number" />
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <!-- Group 1 -->
                        <div style="margin-left: 10px;">
                            <div style="margin-top: 18px; margin-bottom: 18px;">
                                <label for="program_kerja" class="form-label required-label">Program Kerja</label>
                                <textarea style="width: 355px; border-radius: 5px;" class="form-control auto-elongate" type="text" id="program_kerja" name="program_kerja" required></textarea>
                                <x-form.validation.error name="program_kerja" />
                            </div>

                            <div style="margin-bottom: 18px;">
                                <label for="status_pekerjaan" class="form-label required-label">Status Pekerjaan</label>
                                <select style="width: 355px; border-radius: 5px;" class="form-select" id="status_pekerjaan" name="status_pekerjaan" data-choices data-choices-removeItem required>
                                    <option value="Rutin">Rutin</option>
                                    <option value="IP">IP</option>
                                    <option value="OK">OK</option>
                                    <option value="Belum">Belum</option>
                                </select>
                                <x-form.validation.error name="status_pekerjaan" />
                            </div>
                        </div>
                        <!-- Group 2 -->
                        <div>
                            <div style="margin-top: 18px; margin-bottom: 18px;">
                                <label for="keterangan_pekerjaan" class="form-label required-label">Rincian Pekerjaan</label>
                                <textarea style="height: 138px; border-radius: 5px;" class="form-control auto-elongate" name="keterangan_pekerjaan" id="keterangan_pekerjaan" required></textarea>
                                <x-form.validation.error name="keterangan_pekerjaan" />
                            </div>
                        </div>
                    </div>

                    <div class="form-row" style="margin-bottom: 12px;">
                        <!-- Group 1 -->
                        <div style="margin-left: 10px;">
                            <div style="margin-bottom: 18px;">
                                <label for="progress" class="form-label required-label">Progress</label>
                                <span id="progressValue" style="font-weight: 600;">0</span>%
                                <br><input style="width: 355px;" type="range" class="form-range" id="progress" name="progress" min="0" max="100" oninput="updateProgressValue(this.value)" value="0" required>
                            </div>

                            <div style="margin-bottom: 18px;">
                                <label for="prioritas" class="form-label required-label">Prioritas</label>
                                    <select style="width: 355px; border-radius: 5px;" class="form-select" id="prioritas" name="prioritas" data-choices data-choices-removeItem required>
                                        <option value="Emergency">Emergency</option>
                                        <option value="High">High</option>
                                        <option value="Medium">Medium</option>
                                        <option value="Low">Low</option>
                                    </select>
                                <x-form.validation.error name="prioritas" />
                            </div>
                        </div>
                        <!-- Group 2 -->
                        <div>
                            <div style="margin-bottom: 18px;">
                                <label for="keterangan" class="form-label required-label">Keterangan Tambahan</label>
                                <textarea style="height: 108px; border-radius: 5px;" class="form-control auto-elongate" name="keterangan" id="keterangan" required></textarea>
                                <x-form.validation.error name="keterangan" />
                            </div>
                        </div>
                    </div>

                    <div style="padding-left: 28px; padding-right: 17px; padding-top: 20px; padding-bottom: 27px; margin-left: -17px; margin-right: -17px; background: var(--surface-normal, #EFEFEF); box-shadow: 0px 8px 20px 0px rgba(0, 0, 0, 0.10) inset;">
                        <div class="form-row">
                            <div style="flex: 1;">
                                <label for="scope_1" class="form-label required-label">Scope 1</label>
                                <select style="border-radius: 5px;" class="form-select" id="scope_1" name="scope_1" data-choices data-choices-removeItem required>
                                    <option value="Mekanik">Mekanik</option>
                                    <option value="Listrik">Listrik</option>
                                    <option value="Instrumen">Instrumen</option>
                                    <option value="Bengkel">Bengkel</option>
                                </select>
                                <x-form.validation.error name="scope_1" />
                            </div>

                            <div style="flex: 1;">
                                <label for="scope_2" class="form-label">Scope 2</label>
                                <select style="border-radius: 5px;" class="form-select" id="scope_2" name="scope_2" data-choices data-choices-removeItem>
                                    <option value="Tidak Ada">Tidak Ada</option>
                                    <option value="Mekanik">Mekanik</option>
                                    <option value="Listrik">Listrik</option>
                                    <option value="Instrumen">Instrumen</option>
                                    <option value="Bengkel">Bengkel</option>
                                </select>
                                <x-form.validation.error name="scope_2" />
                            </div>

                            <div style="flex: 1;">
                                <label for="pic" class="form-label required-label">PIC</label>
                                <select style="border-radius: 5px;" class="form-select" id="pic" name="pic" data-choices data-choices-removeItem required>
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
                        </div>
                    </div>

                    <div class="form-row">
                        <!-- Group 1 -->
                        <div style="margin-left: 10px;">
                            <div style="margin-top: 18px;">
                                <label class="form-label">Upload Foto</label>
                                <div class="input-group">
                                    <input style="border-radius: 5px 5px 0 0;" name="upload_foto[]" type="file" class="form-control" accept="image/*" onchange="previewImage(this, 'preview1')">
                                </div>
                                <x-form.validation.error name="upload_foto" />
                                <img id="preview1" src="" alt="Preview Image" style="max-width: 100%; margin-top: 10px; margin-bottom: 10px; display: none;">
                            </div>

                            <div style="margin-bottom: 18px; margin-top: -1px;">
                                <div class="input-group">
                                    <input style="border-radius: 0 0 5px 5px;" name="upload_foto[]" type="file" class="form-control" accept="image/*" onchange="previewImage(this, 'preview2')">
                                </div>
                                <img id="preview2" src="" alt="Preview Image" style="max-width: 100%; margin-top: 10px; margin-bottom: 10px; display: none;">
                            </div>
                        </div>
                        <!-- Group 2 -->
                        <div>
                            <div style="margin-top: 18px; margin-bottom: 18px;">
                                <label class="form-label">Upload Document</label>
                                    <div class="input-group">
                                        <input name="upload_document[]" type="file" class="form-control" accept=".pdf,.doc,.docx">
                                    </div>
                                <x-form.validation.error name="upload_document" />
                            </div>
                        </div>
                    </div>

                    @else
                    <p>Validate your account first to do reporting!</p>
                    @endif

                </div>
                <div class="modal-footer">
                    @if(auth()->user()->isValidated())
                    <button type="submit" class="btn btn-primary" style="margin-left: 5px; border-radius: 5px; border: none; background: linear-gradient(180deg, #06693E 0%, #50A245 100%); box-shadow: 0px -2px 8px 0px rgba(0, 0, 0, 0.10) inset, 0px 4px 4px 0px rgba(0, 0, 0, 0.25); color: #FFF; font-size: 14px; /* Adjust the font size as needed */ text-decoration: none; /* Remove the default underline */ padding: 8px 15px; /* Adjust the padding as needed */ transition: background-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;">Simpan</button>
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

<script>
    function updateProgressValue(value) {
        document.getElementById('progressValue').innerText = value;
    }
</script>

<script>
    function previewImage(input, previewId) {
        var preview = document.getElementById(previewId);
        var file = input.files[0];
        var reader = new FileReader();

        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = '';
            preview.style.display = 'none';
        }
    }
</script>