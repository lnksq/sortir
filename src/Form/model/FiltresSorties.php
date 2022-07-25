<?php

namespace App\Form\model;

use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Component\Form\AbstractType;

class FiltresSorties extends AbstractType
{
    private ?string $campus;
    private ?string $motRecherche;
    private ?\DateTimeInterface $premiereDate;
    private ?\DateTimeInterface $derniereDate;
    private ?Boolean $organisateur;
    private ?Boolean $inscrit;
    private ?Boolean $pasInscrit;
    private ?Boolean $sortiesPassees;

    /**
     * @return string|null
     */
    public function getCampus(): ?string
    {
        return $this->campus;
    }

    /**
     * @return string|null
     */
    public function getMotRecherche(): ?string
    {
        return $this->motRecherche;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getPremiereDate(): ?\DateTimeInterface
    {
        return $this->premiereDate;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDerniereDate(): ?\DateTimeInterface
    {
        return $this->derniereDate;
    }

    /**
     * @return bool|null
     */
    public function getOrganisateur(): ?bool
    {
        return $this->organisateur;
    }

    /**
     * @return bool|null
     */
    public function getInscrit(): ?bool
    {
        return $this->inscrit;
    }

    /**
     * @return bool|null
     */
    public function getPasInscrit(): ?bool
    {
        return $this->pasInscrit;
    }

    /**
     * @return bool|null
     */
    public function getSortiesPassees(): ?bool
    {
        return $this->sortiesPassees;
    }






}