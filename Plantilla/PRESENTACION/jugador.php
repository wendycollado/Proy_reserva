<?php
require '../ENTIDAD/jugador.entidad.php';
require '../MODELO/jugador.model.php';
require '../MODELO/equipo.model.php';



// Logica
$jug = new Jugador();
$model = new JugadorModel();
$equi = new EquipoModel();

if (isset($_REQUEST['action'])) {
    switch ($_REQUEST['action']) {
        case 'actualizar':
            $jug->__SET('id', $_REQUEST['id']);
            strtoupper($jug->__SET('nombre', $_REQUEST['nombre']));
            $jug->__SET('fechanac', $_REQUEST['fechanac']);
            $jug->__SET('ci', $_REQUEST['ci']);
            $jug->__SET('nrocamiseta', $_REQUEST['nrocamiseta']);
            strtoupper($jug->__SET('estado', $_REQUEST['estado']));
            $jug->__SET('fecha', $_REQUEST['fecha']);
            $jug->__SET('equipo', $_REQUEST['equipo']);


            $model->ActualizarJug($jug);
            header('Location: jugador.php');
            break;

        case 'registrar':
            strtoupper($jug->__SET('nombre', $_REQUEST['nombre']));
            $jug->__SET('fechanac', $_REQUEST['fechanac']);
            $jug->__SET('ci', $_REQUEST['ci']);
            $jug->__SET('nrocamiseta', $_REQUEST['nrocamiseta']);
            strtoupper($jug->__SET('estado', $_REQUEST['estado']));
            $jug->__SET('fecha', $_REQUEST['fecha']);
            $jug->__SET('equipo', $_REQUEST['equipo']);

            $model->RegistrarJug($jug);
            header('Location: jugador.php');
            break;

        case 'eliminar':
            $model->EliminarJug($_REQUEST['id']);
            header('Location: jugador.php');
            break;

        case 'editar':
            $jug = $model->ObtenerJug($_REQUEST['id']);
            break;
    }
}
?>


<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>Jugador</title>
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
                <h1>Jugador</h1>
                <form action="?action=<?php echo $jug->id > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px; padding-left:200px">
                    <input type="hidden" name="id" value="<?php echo $jug->__GET('id'); ?>" />

                    <table style="width:500px;">
                        <tr>
                            <th style="text-align:left;">Nombre</th>
                            <td><input type="text" name="nombre" value="<?php echo strtoupper($jug->__GET('nombre')); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Fecha Nacimiento</th>
                            <td><input type="text" name="fechanac" value="<?php echo $jug->__GET('fechanac'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Cedula de Identidad</th>
                            <td><input type="number" name="ci" value="<?php echo $jug->__GET('ci'); ?>" min="1000000" max="100000000" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Nro camiseta</th>
                            <td><input type="number" name="nrocamiseta" value="<?php echo $jug->__GET('nrocamiseta'); ?>" min="0" max="20" style="width:100%;" /></td>
                        </tr>

                        <tr>
                            <th style="text-align:left;">Estado</th>
                            <td>
                                <select name="estado" style="width:100%;">
                                    <option value="activo" <?php echo strtoupper($jug->__GET('estado') == 'ACTIVO' ? 'selected' : ''); ?>>HABILITADO</option>
                                    <option value="deshabilitado" <?php echo strtoupper($jug->__GET('estado') == 'DESHABILITADO' ? 'selected' : ''); ?>>DESHABILITADO</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Fecha</th>
                            <td><input type="text" name="fecha" value="<?php echo $jug->__GET('fecha'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Equipo</th>
                            <td>
                                <select name="equipo">
                                    <?php foreach ($equi->cargarComboEquipo() as $row) : ?> 
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
                            <th style="text-align:left;">Nombre</th>
                            <th style="text-align:left;">Fecha Nacimiento</th>
                            <th style="text-align:left;">Cedula de Identidad</th>
                            <th style="text-align:left;">Nro Camiseta</th>
                            <th style="text-align:left;">Estado</th>
                            <th style="text-align:left;">Fecha</th>
                            <th style="text-align:left;">Equipo</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach ($model->ListarJug() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('nombre'); ?></td>
                            <td><?php echo $r->__GET('fechanac'); ?></td>
                            <td><?php echo $r->__GET('ci'); ?></td>
                            <td><?php echo $r->__GET('nrocamiseta'); ?></td>
                            <td><?php echo $r->__GET('estado') == 'activo' ? 'habilitado' : 'deshabilitado'; ?></td>
                            <td><?php echo $r->__GET('fecha'); ?></td>
                            <td><?php echo $r->__GET('equipo'); ?></td>
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