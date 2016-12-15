<?php

class ResultadoModel {
    private $pdo;

    function __construct() {
        try {
            $this->pdo = new PDO('mysql:host=localhost; dbname=estadisticas','root', '');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $exc) {
            die($exc->getMessage());
        }
    }


    public function Listar() {
        try {
            $result = array();

            $stm = $this->pdo->prepare("SELECT * FROM resultado");
            $stm->execute();

            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $alm = new Resultado();

                $alm->__SET('id', $r->id);
                $alm->__SET('tiro', $r->tiro);
                $alm->__SET('defensivo', $r->defensivo);
                $alm->__SET('ofensivo', $r->ofensivo);
                $alm->__SET('libres', $r->libres);
                $alm->__SET('faltas', $r->faltas);
                $alm->__SET('controlB', $r->controlB);
                $alm->__SET('jugador', $r->jugador);
                $alm->__SET('partido', $r->partido);
                $alm->__SET('estadistica', $r->estadistica);

                $result[] = $alm;
            }

            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
}
