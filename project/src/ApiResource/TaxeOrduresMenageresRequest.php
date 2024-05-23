<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use ApiPlatform\OpenApi\Model;
use App\State\TaxeOrduresMenageresRequestProcessor;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    operations: [
        new Post(
            uriTemplate: "/estimer/taxe_ordures_menageres",
            openapi: new Model\Operation(
                summary: 'Estimer la taxe d\'enlèvement des ordures ménagères',
                description: 'Cette opération permet d\'estimer le montant de la taxe d\'enlèvement des ordures ménagères',
            ),
            normalizationContext: ['groups' => ['taxe_ordures_menageres_request:read']],
            denormalizationContext: ['groups' => ['taxe_ordures_menageres_request:write']],
            input: TaxeOrduresMenageresRequest::class,
            output: TaxeOrduresMenageresRequest::class,
            processor: TaxeOrduresMenageresRequestProcessor::class
        )
    ]
)]
class TaxeOrduresMenageresRequest
{
    #[ApiProperty(
        openapiContext: [
            'type' => 'number'
        ]
    )]
    #[Groups(['taxe_ordures_menageres_request:write'])]
    #[Assert\NotBlank()]
    #[Assert\Type(type: 'float')]
    public float $valeurLocativeCadastrale;

    #[ApiProperty(
        openapiContext: [
            'type' => 'number'
        ]
    )]
    #[Groups(['taxe_ordures_menageres_request:read'])]
    public float $montantTaxeOrduresMenageres;
}