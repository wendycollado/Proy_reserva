<?php
require '../ENTIDAD/equipo.entidad.php';
require '../MODELO/equipo.model.php';



// Logica
$alm = new Equipo();
$model = new EquipoModel();

if (isset($_REQUEST['action'])) {
    switch ($_REQUEST['action']) {
        case 'actualizar':
            $alm->__SET('id', $_REQUEST['id']);
            $alm->__SET('nombre', $_REQUEST['nombre']);
            $alm->__SET('fecha', $_REQUEST['fecha']);
            $alm->__SET('rama', $_REQUEST['rama']);
            $alm->__SET('color', $_REQUEST['color']);

            $model->Actualizar($alm);
            header('Location: equipo.php');
            break;

        case 'registrar':
            $alm->__SET('nombre', $_REQUEST['nombre']);
            $alm->__SET('fecha', $_REQUEST['fecha']);
            $alm->__SET('rama', $_REQUEST['rama']);
            $alm->__SET('color', $_REQUEST['color']);

            $model->Registrar($alm);
            header('Location: equipo.php');
            break;

        case 'eliminar':
            $model->Eliminar($_REQUEST['id']);
            header('Location: equipo.php');
            break;

        case 'editar':
            $alm = $model->Obtener($_REQUEST['id']);
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>Equipos</title>
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
                <h1>Registrar Equipos</h1>
                <form action="?action=<?php echo $alm->id > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px; padding-left:200px;">
                    <input type="hidden" name="id" value="<?php echo $alm->__GET('id'); ?>" />

                    <table style="width:500px; padding-right: 100px">
                        <tr>
                            <th style="text-align:left;">Nombre</th>
                            <td><input type="text" name="nombre" value="<?php echo $alm->__GET('nombre'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Fecha</th>
                            <td><input type="text" name="fecha" value="<?php echo $alm->__GET('fecha'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">rama</th>
                            <td>
                                <select name="rama" style="width:100%;">
                                    <option value="damas" <?php echo $alm->__GET('rama') == 'damas' ? 'selected' : ''; ?>>femenino</option>
                                    <option value="varones" <?php echo $alm->__GET('rama') == 'varones' ? 'selected' : ''; ?>>masculino</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">color</th>
                            <td><input type="text" name="color" value="<?php echo $alm->__GET('color'); ?>" style="width:100%;" /></td>
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
                            <th style="text-align:left;">Nombre</th>
                            <th style="text-align:left;">Fecha</th>
                            <th style="text-align:left;">Rama</th>
                            <th style="text-align:left;">Color</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach ($model->Listar() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('nombre'); ?></td>
                            <td><?php echo $r->__GET('fecha'); ?></td>
                            <td><?php echo $r->__GET('rama') == 'damas' ? 'femenino' : 'masculino'; ?></td>
                            <td><?php echo $r->__GET('color'); ?></td>
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