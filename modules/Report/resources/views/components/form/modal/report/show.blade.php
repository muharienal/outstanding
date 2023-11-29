<?php
// Assuming $report->target is a valid date string

$targetDate = $report->target ? new DateTime($report->target) : null;
$currentDate = new DateTime(); // Current date

if ($targetDate) {
$interval = $currentDate->diff($targetDate);

// Check if the target date is in the past
$isPast = $currentDate > $targetDate;

// Access the interval properties
$months = $interval->format('%m');
$days = $interval->format('%d');

// Output the result with a '-' if in the past
$result = $isPast ? "Terlewat {$months} Bulan, {$days} Hari" : "{$months} Bulan, {$days} Hari";
} else {
$result = "Invalid target date";
}
?>

<?php
// Assuming $report->tanggal_mulai and $report->target are valid date strings

$tanggalMulai = $report->tanggal_mulai ? new DateTime($report->tanggal_mulai) : null;
$target = $report->target ? new DateTime($report->target) : null;

if ($tanggalMulai && $target) {
$interval = $tanggalMulai->diff($target);

// Access the interval properties
$months = $interval->format('%m');
$days = $interval->format('%d');

// Output the result
$result1 = "{$months} Bulan, {$days} Hari";
} else {
$result1 = "Invalid date(s)";
}
?>

<!-- Add stylesheets -->
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Noto Sans'>

<style>
    /* Custom CSS for layout and modals */
    .form-row {
        display: flex;
        flex-wrap: wrap;
    }

    .form-row > div {
        flex: 1;
        margin-right: 10px;
    }

    .modal-dialog {
        width: 800px;
    }

    /* Custom classes for status and priority labels */
    .status-label,
    .prioritas-label {
        display: block;
        margin-top: 5px;
    }

    /* Custom classes for status and priority spans */
    .status-span,
    .prioritas-span {
        display: inline-block;
        padding: 2px 6px;
        font-size: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        pointer-events: none;
        color: #ffffff;
    }
</style>

