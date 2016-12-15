<?php



class PartidoModel {

    private $pdo;
   
  
   function __construct() {
        try {
           
            $this->pdo = new PDO('mysql:host=localhost; dbname=estadisticas','root', '');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $exc) {
            die($exc->getMessage());
        }
    }


    function cargarComboCampeonato() {

        try {
            $query = "select id, nombre from campeonato";

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

    function cargarComboEquipoA() {

        try {
            $query = "SELECT id, nombre, rama from equipo";

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

    function cargarComboEquipoB() {

        try {
            $query = "SELECT id, nombre, rama from equipo";

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

    
    public function ListarPartido() {
        try {
            $result = array();

            $stm = $this->pdo->prepare("SELECT p.id, p.fecha, hora, resultadoA, resultadoB,eqA.nombre AS equipoA,eqB.nombre AS equipoB,c.nombre as campeonato
                                        FROM partido AS p, equipo AS eqA, equipo AS eqB, campeonato AS c
                                        WHERE p.equipoA=eqA.id AND p.equipoB=eqB.id AND p.campeonato=c.id
            ");
            $stm->execute();

            foreach ($stm->fetchAll(PDO::FETCH_OBJ) as $r) {
                $par = new Partido();
                
                $par->__SET('id', $r->id);
                $par->__SET('fecha', $r->fecha);
                $par->__SET('hora', $r->hora);
                $par->__SET('resultadoA', $r->resultadoA);
                $par->__SET('resultadoB', $r->resultadoB);
                $par->__SET('equipoA', $r->equipoA);
                $par->__SET('equipoB', $r->equipoB);
                $par->__SET('campeonato', $r->campeonato);
                $result[] = $par;
            }
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ObtenerPar($id) {
        try {
            $stm = $this->pdo->prepare("SELECT * FROM partido WHERE id = ?");

            $stm->execute(array($id));
            $r = $stm->fetch(PDO::FETCH_OBJ);

            $par = new Partido();

            $par->__SET('id', $r->id);
            $par->__SET('fecha', $r->fecha);
            $par->__SET('hora', $r->hora);
            $par->__SET('resultadoA', $r->resultadoA);
            $par->__SET('resultadoB', $r->resultadoB);
            $par->__SET('equipoA', $r->equipoA);
            $par->__SET('equipoB', $r->equipoB);
            $par->__SET('campeonato', $r->campeonato);
            
            return $par;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function EliminarPar($id) {
        try {
            $stm = $this->pdo
                    ->prepare("DELETE FROM partido WHERE id = ?");

            $stm->execute(array($id));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
					
       
     public function ActualizarPar(Partido $data) {
        try {
            $sql = "UPDATE partido SET 
						fecha         = ?, 
						hora       = ?,
                                               resultadoA             = ?,
						resultadoB   = ?, 
						equipoA         = ?,
                                                equipoB          = ?,
                                                campeonato       = ?
				    WHERE id = ?";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->__GET('fecha'),
                                $data->__GET('hora'),
                                $data->__GET('resultadoA'),
                                $data->__GET('resultadoB'),
                                $data->__GET('equipoA'),
                                $data->__GET('equipoB'),
                                $data->__GET('campeonato'),
                                $data->__GET('id')
                            )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function RegistrarPar(Partido $data) {
        try {
            $sql = "INSERT INTO partido (fecha,hora,resultadoA, resultadoB, equipoA, equipoB, campeonato) 
		        VALUES (?, ?, ?, ?,?,?,?)";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->__GET('fecha'),
                                $data->__GET('hora'),
                                $data->__GET('resultadoA'),
                                $data->__GET('resultadoB'),
                                $data->__GET('equipoA'),
                                $data->__GET('equipoB'),
                                $data->__GET('campeonato')
                            )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}

