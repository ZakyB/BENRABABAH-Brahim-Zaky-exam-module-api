<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\ApiResource\TaxeOrduresMenageresRequest;
use App\Services\TaxeOrduresMenageresService;

class TaxeOrduresMenageresRequestProcessor implements ProcessorInterface
{
    private TaxeOrduresMenageresService $taxeOrduresMenageresService;

    public function __construct(TaxeOrduresMenageresService $taxeOrduresMenageresService)
    {
        $this->taxeOrduresMenageresService = $taxeOrduresMenageresService;
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): mixed
    {
        $data->montantTaxeOrduresMenageres = $this->taxeOrduresMenageresService->estimer($data->valeurLocativeCadastrale);

        return $data;
    }
}