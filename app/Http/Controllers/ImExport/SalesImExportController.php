<?php

namespace App\Http\Controllers\ImExport;

use App\Http\Controllers\Controller;
use App\Models\SalesModel;
use App\Exports\SalesExport;
use App\Imports\SalesImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SalesImExportController extends Controller
{
    public function __construct()
    {
        set_time_limit(0);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Sales = SalesModel::all();

        return view('crm.sales.index')->with('Sales', $Sales);
    }

    /**
     * Import function
     */
    public function import(Request $request)
    {
        if ($request->file('imported_file')) {
            Excel::import(new SalesImport(), request()->file('imported_file'));
            return back();
        }
    }


    /**
     * Export function
     */
    public function export()
    {
        return Excel::download(new SalesExport(), 'books.xlsx');
    }

}
