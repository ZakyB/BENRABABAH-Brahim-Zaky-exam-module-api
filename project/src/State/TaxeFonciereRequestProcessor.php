<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Services\TaxeFonciereService;

class TaxeFonciereRequestProcessor implements ProcessorInterface
{
    private TaxeFonciereService $taxeFonciereService;

    public function __construct(TaxeFonciereService $taxeFonciereService)
    {
        $this->taxeFonciereService = $taxeFonciereService;
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): mixed
    {
        $data->montantTaxeFonciere = $this->taxeFonciereService->estimer($data->surfaceHabitable, $data->prixM2);

        return $data;
    }
}