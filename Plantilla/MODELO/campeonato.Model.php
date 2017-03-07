<?php

class CampeonatoModel {

    private $pdo;
function __construct() {
        try {
            $this->pdo = new PDO('mysql:host=localhost; dbname=estadisticas','root', '');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $exc) {
            die($exc->getMessage());
        }
    }


    public function ListarCamp() {
        try {
            $result = array();

            $stm = $this->pdo->prepare("SELECT * FROM campeonato");
            $stm->execute();

            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $camp = new Campeonato();

                $camp->__SET('id', $r->id);
                $camp->__SET('nombre', $r->nombre);
                $camp->__SET('fechaInicio', $r->fechaInicio);
                $camp->__SET('fechaClausura', $r->fechaClausura);
                $camp->__SET('anio', $r->anio);
                $camp->__SET('categoria', $r->categoria);

                $result[] = $camp;
            }

            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ObtenerCamp($id) {
        try {
            $stm = $this->pdo
                    ->prepare("SELECT * FROM campeonato WHERE id = ?");

            $stm->execute(array($id));
            $r = $stm->fetch(PDO::FETCH_OBJ);

            $camp = new Campeonato();

            $camp->__SET('id', $r->id);
            $camp->__SET('nombre', $r->nombre);
            $camp->__SET('fechaInicio', $r->fechaInicio);
            $camp->__SET('fechaClausura', $r->fechaClausura);
            $camp->__SET('anio', $r->anio);
            $camp->__SET('anio', $r->anio);

            return $camp;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function EliminarCamp($id) {
        try {
            $stm = $this->pdo
                    ->prepare("DELETE FROM campeonato WHERE id = ?");

            $stm->execute(array($id));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ActualizarCamp(Campeonato $data) {
        try {
            $sql = "UPDATE campeonato SET 
						nombre         = ?, 
						fechaInicio    = ?,
                                                fechaClausura  = ?,
						anio           = ?, 
						categoria      = ?
				    WHERE id = ?";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->__GET('nombre'),
                                $data->__GET('fechaInicio'),
                                $data->__GET('fechaClausura'),
                                $data->__GET('anio'),
                                $data->__GET('categoria'),
                                $data->__GET('id')
                            )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function RegistrarCamp(Campeonato $data) {
        try {
            $sql = "INSERT INTO campeonato (nombre,fechaInicio,fechaClausura,anio, categoria) 
		        VALUES (?, ?, ?, ?,?)";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->__GET('nombre'),
                                $data->__GET('fechaInicio'),
                                $data->__GET('fechaClausura'),
                                $data->__GET('anio'),
                                $data->__GET('categoria')
                            )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}
