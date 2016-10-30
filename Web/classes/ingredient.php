<?php

/**
 * ingredient short summary.
 *
 * ingredient description.
 *
 * @version 1.0
 * @author PPears_PC
 */
class ingredient
{
    private $_Id;
    private $_Nom;
    private $_nbJoursRefrigeration;
    private $_nbJoursCongelation;
    private $_Quantite;

    public function Id()
    {
        return $this->_Id;
    }

    public function Nom()
    {
        return $this->_Nom;
    }

    public function nbJoursRefrigeration()
    {
        return $this->_nbJoursRefrigeration;
    }

    public function nbJoursCongelation()
    {
        return $this->_nbJoursCongelation;
    }

    public function Quantite()
    {
        return $this->_Quantite;
    }

    public function ingredient($Id, $Nom, $nbJRefrig, $nbJCong, $Qte)
    {
        $this->_Id = $Id;
        $this->_Nom = $Nom;
        $this->_nbJoursRefrigeration = $nbJRefrig;
        $this->_nbJoursCongelation = $nbJCong;
        $this->_Quantite = $Qte;
    }
}