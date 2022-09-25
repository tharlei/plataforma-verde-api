<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResidueRequest;
use App\Http\Requests\UpdateResidueRequest;
use App\Jobs\InsertResiduesJob;
use App\Modules\Residue\Queries\ListResiduesQuery;
use App\Modules\Residue\UseCases\DeleteResidue;
use App\Modules\Residue\UseCases\ResidueInput;
use App\Modules\Residue\UseCases\UpdateResidue;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ResidueController extends Controller
{
    public function __construct(
        private readonly UpdateResidue $updateResidue,
        private readonly DeleteResidue $deleteResidue,
        private readonly ListResiduesQuery $listResiduesQuery
    ) {
    }

    public function index(Request $request)
    {
        $residues = $this->listResiduesQuery->handle(
            $request->get('page', 1),
            $request->get('limit', 15),
        );

        return response()->json($residues);
    }

    public function store(StoreResidueRequest $request)
    {
        $storagePath = $request->file('spreadsheet')->store('spreadsheets');

        InsertResiduesJob::dispatch($storagePath);
        Log::notice('Tarefa de inserção de dados da planilha de Resíduo iniciada', [$storagePath]);

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
            Log::error($exception->getMessage(), [
                'exception' => $exception
            ]);

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
        try {
            $this->deleteResidue->handle($id);
        } catch (Exception $exception) {
            Log::error($exception->getMessage(), [
                'exception' => $exception
            ]);

            return response()->json([
                'message' => $exception->getMessage()
            ], $exception->getCode() ?? 400);
        }

        return response()->json([
            'message' => 'Resíduo excluído'
        ], 200);
    }
}
