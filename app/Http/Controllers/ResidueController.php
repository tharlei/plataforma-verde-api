<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResidueRequest;
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

    public function store(StoreResidueRequest $request)
    {
        $storagePath = $request->file('spreadsheet')->store('spreadsheets');

        InsertResiduesJob::dispatch($storagePath);

        return response()->json([
            'message' => 'Planilha logo será processada'
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
