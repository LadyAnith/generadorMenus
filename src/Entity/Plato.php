<?php

namespace App\Entity;

use App\Repository\PlatoRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

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
     * @ORM\ManyToOne(targetEntity="TipoPlato")
     * @ORM\JoinColumn(name="tipo", referencedColumnName="id")
     */
    private $tipo;

     /**
      * @var Collection
     * @ORM\ManyToMany(targetEntity="Alergenos")
     */
    private $listaAlergenos;

    public function __construct()
    {
        $this->listaAlergenos = new ArrayCollection();
    }

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

    public function getTipo(): ?TipoPlato
    {
        return $this->tipo;
    }

    public function setTipo(TipoPlato $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }


    //Métodos Especiales para no eliminar todos los registros que estén relacionados

    public function addListaAlergenos(Alergenos $listaAlergenos): self
   {
       $this->listaAlergenos[] = $listaAlergenos;
       return $this;
   }
 
   public function removeAlergenos(Alergenos $listaAlergenos): bool
   {
       return $this->listaAlergenos->removeElement($listaAlergenos);
   }
 
    //-----------------------------------------------------------------------
    public function getListaAlergenos(): Collection
    {
        return $this->listaAlergenos;
    }

    public function setListaAlergenos(Collection $listaAlergenos): self
    {
        $this->listaAlergenos = $listaAlergenos;

        return $this;
    }
}
