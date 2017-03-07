<?php
require '../ENTIDAD/campeonato.entidad.php';
require '../MODELO/campeonato.Model.php';



// Logica
$camp = new Campeonato();
$model = new CampeonatoModel();


if (isset($_REQUEST['action'])) {
    switch ($_REQUEST['action']) {
        case 'actualizar':
            $camp->__SET('id', $_REQUEST['id']);
            $camp->__SET('nombre', $_REQUEST['nombre']);
            $camp->__SET('fechaInicio', $_REQUEST['fechaInicio']);
            $camp->__SET('fechaClausura', $_REQUEST['fechaClausura']);
            $camp->__SET('anio', $_REQUEST['anio']);
            $camp->__SET('categoria', $_REQUEST['categoria']);

            $model->ActualizarCamp($camp);
            header('Location: campeonato.php');
            break;

        case 'registrar':
            $camp->__SET('nombre', $_REQUEST['nombre']);
            $camp->__SET('fechaInicio', $_REQUEST['fechaInicio']);
            $camp->__SET('fechaClausura', $_REQUEST['fechaClausura']);
            $camp->__SET('anio', $_REQUEST['anio']);
            $camp->__SET('categoria', $_REQUEST['categoria']);

            $model->RegistrarCamp($camp);
            header('Location: campeonato.php');
            break;

        case 'eliminar':
            $model->EliminarCamp($_REQUEST['id']);
            header('Location: campeonato.php');
            break;

        case 'editar':
            $camp = $model->ObtenerCamp($_REQUEST['id']);
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>Campeonato</title>
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
                <h1>Campeonato</h1>
                <form action="?action=<?php echo $camp->id > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px; padding-left:200px">
                    <input type="hidden" name="id" value="<?php echo $camp->__GET('id'); ?>" />

                    <table style="width:500px;">
                        <tr>
                            <th style="text-align:left;">Nombre</th>
                            <td><input type="text" name="nombre" value="<?php echo $camp->__GET('nombre'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Fecha Inicio</th>
                            <td><input type="text" name="fechaInicio" value="<?php echo $camp->__GET('fechaInicio'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Fecha Clausura</th>
                            <td><input type="text" name="fechaClausura" value="<?php echo $camp->__GET('fechaClausura'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Anio</th>
                            <td><input type="number" name="anio" value="<?php echo $camp->__GET('anio'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Categoria</th>
                            <td>
                                <select name="categoria" style="width:100%;">
                                    <option value="damas" <?php echo $camp->__GET('categoria') == 'damas' ? 'selected' : ''; ?>>femenino</option>
                                    <option value="varones" <?php echo $camp->__GET('categoria') == 'varones' ? 'selected' : ''; ?>>masculino</option>
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
                            <th style="text-align:left;">Nombre</th>
                            <th style="text-align:left;">FechaInicio</th>
                            <th style="text-align:left;">FechaClausura</th>
                            <th style="text-align:left;">Anio</th>
                            <th style="text-align:left;">Categoria</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach ($model->ListarCamp() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('nombre'); ?></td>
                            <td><?php echo $r->__GET('fechaInicio'); ?></td>
                            <td><?php echo $r->__GET('fechaClausura'); ?></td>
                            <td><?php echo $r->__GET('anio'); ?></td>
                            <td><?php echo $r->__GET('categoria') == 'damas' ? 'femenino' : 'masculino'; ?></td>

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




