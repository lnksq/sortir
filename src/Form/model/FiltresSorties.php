<?php

namespace App\Form\model;

use App\Entity\Campus;
use phpDocumentor\Reflection\Types\Boolean;


class FiltresSorties
{
    private  $campus;
    private  $motRecherche;
    private  $premiereDate;
    private  $derniereDate;
    private  $organisateur;
    private  $inscrit;
    private  $pasInscrit;
    private  $sortiesPassees;

    /**
     * @return mixed
     */
    public function getCampus()
    {
        return $this->campus;
    }

    /**
     * @param mixed $campus
     */
    public function setCampus($campus): void
    {
        $this->campus = $campus;
    }

    /**
     * @return mixed
     */
    public function getMotRecherche()
    {
        return $this->motRecherche;
    }

    /**
     * @param mixed $motRecherche
     */
    public function setMotRecherche($motRecherche): void
    {
        $this->motRecherche = $motRecherche;
    }

    /**
     * @return mixed
     */
    public function getPremiereDate()
    {
        return $this->premiereDate;
    }

    /**
     * @param mixed $premiereDate
     */
    public function setPremiereDate($premiereDate): void
    {
        $this->premiereDate = $premiereDate;
    }

    /**
     * @return mixed
     */
    public function getDerniereDate()
    {
        return $this->derniereDate;
    }

    /**
     * @param mixed $derniereDate
     */
    public function setDerniereDate($derniereDate): void
    {
        $this->derniereDate = $derniereDate;
    }

    /**
     * @return mixed
     */
    public function getOrganisateur()
    {
        return $this->organisateur;
    }

    /**
     * @param mixed $organisateur
     */
    public function setOrganisateur($organisateur): void
    {
        $this->organisateur = $organisateur;
    }

    /**
     * @return mixed
     */
    public function getInscrit()
    {
        return $this->inscrit;
    }

    /**
     * @param mixed $inscrit
     */
    public function setInscrit($inscrit): void
    {
        $this->inscrit = $inscrit;
    }

    /**
     * @return mixed
     */
    public function getPasInscrit()
    {
        return $this->pasInscrit;
    }

    /**
     * @param mixed $pasInscrit
     */
    public function setPasInscrit($pasInscrit): void
    {
        $this->pasInscrit = $pasInscrit;
    }

    /**
     * @return mixed
     */
    public function getSortiesPassees()
    {
        return $this->sortiesPassees;
    }

    /**
     * @param mixed $sortiesPassees
     */
    public function setSortiesPassees($sortiesPassees): void
    {
        $this->sortiesPassees = $sortiesPassees;
    }






}