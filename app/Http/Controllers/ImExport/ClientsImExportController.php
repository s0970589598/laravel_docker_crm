<?php

namespace App\Http\Controllers\ImExport;

use App\Http\Controllers\Controller;
use App\Models\ClientsModel;
use App\Exports\ClientsExport;
use App\Imports\ClientsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ClientsImExportController extends Controller
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
        $clients = ClientsModel::all();

        return view('crm.client.clients')->with('clients', $clients);
    }

    /**
     * Import function
     */
    public function import(Request $request)
    {
        if ($request->file('imported_file')) {
            Excel::import(new ClientsImport(), request()->file('imported_file'));
            return back();
        }
    }


    /**
     * Export function
     */
    public function export()
    {
        return Excel::download(new ClientsExport(), 'books.xlsx');
    }

}
