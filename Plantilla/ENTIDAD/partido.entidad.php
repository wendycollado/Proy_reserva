<?php
require '../ENTIDAD/equipo.entidad.php';
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
class Partido {
    private $id;
    private $fecha;
    private $hora;
    private $resultadoA;
    private $resultadoB;
    private $equipoA;
    private $equipoB;
    private $campeonato;
   
           
    public function __GET($k){ return $this->$k; }
    public function __SET($k, $v){ return $this->$k = $v; }
}
