<?php
require '../ENTIDAD/ranking.entidad.php';
require '../MODELO/ranking.Model.php';

// Logica
$camp = new Ranking();
$model = new RankingModel();


if (isset($_REQUEST['action'])) {
    switch ($_REQUEST['action']) {
        case 'actualizar':
            $camp->__SET('id', $_REQUEST['id']);
            $camp->__SET('p_ganado', $_REQUEST['p_ganado']);
            $camp->__SET('p_perdido', $_REQUEST['p_perdido']);
            $camp->__SET('pto_contra', $_REQUEST['pto_contra']);
            $camp->__SET('pto_favor', $_REQUEST['pto_favor']);
            $camp->__SET('puntos', $_REQUEST['puntos']);
            $camp->__SET('equipo', $_REQUEST['equipo']);

            $model->ActualizarPare($camp);
            header('Location: ranking.php');
            break;

        case 'registrar':
            $camp->__SET('id', $_REQUEST['id']);
            $camp->__SET('p_ganado', $_REQUEST['p_ganado']);
            $camp->__SET('p_perdido', $_REQUEST['p_perdido']);
            $camp->__SET('pto_contra', $_REQUEST['pto_contra']);
            $camp->__SET('pto_favor', $_REQUEST['pto_favor']);
            $camp->__SET('puntos', $_REQUEST['puntos']);
            $camp->__SET('equipo', $_REQUEST['equipo']);

            $model->RegistrarRanking($camp);
            header('Location: ranking.php');
            break;

        case 'eliminar':
            $model->EliminarRanking($_REQUEST['id']);
            header('Location: ranking.php');
            break;

        case 'editar':
            $camp = $model->ObtenerRanking($_REQUEST['id']);
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>Ranking</title>
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
                <h1>Ranking de Clubes</h1>    
                <form action="?action=<?php echo $camp->id > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px; padding-left:200px">
                    <input type="hidden" name="id" value="<?php echo $camp->__GET('id'); ?>" />

                    <table style="width:500px;">
                        <tr>
                            <th style="text-align:left;">Partido Ganado</th>
                            <td><input type="number" name="p_ganado" value="<?php echo $camp->__GET('p_ganado'); ?>" min="0"  max="100" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Partido Perdido</th>
                            <td><input type="number" name="p_perdido" value="<?php echo $camp->__GET('p_perdido'); ?>" min="0"  max="100" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Punto Contra</th>
                            <td><input type="number" name="pto_contra" value="<?php echo $camp->__GET('pto_contra'); ?>" min="0"  max="100" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Punto Favor</th>
                            <td><input type="number" name="pto_favor" value="<?php echo $camp->__GET('pto_favor'); ?>"min="0" max="100" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Puntos</th>
                            <td><input type="number" name="puntos" value="<?php echo $camp->__GET('puntos'); ?>" min="0"  max="100" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Equipo</th>
                            <td>
                                <select name="equipo">
                                    <?php foreach ($model->cargarComboEquipo() as $row) : ?> 
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

                <center><table class="pure-table pure-table-horizontal">
                    <thead>
                        <tr>
                            <th style="text-align:left;">Puntos ganados</th>
                            <th style="text-align:left;">Puntos perdidos</th>
                            <th style="text-align:left;">Puntos en contra</th>
                            <th style="text-align:left;">Puntos a favor</th>
                            <th style="text-align:left;">Puntos</th>
                            <th style="text-align:left;">Equipo</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach ($model->ListarRanking() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('p_ganado'); ?></td>
                            <td><?php echo $r->__GET('p_perdido'); ?></td>
                            <td><?php echo $r->__GET('pto_contra'); ?></td>
                            <td><?php echo $r->__GET('pto_favor'); ?></td>
                            <td><?php echo $r->__GET('puntos'); ?></td>
                            <td><?php echo $r->__GET('equipo'); ?></td>

                            <td>
                                <a href="?action=editar&id=<?php echo $r->id; ?>">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&id=<?php echo $r->id; ?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table></center>     
            </section>
        </div>
    </body>
</html>




