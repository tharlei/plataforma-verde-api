<?php

namespace App\Jobs;

use App\Modules\Residue\UseCases\CreateResidueInput;
use App\Modules\Residue\UseCases\InsertManyResidues;
use App\Utils\SpreadsheetUtil;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class InsertResiduesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        private readonly string $storagePath,
    ) {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(SpreadsheetUtil $spreadsheetUtil, InsertManyResidues $insertManyResidues)
    {
        try {
            $spreadsheetItems = $spreadsheetUtil->mapToCollection($this->storagePath);

            $input = $spreadsheetItems->map(fn ($item) => new CreateResidueInput(
                $item->nome_comum_do_residuo,
                $item->tipo_de_residuo,
                $item->categoria,
                $item->tecnologia_de_tratamento,
                $item->classe,
                $item->unidade_de_medida,
                $item->peso
            ))->toArray();

            $insertManyResidues->handle($input);

            Storage::delete($this->storagePath);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }
    }
}
