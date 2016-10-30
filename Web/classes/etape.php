<?php

/**
 * etape short summary.
 *
 * etape description.
 *
 * @version 1.0
 * @author PPears_PC
 */
class etape
{
    private $_id;
    private $_no;
    private $_nom;
    private $_description;

    public function Id()
    {
        return $this->_id;
    }

    public function No()
    {
        return $this->_no;
    }

    public function Nom()
    {
        return $this->_nom;
    }

    public function Description()
    {
        return $this->_description;
    }

    public function etape($Id, $No, $Nom, $Desc)
    {
        $this->_id = $Id;
        $this->_no = $No;
        $this->_nom = $Nom;
        $this->_description = $Desc;
    }
}