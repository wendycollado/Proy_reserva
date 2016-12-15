<?php
require '../ENTIDAD/inscripcion.entidad.php';
require '../MODELO/inscripcion.model.php';

// Logica
$ins = new Inscripcion();
$model = new InscripcionModel();

if (isset($_REQUEST['action'])) {
    switch ($_REQUEST['action']) {
        case 'actualizar':
            $ins->__SET('id', $_REQUEST['id']);
            $ins->__SET('campeonato', $_REQUEST['campeonato']);
            $ins->__SET('equipo', $_REQUEST['equipo']);
            $ins->__SET('fecha', $_REQUEST['fecha']);


            $model->ActualizarIns($ins);
            header('Location: inscripcion.php');
            break;

        case 'registrar':
            $ins->__SET('campeonato', $_REQUEST['campeonato']);
            $ins->__SET('equipo', $_REQUEST['equipo']);
            $ins->__SET('fecha', $_REQUEST['fecha']);

            $model->RegistrarIns($ins);
            header('Location: inscripcion.php');
            break;

        case 'eliminar':
            $model->EliminarIns($_REQUEST['id']);
            header('Location: inscripcion.php');
            break;

        case 'editar':
            $ins = $model->ObtenerIns($_REQUEST['id']);
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>Inscripcion</title>
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
                <h1>Inscripcion al Campeonato</h1>
                <form action="?action=<?php echo $ins->id > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px; padding-left:200px;">
                    <input type="hidden" name="id" value="<?php echo $ins->__GET('id'); ?>" />

                    <table style="width:500px; padding-right: 100px">
                        <tr>
                            <th style="text-align:left;">Campeonato</th>
                            <td>
                                <select name="campeonato">
                                    <?php foreach ($model->cargarComboCamp() as $row) : ?> 
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?> - <?php echo $row['categoria']; ?></option> 
                                    <?php endforeach ?> 
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Equipo</th>
                            <td>
                                <select name="equipo">
                                    <?php foreach ($model->cargarComboEquipo() as $row) : ?> 
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?> - <?php echo $row['rama']; ?></option> 
                                    <?php endforeach ?> 
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Fecha</th>
                            <td><input type="text" name="fecha" value="<?php echo $ins->__GET('fecha'); ?>" style="width:100%;" /></td>
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
                            <th style="text-align:left;">Campeonato</th>
                            <th style="text-align:left;">Equipo</th>
                            <th style="text-align:left;">Fecha</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach ($model->ListarInscripcion() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('campeonato'); ?></td>
                            <td><?php echo $r->__GET('equipo'); ?></td>
                            <td><?php echo $r->__GET('fecha'); ?></td>
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

