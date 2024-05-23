<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use ApiPlatform\OpenApi\Model;
use App\State\TaxeFonciereRequestProcessor;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    operations: [
        new Post(
            uriTemplate: "/estimer/taxe_fonciere",
            openapi: new Model\Operation(
                summary: 'Estimer la taxe foncière',
                description: 'Cette opération permet d\'estimer le montant de la taxe foncière',
            ),
            normalizationContext: ['groups' => ['taxe_fonciere_request:read']],
            denormalizationContext: ['groups' => ['taxe_fonciere_request:write']],
            input: TaxeFonciereRequest::class,
            output: TaxeFonciereRequest::class,
            processor: TaxeFonciereRequestProcessor::class
        )
    ]
)]
class TaxeFonciereRequest
{
    #[ApiProperty(
        openapiContext: [
            'type' => 'integer'
        ]
    )]
    #[Groups(['taxe_fonciere_request:write'])]
    #[Assert\NotBlank()]
    #[Assert\Type(type: 'integer')]
    public int $surfaceHabitable;

    #[ApiProperty(
        openapiContext: [
            'type' => 'number'
        ]
    )]
    #[Groups(['taxe_fonciere_request:write'])]
    #[Assert\NotBlank()]
    #[Assert\Type(type: 'float')]
    public float $prixM2;

    #[ApiProperty(
        openapiContext: [
            'type' => 'number'
        ]
    )]
    #[Groups(['taxe_fonciere_request:read'])]
    public float $montantTaxeFonciere;
}