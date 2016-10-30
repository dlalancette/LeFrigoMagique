<?php

/**
 * recette short summary.
 *
 * recette description.
 *
 * @version 1.0
 * @author PPears_PC
 */
class recette
{
    public $id;
    public $nom;
    public $description;
    public $etapes;
    public $ingredients;

    public function recette($Id, $Nom, $Desc, $Etapes, $Ingre)
    {
        $this->id = $Id;
        $this->nom = $Nom;
        $this->description = $Desc;
        $this->etapes = $Etapes;
        $this->ingredients = $Ingre;
    }
}