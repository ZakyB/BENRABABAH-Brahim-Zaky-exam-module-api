<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use App\Repository\MairieRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: MairieRepository::class)]
#[ApiResource(
    operations:[
        new Get(
            normalizationContext: ['groups' => ['mairie:read']],
        ),
        new GetCollection(
            normalizationContext: ['groups' => ['mairie:read:collection']],
        ),
        new Post(
            denormalizationContext: ['groups' => ['mairie:write']],
            security: "is_authenticated()"
        ),
        new Delete(
            security: "is_authenticated()"
        )
    ]
)]
#[ApiFilter(SearchFilter::class, properties: ["departement.region" => "exact", "departement" => "exact", "codePostal" => "exact", "ville" => "partial"])]
#[ApiFilter(OrderFilter::class, properties: ["label", "codePostal"], arguments: ["orderParameterName" => "order"])]
class Mairie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['mairie:read', 'mairie:read:collection'])]
    private ?int $id = null;

    #[ORM\Column(length: 6)]
    #[Groups(['mairie:read', 'mairie:read:collection', 'mairie:write'])]
    private ?string $codeInsee = null;

    #[ORM\Column(length: 5)]
    #[Groups(['mairie:read', 'mairie:read:collection', 'mairie:write'])]
    private ?string $codePostal = null;

    #[ORM\Column(length: 180)]
    #[Groups(['mairie:read', 'mairie:read:collection', 'mairie:write'])]
    private ?string $label = null;

    #[ORM\Column(length: 255)]
    #[Groups(['mairie:read', 'mairie:write'])]
    private ?string $adresse = null;

    #[ORM\Column(length: 100)]
    #[Groups(['mairie:read', 'mairie:read:collection', 'mairie:write'])]
    private ?string $ville = null;

    #[ORM\Column(length: 255,nullable: true)]
    #[Groups(['mairie:read', 'mairie:write'])]
    private ?string $siteWeb = null;

    #[ORM\Column(length: 25,nullable: true)]
    #[Groups(['mairie:read', 'mairie:write'])]
    private ?string $telephone = null;

    #[ORM\Column(length: 255,nullable: true)]
    #[Groups(['mairie:read', 'mairie:write'])]
    private ?string $email = null;

    #[ORM\Column(length: 20,nullable: true)]
    #[Groups(['mairie:read', 'mairie:read:collection', 'mairie:write'])]
    private ?string $latitude = null;

    #[ORM\Column(length: 20,nullable: true)]
    #[Groups(['mairie:read', 'mairie:read:collection', 'mairie:write'])]
    private ?string $longitude = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['mairie:read'])]
    private ?\DateTimeInterface $dateMaj = null;

    #[ORM\ManyToOne(inversedBy: 'mairies')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['mairie:read', 'mairie:read:collection', 'mairie:write'])]
    private ?Departement $departement = null;
    public function __construct()
    {
        $this->dateMaj = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeInsee(): ?string
    {
        return $this->codeInsee;
    }

    public function setCodeInsee(string $codeInsee): static
    {
        $this->codeInsee = $codeInsee;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(string $codePostal): static
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getSiteWeb(): ?string
    {
        return $this->siteWeb;
    }

    public function setSiteWeb(string $siteWeb): static
    {
        $this->siteWeb = $siteWeb;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(string $latitude): static
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(string $longitude): static
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getDateMaj(): ?\DateTimeInterface
    {
        return $this->dateMaj;
    }

    public function setDateMaj(\DateTimeInterface $dateMaj): static
    {
        $this->dateMaj = $dateMaj;

        return $this;
    }

    public function getDepartement(): ?Departement
    {
        return $this->departement;
    }

    public function setDepartement(?Departement $departement): static
    {
        $this->departement = $departement;

        return $this;
    }
}
