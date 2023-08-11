<?php

namespace Modules\Report\app\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Modules\Notivication\app\Models\Notivication;
use Modules\Report\app\Interfaces\ReportInterface;
use Modules\Report\app\Models\Report;
use Illuminate\Support\Str;
use App\Models\ActivityLog;

class ReportRepository implements ReportInterface
{
    
    /**
     * getCount
     */
    public function getCount()
    {
        return auth()->user()->hasRole('User')
            ? $this->getUserCount()
            : $this->getAllCount();
    }

    protected function getUserCount()
    {
        return Report::query()
            ->whereBelongsTo(auth()->user())
            ->count();
    }

    protected function getAllCount()
    {
        return Report::count();
    }

    /**
     * getAll
     */
    public function getAll(int $paginate = 10): LengthAwarePaginator
    {
        return $this->getListForAdmin($paginate);
    }

    public function getNoPaginate()
    {
        return Report::all();
    }

    protected function getListForAdmin(int $paginate = 10): LengthAwarePaginator
    {
        return Report::query()
            ->when(request()->search, function ($query, $search) {
                return $query->where('nama', 'like', '%'.$search.'%');
            })
            ->with('user', 'has_drafter')
            ->latest()
            ->paginate($paginate);
    }
    
    /**
     * store
     */
    public function store(Request $request): bool|Report
    {
        try {
            $upload_foto = $this->storeAttach($request, 'upload_foto');
            $upload_document = $this->storeAttach($request, 'upload_document');

            $report = Report::create(
                $this->mergeRequest($request, $upload_foto, $upload_document)
            );

            // Ensure the report was created successfully
            if (!$report) {
                return false;
            }

            // If the report was created, create the activity log
            ActivityLog::create([
                'user_id' => auth()->user()->id,
                'activity' => 'Create',
                'changed_data' => 'Equipment ' . $report->equipment,
            ]);

            // If everything succeeded, return the created report instance
            return $report;
        } catch (Exception $e) {
            // Handle any exceptions that might occur during the process
            // You can log the error or take any necessary actions
            return false;
        }
    }

    protected function mergeRequest(Request $request, array $upload_foto, array $upload_document)
    {
        return array_merge(
            $request->validated(),
            [
                'tgl' => now(),
                'upload_foto' => $upload_foto,
                'upload_document' => $upload_document,
                'user_id' => auth()->id(),
            ]
        );
    }

    protected function storeAttach(Request $request, string $inputFieldName): array
    {
        $filePaths = [];

        // Check if the request has files for the given input field
        if ($request->hasFile($inputFieldName)) {
            $files = $request->file($inputFieldName);

            foreach ($files as $file) {
                $fileName = Str::uuid()->toString() . '.' . $file->extension();

                $file->move(public_path('assets/files/' . $inputFieldName . '/'), $fileName);

                $filePaths[] = $fileName;
            }
        }

        return $filePaths;
    }

    /**
     * update
     */
    public function update(Request $request, Report $report)
    {
        if ($request->_c2VuZGVy === 'VXNlcg==') {
            return $this->updateUser($request, $report);
        }

        if ($request->_c2VuZGVy === 'U3VwZXIgQWRtaW4=') {
            return $this->updateSuperAdmin($request, $report);
        }

        return false;
    }

    protected function updateUser(Request $request, Report $report)
{
    try {
        $validated = $this->validateUser($request);

        $upload_foto = $this->storeAttach($request, 'upload_foto');
        $upload_document = $this->storeAttach($request, 'upload_document');

        // If upload is not provided in the request, keep the existing values
        if (empty($upload_foto)) {
            $upload_foto = $report->upload_foto;
        }

        if (empty($upload_document)) {
            $upload_document = $report->upload_document;
        }

        $columnTitles = [
            'tanggal_mulai' => 'Tanggal Mulai',
            'show_status' => 'Show Status',
            'unit' => 'Unit Kerja',
            'equipment' => 'Equipment',
            'program_kerja' => 'Program Kerja',
            'keterangan_pekerjaan' => 'Keterangan Pekerjaan',
            'status_pekerjaan' => 'Status Pekerjaan',
            'progress' => 'Progress',
            'target' => 'Target',
            'wo_number' => 'Nomor WO',
            'keterangan' => 'Keterangan',
            'scope_1' => 'Scope 1',
            'scope_2' => 'Scope 2',
            'pic' => 'PIC',
            'prioritas' => 'Prioritas',
            'upload_foto' => 'Foto',
            'upload_document' => 'Dokumen',
        ];

        $updatedColumns = [];
        foreach ($validated as $column => $value) {
            if ($report->$column != $value) {
                $updatedColumns[] = $columnTitles[$column] . ' menjadi ' . $value;
            }
        }

        // Update the report
        $reportUpdated = $report->update(
            array_merge(
                $validated,
                [
                    'upload_foto' => $upload_foto,
                    'upload_document' => $upload_document,
                ]
            )
        );

        // Ensure the report was updated successfully
        if (!$reportUpdated) {
            return false;
        }

        // If the report was updated, create the activity log
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity' => 'Update',
            'changed_data' => 'Pada Equipment ' . $report->equipment . ', Mengubah ' . implode(', ', $updatedColumns),
        ]);

