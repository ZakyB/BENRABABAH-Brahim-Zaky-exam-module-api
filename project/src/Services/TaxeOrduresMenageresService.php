<?php

namespace App\Services;

class TaxeOrduresMenageresService
{
    private const TAUX_TAXE_ORDURES_MENAGERES = 0.0937;

    public function estimer(float $valeurLocativeCadastrale): float
    {
        $montantTaxeOrduresMenageres = ($valeurLocativeCadastrale / 2) * self::TAUX_TAXE_ORDURES_MENAGERES;

        return $montantTaxeOrduresMenageres;
    }
}