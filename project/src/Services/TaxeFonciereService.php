<?php

namespace App\Services;

class TaxeFonciereService
{
    private const TAUX_TAXE_FONCIERE = 0.005;

    public function estimer(int $surfaceHabitable, float $prixM2): float
    {
        $valeurCadastrale = $surfaceHabitable * $prixM2;
        $montantTaxeFonciere = $valeurCadastrale * self::TAUX_TAXE_FONCIERE;

        return $montantTaxeFonciere;
    }
}