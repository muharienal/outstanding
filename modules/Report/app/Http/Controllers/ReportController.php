<?php

namespace Modules\Report\app\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Routing\Controller;
use Modules\Report\app\Http\Requests\ReportStoreRequest;
use Modules\Report\app\Http\Requests\UpdateReportRequest;
use Modules\Report\app\Models\Report;
use Modules\Report\app\Repositories\ReportRepository;
use Spatie\Permission\Models\Role;
use Illuminate\Http\JsonResponse;
use App\Models\ActivityLog;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index(
        ReportRepository $reportRepository
    ) {
        $reports = $reportRepository->getAll();
        
        return view(
            'report::index',
            compact('reports')
        );
    }
    public function getChartData(ReportRepository $reportRepository): JsonResponse
    {
        $unitChartData = $reportRepository->getUnitChartData();
        $statusChartData = $reportRepository->getStatusChartData();
        $prioritasChartData = $reportRepository->getPrioritasChartData();

        return response()->json([
            'unitChartData' => $unitChartData,
            'statusChartData' => $statusChartData,
            'prioritasChartData' => $prioritasChartData,
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create()
    {
        return view('report::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Renderable
     */
    public function store(
        ReportStoreRequest $request,
        ReportRepository $reportRepository
    ) {
        return $reportRepository->store($request)
            ? back()->with('success', 'Data berhasil ditambahkan!')
            : back()->with('failed', 'Data tidak berhasil ditambahkan!');
    }

    /**
     * Show the specified resource.
     *
     * @param  int  $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('report::show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('report::edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Renderable
     */
    public function update(
        UpdateReportRequest $request,
        Report $report,
        ReportRepository $reportRepository
    ) {
        return $reportRepository->update($request, $report)
            ? back()->with('success', 'Data berhasil diperbarui!')
            : back()->with('failed', 'Data tidak berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Renderable
     */
    public function destroy(Report $report)
{
    try {
        if ($report->delete()) {
            ActivityLog::create([
                'user_id' => auth()->user()->id,
                'activity' => 'Delete',
                'changed_data' => 'Equipment ' . $report->equipment,
            ]);

            return back()->with('success', 'Data berhasil dihapus!');
        } else {
            return back()->with('failed', 'Data tidak berhasil dihapus!');
        }
    } catch (\Exception $e) {
        // Log the error for debugging
        \Log::error('Error deleting report: ' . $e->getMessage());

        return back()->with('failed', 'Terjadi kesalahan saat menghapus data.');
    }
}


    public function filter(Request $request, ReportRepository $reportRepository)
    {
        $selectedUnit = $request->input('unit');
        $selectedShowStatus = $request->input('show_status'); // Get the selected show status
        $selectedPrioritas = $request->input('prioritas'); // Get the selected prioritas
        $selectedStatusPekerjaan = $request->input('status_pekerjaan'); // Get the selected prioritas
        
        $filteredReports = $reportRepository->getFilteredReports($selectedUnit, $selectedShowStatus, $selectedPrioritas, $selectedStatusPekerjaan);
        
        return view('report::filtered_table_rows', compact('filteredReports'));
    }

    public function indexAlternate(ReportRepository $reportRepository)
    {
        $reports = $reportRepository->getFilteredReportsForAlternateView();

        return view('report::index_alternate', compact('reports'));
    }
    
}