<!-- Modals add menu -->
<div id="modal-form-show-report-{{ $report->id }}" class="modal fade" tabindex="-1" aria-labelledby="modal-form-show-report-{{ $report->id }}-label" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl modal-dialog-centered" style="text-align: left; flex-shrink: 0; border-radius: 20px; border: 10px solid rgba(255, 255, 255, 0); background: var(--surface-normal, #EFEFEF); box-shadow: 0px 25px 40px 0px rgba(0, 0, 0, 0.10);">
    <div class="modal-content">
    <div class="modal-header" style="border-radius: 10px 10px 0 0; height: 175px; flex-shrink: 0; background: url('{{ asset('assets/images/banner-show.webp') }}') center / cover no-repeat;">
        <div class="container-fluid">
            <div class="row">
                <!-- Column 1: Group 1 - Unit and Equipment -->
                <div class="col-4">
                    <!-- Group 1: Unit -->
                    <span style="color: var(--alert-warning-light-active, #FEE3BC); leading-trim: both; text-edge: cap; font-family: 'Noto Sans', sans-serif; font-size: 14px; font-style: normal; font-weight: 500; line-height: normal; text-align: left;">
                        Unit :
                    </span><br>
                    <span style="color: var(--surface-light, #FDFDFD); leading-trim: both; text-edge: cap; font-family: 'Noto Sans', sans-serif; font-size: 26px; font-style: normal; font-weight: 700; line-height: normal; text-align: left;">
                        {{ $report->unit }}
                    </span><br><br>

                    <!-- Group 2: Equipment -->
                    <span style="color: var(--alert-warning-light-active, #FEE3BC); leading-trim: both; text-edge: cap; font-family: 'Noto Sans', sans-serif; font-size: 14px; font-style: normal; font-weight: 500; line-height: normal; text-align: left;">
                        Equipment :
                    </span><br>
                    <span style="color: var(--surface-light, #FDFDFD); leading-trim: both; text-edge: cap; font-family: 'Noto Sans', sans-serif; font-size: 26px; font-style: normal; font-weight: 700; line-height: normal; text-align: left;">
                        {{ $report->equipment }}
                    </span>
                </div>

                <!-- Column 2: Program Kerja -->
                <div class="col-6">
                    <div style="margin-top: -5px; color: var(--alert-warning-light-active, #FEE3BC); font-family: 'Noto Sans', sans-serif; font-size: 14px; font-style: normal; font-weight: 500; line-height: normal;">
                        Program Kerja :
                        <span style="text-align: left; color: var(--surface-light, #FDFDFD); font-family: 'Noto Sans', sans-serif; font-size: 18px; font-style: normal; font-weight: 700; line-height: normal; white-space: pre-line;">
                            {{ $report->program_kerja }}
                        </span>
                    </div>
                </div>

                <div class="col-1 text-right">
                    <svg style="margin-top: -10px; margin-left: 85px; height: 30px; width: 30px;" data-bs-dismiss="modal" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512">
                        <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Body -->
    <div class="modal-body p-0">
        <div class="container-fluid">
            <div class="row">
                <!-- Left Column -->
                <div class="col-md-4" style="background-color: #EFEFEF; padding: 15px;">
                    <div class="card-group-container">
                        <div class="d-flex justify-content-between">
                            <!-- First Card -->
                            <div>
                                <div class="card-container" style="width: 235px;">
                                    <div class="d-flex align-items-center justify-content-center flex-column h-100" style="padding: 15px 15px; border-radius: 10px; background: var(--orange-light, #FFF7E6); box-shadow: 0px 12px 16px -8px rgba(0, 0, 0, 0.10);">
                                        <div class="text-center" style="margin-top: 5px;">
                                            <!-- Content for the card -->
                                            <div class="mb-2" style="display: flex; align-items: flex-start;">
                                                <p style="margin-left: 5px; margin-top: 33px; margin-right: 5px; white-space: pre-line; font-size: 12px; color: #CB8F00; font-family: 'Noto Sans', sans-serif; font-style: normal; font-weight: 600;"><?php echo $result1; ?></p>
                                                <img src="{{ asset('assets/images/strip.png') }}" style="margin-top: 8px; width: 5%; height: 5%; margin-right: 5px;" />

                                                <div style="margin-left: 10px;"> <!-- Adjust the margin-left as needed -->
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ asset('assets/images/start.png') }}" style="width: 21px; height: 21px; margin-right: 5px;" />
                                                        <label class="form-label" style="margin-right: 5px; color: #595959; font-family: 'Noto Sans', sans-serif; font-style: normal; font-weight: 400;">Tanggal Mulai</label>
                                                    </div>
                                                    <p style="margin-right: 5px; margin-bottom: 25px; margin-top: -10px; margin-left: 28px; font-size: 16px; color: #595959; font-family: 'Noto Sans', sans-serif; font-style: normal; font-weight: 600;">{{ $report->tanggal_mulai ? date('d/m/Y', strtotime($report->tanggal_mulai)) : '' }}</p>
                                                    <div class="d-flex align-items-center" style="margin-top: 25px;">
                                                        <img src="{{ asset('assets/images/finish.png') }}" style="width: 21px; height: 21px; margin-right: 5px;" />
                                                        <label class="form-label" style="color: #595959; font-family: 'Noto Sans', sans-serif; font-style: normal; font-weight: 400;">Target Selesai</label>
                                                    </div>
                                                    <p style="margin-right: 5px; margin-top: -10px; margin-left: 28px; font-size: 16px; color: #595959; font-family: 'Noto Sans', sans-serif; font-style: normal; font-weight: 600;">{{ $report->target ? date('d/m/Y', strtotime($report->target)) : '' }}</p>
                                                </div>
                                            </div>
                                                <div class="card-group-container" style="margin-top: -10px; margin-left: 5px; margin-right: 5px; margin-bottom: 5px;">
                                                <!-- Card with Header -->
                                                <div>
                                                    <div class="card-container" style="width: 210px;">
                                                        <!-- Header with specified style -->
                                                        <div class="d-flex align-items-center justify-content-center h-100" style="height: 25px; background: var(--orange-normal-active, #CB8F00); border-radius: 10px 10px 0 0;">
                                                            <label for="progress" class="form-label" style="padding-top: 8px; padding-bottom: 3px; color: #FFFFFF; font-family: 'Noto Sans', sans-serif; font-style: normal; font-weight: 600; font-size: 14px;">Deadline Pengerjaan</label>
                                                        </div>

                                                        <!-- Card Content -->
                                                        <div class="d-flex align-items-center justify-content-center h-100" style="padding-left: 15px; padding-right: 15px; padding-bottom: 10px; padding-top: 5px; border-radius: 0 0 10px 10px; background: var(--orange-light-active, #FFE7B0); box-shadow: 0px 12px 16px -8px rgba(0, 0, 0, 0.16);">
                                                            <div class="text-left" style="margin-top: 5px;">
                                                                <p style="margin: 0; white-space: pre-line; font-size: 14px; color: #58390E; font-family: 'Noto Sans', sans-serif; font-style: normal; font-weight: 600;"><?php echo $result; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End of first card -->
                        </div>
                    </div>

                    <!-- Card Group 1 -->
                    <div class="card-group-container" style="margin-top: 27px;">
                        <!-- Card with Header -->
                        <div style="margin-right: 15px;">
                            <div class="card-container" style="width: 235px;">
                                <!-- Card Content -->
                                <div class="d-flex align-items-center justify-content-start h-100" style="padding-left: 15px; padding-right: 15px; padding-bottom: 10px; padding-top: 5px; border-radius: 10px; background: #FFFFFF; box-shadow: 0px 12px 16px -8px rgba(0, 0, 0, 0.16);">
                                    <!-- Add the image to the left -->
                                    <img src="{{ asset('assets/images/document.png') }}" style="margin-top: 10px; margin-bottom: 5px; width: 25px; height: 25px; margin-right: 5px;" />
                                    
                                    <div class="text-left" style="margin-top: 5px;">
                                        <!-- Your existing <p> element -->
                                        <p style="margin-left: 10px; white-space: pre-line; font-size: 14px; color: #595959; font-family: 'Noto Sans', sans-serif; font-style: normal; font-weight: 600;">Nomor WO</p>
                                        <p style="margin-left: 10px; margin-top: -17px; margin-bottom: 0px; white-space: pre-line; font-size: 16px; color: #595959; font-family: 'Noto Sans', sans-serif; font-style: normal; font-weight: 600;">{{ $report->wo_number }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card Group 2 -->
                    <div class="card-group-container" style="margin-top: 15px;">
                        <!-- Card with Header -->
                        <div style="margin-right: 15px;">
                            <div class="card-container" style="width: 235px;">
                                <!-- Card Content -->
                                <div class="d-flex align-items-center justify-content-start h-100" style="padding-left: 15px; padding-right: 15px; padding-bottom: 10px; padding-top: 5px; border-radius: 10px; background: #FFFFFF; box-shadow: 0px 12px 16px -8px rgba(0, 0, 0, 0.16);">
                                    <div class="text-left" style="margin-top: 5px;">
                                        <div class="row">
                                            <!-- Column for Scope 1 -->
                                            <div class="col-md-5">
                                                <p style="white-space: pre-line; font-size: 14px; color: #595959; font-family: 'Noto Sans', sans-serif; font-style: normal; font-weight: 600;">Scope 1</p>
                                                <p style="margin-top: -17px; margin-bottom: 0px; font-size: 16px; color: #595959; font-family: 'Noto Sans', sans-serif; font-style: normal; font-weight: 600;">{{ $report->scope_1 }}</p>
                                            </div>
                                            <!-- Column for Image -->
                                            <div class="col-md-2">
                                                <img src="{{ asset('assets/images/line.png') }}" style="margin-top: 4px; margin-left: 10px; height: 35px;"/>
                                            </div>
                                            <!-- Column for Scope 2 -->
                                            <div class="col-md-5">
                                                <p style="white-space: pre-line; font-size: 14px; color: #595959; font-family: 'Noto Sans', sans-serif; font-style: normal; font-weight: 600;">Scope 2</p>
                                                <p style="margin-top: -17px; margin-bottom: 0px; font-size: 16px; color: #595959; font-family: 'Noto Sans', sans-serif; font-style: normal; font-weight: 600;">{{ $report->scope_2 }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card Group 3 -->
                    <div class="card-group-container" style="margin-top: 15px;">
                        <!-- Card with Header -->
                        <div style="margin-right: 15px;">
                            <div class="card-container" style="width: 235px;">
                                <!-- Card Content -->
                                <div class="d-flex align-items-center justify-content-center h-100" style="padding-left: 15px; padding-right: 15px; padding-bottom: 10px; padding-top: 5px; border-radius: 10px; background: #FFFFFF; box-shadow: 0px 12px 16px -8px rgba(0, 0, 0, 0.16);">
                                    <div class="text-center" style="margin-top: 5px;">
                                        <!-- Your existing <p> element -->
                                        <p style="white-space: pre-line; font-size: 14px; color: #595959; font-family: 'Noto Sans', sans-serif; font-style: normal; font-weight: 600;">PIC</p>
                                        <p style="margin-top: -17px; margin-bottom: 0px; white-space: pre-line; font-size: 16px; color: #595959; font-family: 'Noto Sans', sans-serif; font-style: normal; font-weight: 600;">{{ $report->pic }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center" style="margin-top: 20px;">
                        @if (!empty($report->upload_document) && is_array($report->upload_document))
                            @foreach ($report->upload_document as $index => $documentPath)
                                <span style="font-size: 14px; color: #595959; font-family: 'Noto Sans', sans-serif; font-style: normal; font-weight: 600;">FILE PENDUKUNG</span>
                                <div>
                                    <a href="{{ asset('assets/files/upload_document/' . $documentPath) }}" download class="btn btn-primary btn-sm mt-2" style="border-radius: 5px; border: none; background: linear-gradient(180deg, #06693E 0%, #50A245 100%); box-shadow: 0px -2px 8px 0px rgba(0, 0, 0, 0.10) inset, 0px 4px 4px 0px rgba(0, 0, 0, 0.25); color: #FFF; font-size: 12px; padding: 5px 12px; transition: background-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out; text-decoration: none;">Download</a>
                                </div>
                            @endforeach
                        @else
                            <p style="margin-top: -10px;"></p>
                        @endif
                    </div>
                </div>

                <!-- Right Column -->
<div class="col-md-8" style="padding: 15px;">
    <!-- Second Card -->
    <div class="card-group-container">
        <div class="d-flex justify-content-between">

            <!-- Prioritas Card -->
            <div class="text-center" style="margin-top: 5px; margin-right: 15px;">
                <div class="card-container" style="width: 190px; height: 45px;">
                    <div class="d-flex align-items-center justify-content-center flex-column h-100" style="padding: 10px 15px; border-radius: 10px; background: var(--surface-light-active, #FAFAFA); box-shadow: 0px 12px 16px -8px rgba(0, 0, 0, 0.16);">
                        <div class="text-center" style="margin-top: 5px;">
                            <label for="prioritas" class="form-label" style="margin-right: 10px; color: #595959; font-family: 'Noto Sans', sans-serif; font-style: normal; font-weight: 600; margin-bottom: 10px;">Prioritas</label>
                            <button class="btn btn-sm btn-{{ $prioritasColor }} no-hover-btn" style="background-color: {{ $prioritasColor }}; color: {{ $fontColorPrioritas }}; font-family: 'Noto Sans', sans-serif; font-style: normal; font-weight: 500; border-radius: 7px;">
                                {{ $report->prioritas }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Card -->
            <div class="text-center" style="margin-top: 5px; margin-right: 15px;">
                <div class="card-container" style="width: 125px; height: 45px;">
                    <div class="d-flex align-items-center justify-content-center flex-column h-100" style="padding: 10px 15px; border-radius: 10px; background: var(--surface-light-active, #FAFAFA); box-shadow: 0px 12px 16px -8px rgba(0, 0, 0, 0.16);">
                        <div class="text-center" style="margin-top: 5px;">
                            <label for="status" class="form-label" style="margin-right: 10px; color: #595959; font-family: 'Noto Sans', sans-serif; font-style: normal; font-weight: 600; margin-bottom: 10px;">Status</label>
                            <button class="btn btn-sm btn-{{ $statusColor }} no-hover-btn" style="background-color: {{ $statusColor }}; color: {{ $fontColor }}; font-family: 'Noto Sans', sans-serif; font-style: normal; font-weight: 500; border-radius: 7px;">
                                {{ $report->status_pekerjaan }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Progress Card -->
            <div class="text-center" style="margin-top: 5px;">
                <div class="card-container" style="width: 145px; height: 45px; margin-right: 5px;">
                    <div class="d-flex align-items-center justify-content-center flex-column h-100" style="padding: 10px 15px; border-radius: 10px; background: var(--surface-light-active, #FAFAFA); box-shadow: 0px 12px 16px -8px rgba(0, 0, 0, 0.16);">
                        <div class="text-center" style="margin-top: -5px;">
                            <label for="progress" class="form-label" style="margin-right: 10px; color: #595959; font-family: 'Noto Sans', sans-serif; font-style: normal; font-weight: 600;">Progress</label>
                            {{ $report->progress }}%
                            @php
                                $progressColorClass = '';
                                $progress = intval($report->progress);
                                if ($progress >= 0 && $progress <= 33) {
                                    $progressColorClass = 'bg-danger';
                                } elseif ($progress >= 34 && $progress <= 67) {
                                    $progressColorClass = 'bg-warning';
                                } elseif ($progress >= 68 && $progress <= 100) {
                                    $progressColorClass = 'bg-success';
                                }
                            @endphp
                            <div class="progress-bar {{ $progressColorClass }}" role="progressbar" style="margin-top: -5px; border-radius: 20px; width: {{ $progress }}%; height: 10px;" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Card Group 1 -->
    <div class="card-group-container" style="margin-top: 15px; display: flex; flex-direction: column;">

        <!-- Card with Header 1 -->
        <div style="margin-bottom: 15px;">
            <div class="card-container" style="width: 490px;">
                <!-- Header with specified style -->
                <div class="d-flex align-items-center justify-content-start h-100" style="height: 25px; background: var(--dark-green-normal, #07834D); border-radius: 10px 10px 0 0; padding-left: 15px;">
                    <label for="progress" class="form-label" style="padding-top: 8px; padding-bottom: 3px; color: #FFFFFF; font-family: 'Noto Sans', sans-serif; font-style: normal; font-weight: 600; font-size: 14px;">Rincian Pekerjaan</label>
                </div>

                <!-- Card Content 1 -->
                <div class="d-flex align-items-center justify-content-start h-100" style="padding-left: 15px; padding-right: 15px; padding-bottom: 10px; padding-top: 5px; border-radius: 0 0 10px 10px; background: var(--surface-light-active, #FAFAFA); box-shadow: 0px 12px 16px -8px rgba(0, 0, 0, 0.16);">
                    <div class="text-left" style="margin-top: 5px;">
                        <p style="margin: 0; white-space: pre-line;">{{ $report->keterangan_pekerjaan }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Group 2 -->
        <div>
            <div class="card-container" style="width: 490px;">
                <!-- Header with specified style -->
                <div class="d-flex align-items-center justify-content-start h-100" style="height: 25px; background: var(--soft-green-normal, #59B44D); border-radius: 10px 10px 0 0; padding-left: 15px;">
                    <label for="progress" class="form-label" style="padding-top: 8px; padding-bottom: 3px; color: #FFFFFF; font-family: 'Noto Sans', sans-serif; font-style: normal; font-weight: 600; font-size: 14px;">Keterangan Tambahan</label>
                </div>

                <!-- Card Content 2 -->
                <div class="d-flex align-items-center justify-content-start h-100" style="padding-left: 15px; padding-right: 15px; padding-bottom: 10px; padding-top: 5px; border-radius: 0 0 10px 10px; background: var(--surface-light-active, #FAFAFA); box-shadow: 0px 12px 16px -8px rgba(0, 0, 0, 0.16);">
                    <div class="text-left" style="margin-top: 5px;">
                        <p style="margin: 0; white-space: pre-line;">{{ $report->keterangan }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- First Card for Image 1 -->
    <!-- Card Group for Images - Display Horizontally -->
    <div class="card-group-container" style="margin-top: 15px; display: flex;">

        @if (!empty($report->upload_foto) && is_array($report->upload_foto))
            @foreach ($report->upload_foto as $index => $imagePath)
                <!-- Card for Image {{ $index + 1 }} -->
                <div style="margin-right: 15px;">
                    <div class="card-container" style="width: 235px;">

                        <!-- Card Content -->
                        <div class="d-flex flex-column h-100" style="padding-left: 15px; padding-right: 15px; padding-bottom: 10px; padding-top: 5px; border-radius: 10px; background: var(--surface-light-active, #FAFAFA); box-shadow: 0px 12px 16px -8px rgba(0, 0, 0, 0.16);">

                            <!-- Image -->
                            <div class="text-left" style="margin-top: 5px;">
                                <img src="{{ asset('assets/files/upload_foto/' . $imagePath) }}" alt="Image {{ $index + 1 }}" style="max-width: 205px; margin-top: 10px; margin-bottom: 10px;">
                            </div>

                            <!-- Timestamp and Buttons -->
                            <div class="d-flex justify-content-between mt-auto">
                                <div>
                                    <p class="text-muted small mb-0">Ditambahkan pada {{ \Carbon\Carbon::createFromTimeStamp(strtotime($report->created_at))->diffForHumans() }}</p>
                                    <!-- Buttons -->
                                    <div style="margin-left: -5px; margin-bottom: 10px;">
                                        <a href="{{ asset('assets/files/upload_foto/' . $imagePath) }}" target="_blank" class="btn btn-success btn-sm mt-2" style="margin-left: 5px; border-radius: 5px; border: none; background: linear-gradient(180deg, #BF8600 0%, #FEB300 100%); box-shadow: 0px -2px 8px 0px rgba(0, 0, 0, 0.10) inset, 0px 4px 4px 0px rgba(0, 0, 0, 0.25); color: #FFF; font-size: 12px; /* Adjust the font size as needed */ text-decoration: none; /* Remove the default underline */ padding: 5px 12px; /* Adjust the padding as needed */ transition: background-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;">
                                            Preview
                                        </a>
                                        <a href="{{ asset('assets/files/upload_foto/' . $imagePath) }}" download class="btn btn-primary btn-sm mt-2" style="margin-left: 5px; border-radius: 5px; border: none; background: linear-gradient(180deg, #06693E 0%, #50A245 100%); box-shadow: 0px -2px 8px 0px rgba(0, 0, 0, 0.10) inset, 0px 4px 4px 0px rgba(0, 0, 0, 0.25); color: #FFF; font-size: 12px; /* Adjust the font size as needed */ text-decoration: none; /* Remove the default underline */ padding: 5px 12px; /* Adjust the padding as needed */ transition: background-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;">Download</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p></p>
        @endif
    </div>
</div>

            </div>
        </div>
    </div>
</div>

    </div>
</div>
