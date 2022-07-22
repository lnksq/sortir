<?php

namespace App\Form\model;

use phpDocumentor\Reflection\Types\Boolean;

class filtresSorties
{
    private ?string $campus;
    private ?string $motRecherche;
    private ?\DateTimeInterface $premiereDate;
    private ?\DateTimeInterface $derniereData;
    private ?Boolean $organisateur;
    private ?Boolean $inscrit;
    private ?Boolean $pasInscrit;
    private ?\DateTimeInterface $sortiePassees;

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
    public function getDerniereData(): ?\DateTimeInterface
    {
        return $this->derniereData;
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
     * @return \DateTimeInterface|null
     */
    public function getSortiePassees(): ?\DateTimeInterface
    {
        return $this->sortiePassees;
    }






}