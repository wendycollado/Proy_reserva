<?php
require '../ENTIDAD/estadistica.entidad.php';
require '../MODELO/estadistica.model.php';



// Logica
$est = new Estadistica();
$model = new EstadisticaModel();


if (isset($_REQUEST['action'])) {
    switch ($_REQUEST['action']) {
        case 'actualizar':
            $est->__SET('simple', $_REQUEST['simple']);
            $est->__SET('tci1', $_REQUEST['tci1']);
            $est->__SET('doble', $_REQUEST['doble']);
            $est->__SET('tci2', $_REQUEST['tci2']);
            $est->__SET('triple', $_REQUEST['triple']);
            $est->__SET('tci3', $_REQUEST['tci3']);
            $est->__SET('faltaRecibida', $_REQUEST['faltaRecibida']);
            $est->__SET('faltaCometida', $_REQUEST['faltaCometida']);
            $est->__SET('perdidaBalon', $_REQUEST['perdidaBalon']);
            $est->__SET('asistencia', $_REQUEST['asistencia']);
            $est->__SET('reboteDef', $_REQUEST['reboteDef']);
            $est->__SET('reboteOfe', $_REQUEST['reboteOfe']);
            $est->__SET('partido', $_REQUEST['partido']);
            $est->__SET('jugador', $_REQUEST['jugador']);

            $model->Actualizar($est);
            header('Location: estadistica.php');
            break;

        case 'registrar':
            $est->__SET('simple', $_REQUEST['simple']);
            $est->__SET('tci1', $_REQUEST['tci1']);
            $est->__SET('doble', $_REQUEST['doble']);
            $est->__SET('tci2', $_REQUEST['tci2']);
            $est->__SET('triple', $_REQUEST['triple']);
            $est->__SET('tci3', $_REQUEST['tci3']);
            $est->__SET('faltaRecibida', $_REQUEST['faltaRecibida']);
            $est->__SET('faltaCometida', $_REQUEST['faltaCometida']);
            $est->__SET('perdidaBalon', $_REQUEST['perdidaBalon']);
            $est->__SET('asistencia', $_REQUEST['asistencia']);
            $est->__SET('reboteDef', $_REQUEST['reboteDef']);
            $est->__SET('reboteOfe', $_REQUEST['reboteOfe']);
            $est->__SET('partido', $_REQUEST['partido']);
            $est->__SET('jugador', $_REQUEST['jugador']);

            $model->Registrar($est);
            header('Location: estadistica.php');
            break;

        case 'eliminar':
            $model->Eliminar($_REQUEST['id']);
            header('Location: estadistica.php');
            break;

        case 'editar':
            $est = $model->Obtener($_REQUEST['id']);
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>Estadisticas</title>
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
                <h1>Estadisticas por Jugador</h1>
                <form action="?action=<?php echo $est->id > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px; padding-left:200px;">
                    <input type="hidden" name="id" value="<?php echo $est->__GET('id'); ?>" />
                    <table style="width:500px; padding-right: 100px">
                        <tr>
                            <th style="text-align:left;">Simple</th>
                            <td><input type="number" name="simple"  value="<?php echo $est->__GET('simple'); ?>" style="width:100%;" min="0" max="99" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Simple Cometido</th>
                            <td><input type="number" name="tci1"  value="<?php echo $est->__GET('tci1'); ?>" style="width:100%;" min="0" max="99" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Doble</th>
                            <td><input type="number" name="doble"  value="<?php echo $est->__GET('doble'); ?>" style="width:100%;" min="0" max="99" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Doble Cometido</th>
                            <td><input type="number" name="tci2"  value="<?php echo $est->__GET('tci2'); ?>" style="width:100%;" min="0" max="99" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Triple</th>
                            <td><input type="number" name="triple"  value="<?php echo $est->__GET('triple'); ?>" style="width:100%;" min="0" max="99" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Triple Cometido</th>
                            <td><input type="number" name="tci3"  value="<?php echo $est->__GET('tci3'); ?>" style="width:100%;" min="0" max="99" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Falta Recibida</th>
                            <td><input type="number" name="faltaRecibida"  value="<?php echo $est->__GET('faltaRecibida'); ?>" style="width:100%;" min="0" max="99" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Falta Cometida</th>
                            <td><input type="number" name="faltaCometida"  value="<?php echo $est->__GET('faltaCometida'); ?>" style="width:100%;" min="0" max="99" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Perdida de Balon</th>
                            <td><input type="number" name="perdidaBalon"  value="<?php echo $est->__GET('perdidaBalon'); ?>" style="width:100%;" min="0" max="99" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Asistencia</th>
                            <td><input type="number" name="asistencia"  value="<?php echo $est->__GET('asistencia'); ?>" style="width:100%;" min="0" max="99" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Rebote Defensivo</th>
                            <td><input type="number" name="reboteDef"  value="<?php echo $est->__GET('reboteDef'); ?>" style="width:100%;" min="0" max="99" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Rebote Ofensivo</th>
                            <td><input type="number" name="reboteOfe"  value="<?php echo $est->__GET('reboteOfe'); ?>" style="width:100%;" min="0" max="99" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Partido</th>
                            <td>
                                <select name="partido">
                                    <?php foreach ($model->cargarComboPartido() as $row) : ?> 
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['id']; ?> </option> 
                                    <?php endforeach ?> 
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Nro camiseta Jugador</th>
                            <td>
                                <select name="jugador">
                                    <?php foreach ($model->cargarComboJugador() as $row) : ?> 
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['nrocamiseta']; ?> - <?php echo $row['nombre']; ?></option> 
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
                            <th style="text-align:left;">Simple</th>
                            <th style="text-align:left;">SimpleI</th>
                            <th style="text-align:left;">Doble</th>
                            <th style="text-align:left;">DobleI</th>
                            <th style="text-align:left;">Triple</th>
                            <th style="text-align:left;">TripleI</th>
                            <th style="text-align:left;">FaltaR</th>
                            <th style="text-align:left;">FaltaC</th>
                            <th style="text-align:left;">PerdidaB</th>
                            <th style="text-align:left;">Asistencia</th>
                            <th style="text-align:left;">ReboteDef</th>
                            <th style="text-align:left;">ReboteOfe</th>
                            <th style="text-align:left;">Partido</th>
                            <th style="text-align:left;">Jugador</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach ($model->ListarEstadistica() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('simple'); ?></td>
                            <td><?php echo $r->__GET('tci1'); ?></td>
                            <td><?php echo $r->__GET('doble'); ?></td>
                            <td><?php echo $r->__GET('tci2'); ?></td>
                            <td><?php echo $r->__GET('triple'); ?></td>
                            <td><?php echo $r->__GET('tci3'); ?></td>
                            <td><?php echo $r->__GET('faltaRecibida'); ?></td>
                            <td><?php echo $r->__GET('faltaCometida'); ?></td>
                            <td><?php echo $r->__GET('perdidaBalon'); ?></td>
                            <td><?php echo $r->__GET('asistencia'); ?></td>
                            <td><?php echo $r->__GET('reboteDef'); ?></td>
                            <td><?php echo $r->__GET('reboteOfe'); ?></td>
                            <td><?php echo $r->__GET('partido'); ?></td>
                            <td><?php echo $r->__GET('jugador'); ?></td>

                            <!--td>
                                <a href="?action=editar&id=<?php echo $r->id; ?>">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&id=<?php echo $r->id; ?>">Eliminar</a>
                            </td-->
                        </tr>
                    <?php endforeach; ?>
                </table>     
            </section>
        </div>
    </body>
</html>




