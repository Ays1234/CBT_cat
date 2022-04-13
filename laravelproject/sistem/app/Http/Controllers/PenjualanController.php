<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Penjualan;
use PDF;
use DB;

class PenjualanController extends Controller
{
    public function index()
    {
    	$data = Penjualan::all();
    	return view('penjualan',compact('data'));
    }

    public function serverside()
    {
    	return view('penjualan-serverside');
    }

    public function json()
    {
    	return Datatables::of(Penjualan::limit(10))->make(true);
    }

    public function downloadpdf()
    {
        $data = Penjualan::limit(20)->get();
        $pdf = PDF::loadView('penjualan-pdf',compact('data'));
        $pdf->setPaper('A4', 'potrait'); 
        return $pdf->stream('penjualan.pdf');
    }

    public function grafik()
    {
        $total_harga = Penjualan::select(DB::raw("CAST(SUM(total_harga) as int) as total_harga"))
        ->GroupBy(DB::raw("Month(created_at)"))
        ->pluck('total_harga');

        $bulan = Penjualan::select(DB::raw("MONTHNAME(created_at) as bulan"))
        ->GroupBy(DB::raw("MONTHNAME(created_at)"))
        ->pluck('bulan');

        return view('penjualan-grafik', compact('total_harga','bulan'));
    }
}
