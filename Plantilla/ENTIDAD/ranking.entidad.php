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
class Ranking {
    private $id;
    private $p_ganado;
    private $p_perdido;
    private $pto_contra;
    private $pto_favor;
    private $puntos;
    private $equipo;
    
    public function __GET($k){ return $this->$k; }
    public function __SET($k, $v){ return $this->$k = $v; }
}