        // If everything succeeded, return the updated report instance
        return $report;
    } catch (Exception $e) {
        // Handle any exceptions that might occur during the process
        // You can log the error or take any necessary actions
        return false;
    }
}


    protected function updateSuperAdmin(Request $request, Report $report)
    {
        $validated = $this->validateSuperAdmin($request);

        return $report->update(
            $validated
        );
    }

    protected function validateUser(Request $request)
    {
        return $request->validate([
            'tanggal_input'         => ['nullable', 'string'],
            'tanggal_mulai'         => ['nullable', 'string'],
            'show_status'           => ['nullable', 'string'],
            'unit'                  => ['nullable', 'string'],
            'equipment'             => ['nullable', 'string'],
            'program_kerja'         => ['nullable', 'string'],
            'keterangan_pekerjaan'  => ['nullable', 'string'],
            'status_pekerjaan'      => ['nullable', 'string'],
            'progress'              => ['nullable', 'string'],
            'target'                => ['nullable', 'string'],
            'wo_number'             => ['nullable', 'string'],
            'keterangan'            => ['nullable', 'string'],
            'scope_1'               => ['nullable', 'string'],
            'scope_2'               => ['nullable', 'string'],
            'pic'                   => ['nullable', 'string'],
            'prioritas'             => ['nullable', 'string'],
            'upload_foto.*'         => ['nullable', 'file'],
            'upload_document.*'     => ['nullable', 'file'],
        ]);
    }

    protected function validateSuperAdmin(Request $request)
    {
        return $request->validate([
            'tanggal_input'          => ['nullable', 'string'],
            'tanggal_mulai'          => ['nullable', 'string'],
            'show_status'           => ['nullable', 'string'],
            'unit'                  => ['nullable', 'string'],
            'equipment'             => ['nullable', 'string'],
            'program_kerja'         => ['nullable', 'string'],
            'keterangan_pekerjaan'  => ['nullable', 'string'],
            'status_pekerjaan'      => ['nullable', 'string'],
            'progress'              => ['nullable', 'string'],
            'target'                => ['nullable', 'string'],
            'wo_number'             => ['nullable', 'string'],
            'keterangan'            => ['nullable', 'string'],
            'scope_1'               => ['nullable', 'string'],
            'scope_2'               => ['nullable', 'string'],
            'pic'                   => ['nullable', 'string'],
            'prioritas'             => ['nullable', 'string'],
            'upload_foto.*'         => ['nullable', 'file'],
            'upload_document.*'     => ['nullable', 'file'],
        ]);
    }

    public function getFilteredReports($selectedUnit, $selectedShowStatus, $selectedPrioritas, $selectedStatusPekerjaan)
    {
        $query = Report::query();

        if ($selectedUnit) {
            $query->where('unit', $selectedUnit);
        }

        if ($selectedShowStatus) {
            $query->where('show_status', $selectedShowStatus);
        }

        if ($selectedPrioritas) {
            $query->where('prioritas', $selectedPrioritas);
        }

        if ($selectedStatusPekerjaan) {
            $query->where('status_pekerjaan', $selectedStatusPekerjaan);
        }

        $filteredReports = $query->get();

        // Build and return the HTML table rows
        $html = '';
        foreach ($filteredReports as $report) {
            // Build table row HTML for each report
            $html .= '<tr>';
            // ... Fill in the columns' data here
            $html .= '</tr>';
        }

        return $html;
    }

    public function getFilteredReportsForAlternateView()
    {
        return Report::where('show_status', 'Show')
            ->latest()
            ->get();
    }

}
