<?php

class RankingModel {

    private $pdo;

   function __construct() {
        try {
           
            $this->pdo = new PDO('mysql:host=localhost; dbname=estadisticas','root', '');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $exc) {
            die($exc->getMessage());
        }
    }

    public function ListarRanking() {
        try {
            $result = array();

            $stm = $this->pdo->prepare("SELECT * FROM ranking");
            $stm->execute();

            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $camp = new Ranking();

                $camp->__SET('id', $r->id);
                $camp->__SET('p_ganado', $r->p_ganado);
                $camp->__SET('p_perdido', $r->p_perdido);
                $camp->__SET('pto_contra', $r->pto_contra);
                $camp->__SET('pto_favor', $r->pto_favor);
                $camp->__SET('puntos', $r->puntos);
                $camp->__SET('equipo', $r->equipo);

                $result[] = $camp;
            }

            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ObtenerRanking($id) {
        try {
            $stm = $this->pdo
                    ->prepare("SELECT * FROM ranking WHERE id = ?");

            $stm->execute(array($id));
            $r = $stm->fetch(PDO::FETCH_OBJ);

            $camp = new Ranking();

            $camp->__SET('id', $r->id);
            $camp->__SET('p_ganado', $r->p_ganado);
            $camp->__SET('p_perdido', $r->p_perdido);
            $camp->__SET('pto_contra', $r->pto_contra);
            $camp->__SET('pto_favor', $r->pto_favor);
            $camp->__SET('puntos', $r->puntos);
            $camp->__SET('equipo', $r->equipo);


            return $camp;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function EliminarRanking($id) {
        try {
            $stm = $this->pdo
                    ->prepare("DELETE FROM ranking WHERE id = ?");

            $stm->execute(array($id));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ActualizarRanking(Ranking $data) {
        try {
            $sql = "UPDATE ranking SET 
						p_ganado         = ?, 
						p_perdido        = ?,
                                                pto_contra       = ?,
						pto_favor        = ?, 
						puntos           = ?,
                                                equipo           =?
				    WHERE id = ?";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->__GET('p_ganado'),
                                $data->__GET('p_perdido'),
                                $data->__GET('pto_contra'),
                                $data->__GET('pto_favor'),
                                $data->__GET('puntos'),
                                $data->__GET('equipo')
                            )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function RegistrarRanking(Ranking $data) {
        try {
            $sql = "INSERT INTO ranking (p_ganado, p_perdido, pto_contra, pto_favor, puntos, equipo) 
		        VALUES (?, ?, ?, ?,?,?)";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->__GET('p_ganado'),
                                $data->__GET('p_perdido'),
                                $data->__GET('pto_contra'),
                                $data->__GET('pto_favor'),
                                $data->__GET('puntos'),
                                $data->__GET('equipo')
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
     public function ActualizarPare(Ranking $data) {
        try {
            $sql = "UPDATE ranking SET 
						p_ganado   = ?, 
						p_perdido  = ?,
                                                pto_contra = ?,
						pto_favor   = ?, 
						puntos      = ?,
                                                equipo      = ?
				    WHERE id = ?";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->__GET('p_ganado'),
                                $data->__GET('p_perdido'),
                                $data->__GET('pto_contra'),
                                $data->__GET('pto_favor'),
                                $data->__GET('puntos'),
                                $data->__GET('equipo'),
                                $data->__GET('id')
                            )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}
