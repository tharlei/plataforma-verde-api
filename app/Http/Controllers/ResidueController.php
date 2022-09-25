<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResidueRequest;
use App\Http\Requests\UpdateResidueRequest;
use App\Jobs\InsertResiduesJob;
use App\Modules\Residue\UseCases\ResidueInput;
use App\Modules\Residue\UseCases\UpdateResidue;
use Exception;
use RuntimeException;

class ResidueController extends Controller
{
    public function __construct(
        private readonly UpdateResidue $updateResidue
    ) {
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

    public function update(UpdateResidueRequest $request, $id)
    {
        $input = new ResidueInput(
            $request->name,
            $request->type,
            $request->category,
            $request->technology,
            $request->class,
            $request->unit_measurement,
            $request->weight,
        );

        try {
            $this->updateResidue->handle($id, $input);
        } catch (Exception $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], $exception->getCode() ?? 400);
        }

        return response()->json([
            'message' => 'Resíduo atualizado'
        ], 200);
    }

    public function destroy($id)
    {
        //
    }
}
