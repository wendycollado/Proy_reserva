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
class Inscripcion {
    private $id;
    private $campeonato;
    private $equipo;
    private $fecha;
    
    public function __GET($k){ return $this->$k; }
    public function __SET($k, $v){ return $this->$k = $v; }
}
