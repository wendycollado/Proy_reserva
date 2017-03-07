<?php


class Resultado {
        private $id;
	private $tiro;
	private $defensivo;
	private $ofensivo;
	private $libres;
        private $faltas;
        private $controlB;
        private $jugador;
        private $estadistica;

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}