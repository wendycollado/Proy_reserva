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
class EstadisticaModel {

    private $pdo;

    function __construct() {
        try {
            $this->pdo = new PDO('mysql:host=localhost; dbname=estadisticas','root', '');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $exc) {
            die($exc->getMessage());
        }
    }

    function cargarComboPartido() {

        try {
            $query = "select id from partido";

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

    function cargarComboJugador() {

        try {
            $query = "select id, nombre, nrocamiseta from jugador";

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

    public function ListarEstadistica() {
        try {
            $result = array();

            $stm = $this->pdo->prepare("SELECT e.id, e.simple, e.tci1, e.doble, e.tci2, e. triple, e.tci3, e.faltaRecibida, e.faltaCometida, e.perdidaBalon, e.asistencia, e.reboteDef, e.reboteOfe, e.partido AS partido, j.nombre AS jugador
                                            FROM estadistica AS e, jugador AS j, partido AS p
                                                WHERE e.partido=p.id AND e.jugador=j.id ");
            $stm->execute();

            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $est = new Estadistica();

                $est->__SET('id', $r->id);
                $est->__SET('simple', $r->simple);
                $est->__SET('tci1', $r->tci1);
                $est->__SET('doble', $r->doble);
                $est->__SET('tci2', $r->tci2);
                $est->__SET('triple', $r->triple);
                $est->__SET('tci3', $r->tci3);
                $est->__SET('faltaRecibida', $r->faltaRecibida);
                $est->__SET('faltaCometida', $r->faltaCometida);
                $est->__SET('perdidaBalon', $r->perdidaBalon);
                $est->__SET('asistencia', $r->asistencia);
                $est->__SET('reboteDef', $r->reboteDef);
                $est->__SET('reboteOfe', $r->reboteOfe);
                $est->__SET('partido', $r->partido);
                $est->__SET('jugador', $r->jugador);

                $result[] = $est;
            }
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Obtener($id) {
        try {
            $stm = $this->pdo
                    ->prepare("SELECT * FROM estadistica WHERE id = ?");


            $stm->execute(array($id));
            $r = $stm->fetch(PDO::FETCH_OBJ);

            $est = new Estadistica();

            $est->__SET('id', $r->id);
            $est->__SET('simple', $r->simple);
            $est->__SET('doble', $r->doble);
            $est->__SET('triple', $r->triple);
            $est->__SET('falta', $r->falta);
            $est->__SET('perdidaBalon', $r->perdidaBalon);
            $est->__SET('asistencia', $r->asistencia);
            $est->__SET('rebote', $r->rebote);
            $est->__SET('partido', $r->partido);
            $est->__SET('jugador', $r->jugador);

            return $est;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Eliminar($id) {
        try {
            $stm = $this->pdo
                    ->prepare("DELETE FROM estadistica WHERE id = ?");

            $stm->execute(array($id));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Actualizar(Estadistica $data) {
        try {
            $sql = "UPDATE estadistica SET 
						simple        = ?, 
						doble         = ?,
						triple        = ?,
                                                falta         = ?, 
						perdidaBalon  = ?,
						asistencia    = ?,
						partido       = ?,
                                                jugador       =?
				    WHERE id = ?";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->__GET('simple'),
                                $data->__GET('doble'),
                                $data->__GET('triple'),
                                $data->__GET('falta'),
                                $data->__GET('perdidaBalon'),
                                $data->__GET('asistencia'),
                                $data->__GET('partido'),
                                $data->__GET('jugador')
                            )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Registrar(Estadistica $data) {
        try {
            $sql = "INSERT INTO estadistica (simple,tci1,doble,tci2,triple,tci3,faltaRecibida,faltaCometida, perdidaBalon,asistencia,reboteDef,reboteOfe,partido,jugador) 
		        VALUES (?, ?, ?, ?,?,?,?,?,?,?,?,?,?,?)";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->__GET('simple'),
                                $data->__GET('tci1'),
                                $data->__GET('doble'),
                                $data->__GET('tci2'),
                                $data->__GET('triple'),
                                $data->__GET('tci3'),
                                $data->__GET('faltaRecibida'),
                                $data->__GET('faltaCometida'),
                                $data->__GET('perdidaBalon'),
                                $data->__GET('asistencia'),
                                $data->__GET('reboteDef'),
                                $data->__GET('reboteOfe'),
                                $data->__GET('partido'),
                                $data->__GET('jugador')
                            )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}
