<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Noto Sans'>

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

<div id="modal-form-delete-report-{{ $report->id }}" class="modal fade" tabindex="-1" aria-labelledby="modal-form-delete-report-{{ $report->id }}-label" aria-hidden="true" style="display: none; margin-top: 175px;">
    <div class="modal-dialog" style="max-width: 400px; align-items: center; text-align: center; flex-shrink: 0; border-radius: 20px; border: 10px solid rgba(255, 255, 255, 0); background: var(--surface-normal, #EFEFEF); box-shadow: 0px 25px 40px 0px rgba(0, 0, 0, 0.10);">
        <div class="modal-content" style="border-radius: 10px;">

            <div class="modal-body">
                <div class="form-row" style="margin-top: 5px; margin-bottom: 10px;">
                    <div>
                        <img src="{{ asset('assets/images/warning.png') }}" alt="Above Card Image" style="align-items: center; text-align: center; margin-left: 10px;"/>
                        <p style="margin-left: 10px; color: var(--gray-900, #101828); font-family: Noto Sans; font-size: 18px; font-style: normal; font-weight: 600; white-space: pre-line; align-items: center; text-align: center; margin-top: 10px;">Hapus Equipment & Program Kerja</p>
                        <p style="margin-left: 10px; margin-top: -10px; color: var(--gray-500, #667085); font-family: Noto Sans; font-size: 14px; font-style: normal; font-weight: 400; white-space: pre-line; align-items: center; text-align: center;">Apakah anda yakin akan menghapus equipment ini beserta detail lainnya?</p>
                        <form action="{{ route('report.destroy', $report->id) }}" method="post" id="modal-form-delete-report-{{ $report->id }}" style="align-items: center; text-align: center; margin-left: 10px;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" style="margin-right: 5px; border-radius: 5px; border: none; background: linear-gradient(183deg, #BF8600 -18.4%, #FEB300 97.53%); box-shadow: 0px -2px 8px 0px rgba(0, 0, 0, 0.10) inset, 0px 4px 4px 0px rgba(0, 0, 0, 0.25); color: #FFF; font-size: 14px; /* Adjust the font size as needed */ text-decoration: none; /* Remove the default underline */ padding: 8px 15px; /* Adjust the padding as needed */ transition: background-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;">Batalkan</button>
                            <button type="submit" class="btn btn-primary" style="border-radius: 5px; border: none; background: linear-gradient(180deg, #06693E 0%, #50A245 100%); box-shadow: 0px -2px 8px 0px rgba(0, 0, 0, 0.10) inset, 0px 4px 4px 0px rgba(0, 0, 0, 0.25); color: #FFF; font-size: 14px; /* Adjust the font size as needed */ text-decoration: none; /* Remove the default underline */ padding: 8px 15px; /* Adjust the padding as needed */ transition: background-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;">Delete</button>
                        </form>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>