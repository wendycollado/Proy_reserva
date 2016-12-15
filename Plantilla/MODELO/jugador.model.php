<?php

class JugadorModel {

    private $pdo;

   function __construct() {
        try {
            
            $this->pdo = new PDO('mysql:host=localhost; dbname=estadisticas','root', '');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $exc) {
            die($exc->getMessage());
        }
    }


//    function cargarComboEquipo() {
//
//        try {
//            $query = "select id, nombre from equipo";
//
//            //Preparamos la Consulta para su ejecucion: 
//            $stmt = $this->pdo->prepare($query);
//
//            //Ejecutamos la Consulta
//            $stmt->execute();
//
//            //Obtengo el total de filas afectadas por la accion que se realiza
//            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
//
//            return $data;
//        } catch (PDOException $e) {
//            echo $e->getMessage();
//        }
//    }

    public function ListarJug() {
        try {
            $result = array();

            $stm = $this->pdo->prepare("SELECT j.id,j.nombre, j.fechanac, j.ci, j.nrocamiseta, j.estado, j.fecha, e.nombre as equipo
                                            FROM jugador AS j, equipo AS e
                                                WHERE j.equipo=e.id");
            $stm->execute();

            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $jug = new Jugador();

                $jug->__SET('id', $r->id);
                $jug->__SET('nombre', $r->nombre);
                $jug->__SET('fechanac', $r->fechanac);
                $jug->__SET('ci', $r->ci);
                $jug->__SET('nrocamiseta', $r->nrocamiseta);
                $jug->__SET('estado', $r->estado);
                $jug->__SET('fecha', $r->fecha);
                $jug->__SET('equipo', $r->equipo);

                $result[] = $jug;
            }
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ObtenerJug($id) {
        try {
            $stm = $this->pdo
                    ->prepare("SELECT * FROM jugador WHERE id = ?");

            $stm->execute(array($id));
            $r = $stm->fetch(PDO::FETCH_OBJ);

            $jug = new Jugador();

            $jug->__SET('id', $r->id);
            $jug->__SET('nombre', $r->nombre);
            $jug->__SET('fechanac', $r->fechanac);
            $jug->__SET('ci', $r->ci);
            $jug->__SET('nrocamiseta', $r->nrocamiseta);
            $jug->__SET('estado', $r->estado);
            $jug->__SET('fecha', $r->fecha);
            $jug->__SET('equipo', $r->equipo);

            return $jug;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function EliminarJug($id) {
        try {
            $stm = $this->pdo
                    ->prepare("DELETE FROM jugador WHERE id = ?");

            $stm->execute(array($id));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ActualizarJug(Jugador $data) {
        try {
            $sql = "UPDATE jugador SET 
						nombre         = ?, 
						fechanac       = ?,
                                                ci             = ?,
						nrocamiseta    = ?, 
						estado         = ?,
                                                fecha          = ?,
                                                equipo       = ?
				    WHERE id = ?";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->__GET('nombre'),
                                $data->__GET('fechanac'),
                                $data->__GET('ci'),
                                $data->__GET('nrocamiseta'),
                                $data->__GET('estado'),
                                $data->__GET('fecha'),
                                $data->__GET('equipo'),
                                $data->__GET('id')
                            )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function RegistrarJug(Jugador $data) {
        try {
            $sql = "INSERT INTO jugador (nombre,fechanac,ci, nrocamiseta, estado, fecha,equipo) 
		        VALUES (?, ?, ?, ?, ?, ?, ?)";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                ucfirst($data->__GET('nombre')),
                                $data->__GET('fechanac'),
                                $data->__GET('ci'),
                                $data->__GET('nrocamiseta'),
                                $data->__GET('estado'),
                                $data->__GET('fecha'),
                                $data->__GET('equipo'),
                            )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}
