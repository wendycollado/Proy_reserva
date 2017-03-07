<?php
require '../ENTIDAD/partido.entidad.php';
require '../MODELO/partido.Model.php';

// Logica
$par = new Partido;
$model = new PartidoModel();


if (isset($_REQUEST['action'])) {
    switch ($_REQUEST['action']) {
        case 'actualizar':
            $par->__SET('id', $_REQUEST['id']);
            $par->__SET('fecha', $_REQUEST['fecha']);
            $par->__SET('hora', $_REQUEST['hora']);
            $par->__SET('resultadoA', $_REQUEST['resultadoA']);
            $par->__SET('resultadoB', $_REQUEST['resultadoB']);
            $par->__SET('equipoA', $_REQUEST['equipoA']);
            $par->__SET('equipoB', $_REQUEST['equipoB']);
            $par->__SET('campeonato', $_REQUEST['campeonato']);


            $model->ActualizarPar($par);
            header('Location: partido.php');
            break;

        case 'registrar':
            $par->__SET('fecha', $_REQUEST['fecha']);
            $par->__SET('hora', $_REQUEST['hora']);
            $par->__SET('resultadoA', $_REQUEST['resultadoA']);
            $par->__SET('resultadoB', $_REQUEST['resultadoB']);
            $par->__SET('equipoA', $_REQUEST['equipoA']);
            $par->__SET('equipoB', $_REQUEST['equipoB']);
            $par->__SET('campeonato', $_REQUEST['campeonato']);

            $model->RegistrarPar($par);
            header('Location: partido.php');
            break;

        case 'eliminar':
            $model->EliminarPar($_REQUEST['id']);
            header('Location: partido.php');
            break;

        case 'editar':
            $par = $model->ObtenerPar($_REQUEST['id']);
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>Partido</title>
        <link href="../css/layout.css" rel="stylesheet" type="text/css"/>
        <link href="../css/menu.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
    </head>
    <body>
        <header style="padding-bottom: 50px; background-color: black">
            <center>
                <img src="../imagenes/banner3.jpg" alt="banner"/>
            </center> 
        </header>
        <div class="container">
            <ul id="nav">
                <li><a href="../index.html">Inicio</a></li>
                <li><a class="hsubs" href="#">Inscripciones</a>
                    <ul class="subs">
                        <li><a href="../PRESENTACION/inscripcion.php">Inscripcion al campeonato</a></li>
                        <li><a href="../PRESENTACION/jugador.php">Inscripcion de Jugadores</a></li>
                        <li><a href="../PRESENTACION/equipo.php">Registrar Equipo</a></li>
                    </ul>
                </li>
                <li><a class="hsubs" href="#">Administracion</a>
                    <ul class="subs">
                        <li><a href="../PRESENTACION/campeonato.php">Campeonatos</a></li>
                        <li><a href="../PRESENTACION/partido.php">Partidos</a></li>
                    </ul>
                </li>
                <li><a class="hsubs" href="#">Estadisticas</a>
                    <ul class="subs">
                        <li><a href="../PRESENTACION/estadistica.php">Estadisticas de Jugadores</a></li>
                        <li><a href="../PRESENTACION/ranking.php">Ranking de Clubes</a></li>
                        <li><a href="../PRESENTACION/resultado.php">Resultado Estadistica</a></li>
                    </ul>
                </li>
            </ul>
                
            <section style="padding: 10px; color: white; text-align: center">
                <h1>Partido</h1>    
                <form action="?action=<?php echo $par->id > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px; padding-left:200px">
                    <input type="hidden" name="id" value="<?php echo $par->__GET('id'); ?>" />

                    <table style="width:500px;">
                        <tr>
                            <th style="text-align:left;">Fecha</th>
                            <td><input type="text" name="fecha" value="<?php echo $par->__GET('fecha'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Hora</th>
                            <td><input type="text" name="hora" value="<?php echo $par->__GET('hora'); ?>" style="width:100%;" /></td>
                        </tr>
                       <tr>
                            <th style="text-align:left;">Resultado Local</th>
                            <td><input type="number" name="resultadoA" value="<?php echo $par->__GET('resultadoA'); ?>" min="0" max="20" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Resultado Visitante</th>
                            <td><input type="number" name="resultadoB" value="<?php echo $par->__GET('resultadoB'); ?>" min="0" max="20" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Equipo Local</th>
                            <td>
                                <select name="equipoA">
                                    <?php foreach ($model->cargarComboEquipoA() as $row) : ?> 
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre'];?> - <?php echo $row['rama'];?></option> 
                                    <?php endforeach ?> 
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Equipo Visitante</th>
                            <td>
                                <select name="equipoB">
                                    <?php foreach ($model->cargarComboEquipoB() as $row) : ?> 
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?> - <?php echo $row['rama'];?></option> 
                                    <?php endforeach ?> 
                                </select>
                            </td>
                        </tr>
                        <tr>
                        <tr>
                            <th style="text-align:left;">Campeonato</th>
                            <td>
                                <select name="campeonato">
                                    <?php foreach ($model->cargarComboCampeonato() as $row) : ?> 
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option> 
                                    <?php endforeach ?> 
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <button type="submit" class="pure-button pure-button-primary">Guardar</button>
                            </td>
                        </tr>
                    </table>
                </form>

                <table class="pure-table pure-table-horizontal">
                    <thead>
                        <tr>
                            <th style="text-align:left;">Fecha</th>
                            <th style="text-align:left;">Hora</th>
                            <th style="text-align:left;">Resultado Local</th>
                            <th style="text-align:left;">Resultado Visitante</th>
                            <th style="text-align:left;">Equipo Local</th>
                            <th style="text-align:left;">Equipo Visitante</th>
                            <th style="text-align:left;">Campeonato</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach ($model->ListarPartido() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('fecha'); ?></td>
                            <td><?php echo $r->__GET('hora'); ?></td>
                            <td><?php echo $r->__GET('resultadoA'); ?></td>
                            <td><?php echo $r->__GET('resultadoB'); ?></td>
                            <td><?php echo $r->__GET('equipoA'); ?></td>
                            <td><?php echo $r->__GET('equipoB'); ?></td>
                            <td><?php echo $r->__GET('campeonato'); ?></td>
                            
                            <td>
                                <a href="?action=editar&id=<?php echo $r->id; ?>">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&id=<?php echo $r->id; ?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>     
            </section>
            </div>
    </body>
</html>

