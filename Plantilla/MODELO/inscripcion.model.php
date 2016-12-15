<?php

class InscripcionModel {

    private $pdo;

   function __construct() {
        try {
            $this->pdo = new PDO('mysql:host=localhost; dbname=estadisticas','root', '');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $exc) {
            die($exc->getMessage());
        }
    }

   
    function cargarComboCamp() {

        try {
            $query = "select id, nombre,categoria from campeonato";

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

    
    function cargarComboEquipo() {

        try {
            $query = "select id, nombre, rama from equipo";

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

    public function ListarInscripcion() {
        try {
            $result = array();

            $stm = $this->pdo->prepare("SELECT i.id, c.nombre as campeonato, e.nombre as equipo, i.fecha
                                        FROM inscripcion as i, campeonato as c, equipo as e
                                        where i.campeonato=c.id and i.equipo=e.id");
            $stm->execute();

            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $ins = new Inscripcion();

                $ins->__SET('id', $r->id);
                $ins->__SET('campeonato', $r->campeonato);
                $ins->__SET('equipo', $r->equipo);
                $ins->__SET('fecha', $r->fecha);
                $result[] = $ins;
            }

            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ObtenerIns($id) {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM inscripcion WHERE id = ?");

            $stm->execute(array($id));
            $r = $stm->fetch(PDO::FETCH_OBJ);

            $ins = new Inscripcion();

            $ins->__SET('id', $r->id);
            $ins->__SET('campeonato', $r->campeonato);
            $ins->__SET('equipo', $r->equipo);
            $ins->__SET('fecha', $r->fecha);
            
            return $ins;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function EliminarIns($id) {
        try {
            $stm = $this->pdo->prepare("DELETE FROM inscripcion WHERE id = ?");

            $stm->execute(array($id));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ActualizarIns(Inscripcion $data) {
        try {
            $sql = "UPDATE inscripcion SET 
						campeonato  = ?, 
						equipo      = ?,
                                                fecha       = ?
                                        WHERE id = ?";
            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->__GET('campeonato'),
                                $data->__GET('equipo'),
                                $data->__GET('fecha'),
                                $data->__GET('id')
                            )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function RegistrarIns(Inscripcion $data) {
        try {
            $sql = "INSERT INTO inscripcion (campeonato,equipo, fecha) 
		        VALUES (?, ?, ?)";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->__GET('campeonato'),
                                $data->__GET('equipo'),
                                $data->__GET('fecha'),
                            )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
