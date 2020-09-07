<?php

namespace App\Entity;

use App\Repository\PlatoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlatoRepository::class)
 */
class Plato
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nombre;

    /**
     * @ORM\Column(type="float")
     */
    private $calorias;

    /**
     * @ORM\Column(type="integer")
     */
    private $tipo;

    /**
     * @ORM\Column(type="integer")
     */
    private $idTipoPlato;

     /**
      * @var Collection
     * @ManyToMany(targetEntity="Alergenos")
     */
    private $listaAlergenos;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getCalorias(): ?float
    {
        return $this->calorias;
    }

    public function setCalorias(float $calorias): self
    {
        $this->calorias = $calorias;

        return $this;
    }

    public function getTipo(): ?int
    {
        return $this->tipo;
    }

    public function setTipo(int $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getIdTipoPlato(): ?int
    {
        return $this->idTipoPlato;
    }

    public function setIdTipoPlato(int $idTipoPlato): self
    {
        $this->idTipoPlato = $idTipoPlato;

        return $this;
    }
}
