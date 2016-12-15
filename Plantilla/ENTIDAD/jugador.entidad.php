<?php

require_once 'equipo.entidad.php';
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
class Jugador {
    private $id;
    private $nombre;
    private $fechanac;
    private $ci;
    private $nrocamiseta;
    private $estado;
    private $fecha;
    private $idEquipo;
    
    
    public function __GET($k){ return $this->$k; }
    public function __SET($k, $v){ return $this->$k = $v; }
}
