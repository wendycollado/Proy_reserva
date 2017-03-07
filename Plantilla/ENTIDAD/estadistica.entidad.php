<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Alumno
 *
 * @author Tefy
 */
class Estadistica {
        private $id;
	private $simple;
        private $tci1;
	private $doble;
        private $tci2;
	private $triple;
        private $tci3;
        private $faltaRecibida;
        private $faltaCometida;
        private $perdidaBalon;
        private $asistencia;
        private $reboteDef;
        private $reboteOfe;
	private $partido;
        private $jugador;

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}
