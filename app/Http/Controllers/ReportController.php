<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use PDF;
use App\Models\Box;
use App\Models\Report;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (session('role_id') == 2) {
            return redirect('/');
        }

        $data = [
            "title" => "Reports",
            "reports" => Report::all()->unique('bulan'),
        ];
        return view('pages.reports.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReportRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReportRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        if (session('role_id') == 2) {
            return redirect('/');
        }
        $totalBarang = 0;
        $totalHarga = 0;
        foreach ($report->box as $box) {
            $totalBarang += count($box->item);

            $totalHarga += $box->subtotal;
        }

        $data = [
            "title" => "Detail Report",
            "report" => $report,
            "totalBarang" => $totalBarang,
            "totalHarga" => $totalHarga,
        ];
        return view('pages.reports.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReportRequest  $request
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReportRequest $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        if (session('role_id') == 2) {
            return redirect('/');
        }
        Report::destroy('id', $report->id);
        return redirect("/reports")->with('success', 'Laporan Berhasil Dihapus');
    }

    public function generatePDF(Report $report)
    {
        if (session('role_id') == 2) {
            return redirect('/');
        }
        $totalBarang = 0;
        $totalHarga = 0;
        foreach ($report->box as $box) {
            $totalBarang += count($box->item);

            $totalHarga += $box->subtotal;
        }

        $data = [
            "title" => "Detail Report",
            "report" => $report,
            "totalBarang" => $totalBarang,
            "totalHarga" => $totalHarga,
        ];
        return view('pages.reports.report-pdf', $data);
    }
}
