<?php
namespace App\Controller;

use App\ApiResource\TaxeFonciereRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TaxeFonciereRequestAction extends AbstractController
{
    public function __invoke(TaxeFonciereRequest $data): TaxeFonciereRequest
    {
        return $data;
    }
}
