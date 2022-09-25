<?php

declare(strict_types=1);

namespace App\Modules\Residue;

use App\Repositories\EloquentResidueRepository;
use Illuminate\Support\ServiceProvider;

final class ApplicationServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ResidueRepository::class, EloquentResidueRepository::class);
    }
}
