<?php

namespace App\Http\Controllers;

use App\Jobs\InsertResiduesJob;
use Illuminate\Http\Request;

class ResidueController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
    }

    public function store(Request $request)
    {
        $storagePath = $request->file('spreadsheet')->store('spreadsheets');

        InsertResiduesJob::dispatch($storagePath);

        return response()->json([
            'message' => 'Spreadsheet will be processed soon'
        ], 200);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
