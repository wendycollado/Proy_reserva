<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AlumnoModel
 *
 * @author Tefy
 */
class EquipoModel {

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

            $stm = $this->pdo->prepare("SELECT * FROM equipo");
            $stm->execute();

            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $alm = new Equipo();

                $alm->__SET('id', $r->id);
                $alm->__SET('nombre', $r->nombre);
                $alm->__SET('fecha', $r->fecha);
                $alm->__SET('rama', $r->rama);
                $alm->__SET('color', $r->color);

                $result[] = $alm;
            }

            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Obtener($id) {
        try {
            $stm = $this->pdo
                    ->prepare("SELECT * FROM equipo WHERE id = ?");


            $stm->execute(array($id));
            $r = $stm->fetch(PDO::FETCH_OBJ);

            $alm = new Equipo();

            $alm->__SET('id', $r->id);
            $alm->__SET('nombre', $r->nombre);
            $alm->__SET('fecha', $r->fecha);
            $alm->__SET('rama', $r->rama);
            $alm->__SET('color', $r->color);

            return $alm;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Eliminar($id) {
        try {
            $stm = $this->pdo
                    ->prepare("DELETE FROM equipo WHERE id = ?");

            $stm->execute(array($id));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Actualizar(Equipo $data) {
        try {
            $sql = "UPDATE equipo SET 
						nombre         = ?, 
						fecha          = ?,
						rama           = ?, 
						color          = ?
				    WHERE id = ?";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->__GET('nombre'),
                                $data->__GET('fecha'),
                                $data->__GET('rama'),
                                $data->__GET('color'),
                                $data->__GET('id')
                            )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Registrar(Equipo $data) {
        try {
            $sql = "INSERT INTO equipo (nombre,fecha,rama,color) 
		        VALUES (?, ?, ?, ?)";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->__GET('nombre'),
                                $data->__GET('fecha'),
                                $data->__GET('rama'),
                                $data->__GET('color')
                            )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    function cargarComboEquipo() {
        try {
            $query = "select id, nombre from equipo";

            //Preparamos la Consulta para su ejecucion: 
            $stmt = $this->pdo->prepare($query);

            //Ejecutamos la Consulta
            $stmt->execute();

            //Obtengo el total de filas afectadas por la accion que se realiza
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}
