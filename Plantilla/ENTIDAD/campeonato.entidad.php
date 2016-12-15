<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of campeonato
 *
 * @author Tefy
 */
class Campeonato {
    private $id;
    private $nombre;
    private $fechaInicio;
    private $fechaClausura;
    private $anio;
    private $categoria;
    
    public function __GET($k){ return $this->$k; }
    public function __SET($k, $v){ return $this->$k = $v; }
}
