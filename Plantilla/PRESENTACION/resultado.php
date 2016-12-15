<?php
require '../ENTIDAD/resultado.entidad.php';
require '../MODELO/resultado.Model.php';




// Logica
$res = new Resultado();
$model = new ResultadoModel();


?>

<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>Resultado</title>
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
                <h1>Tabla de Resultado</h1>
                <table class="pure-table pure-table-horizontal" style="color: white">
                    <thead>
                        <tr>
                            <th style="text-align:left;">Tiros</th>
                            <th style="text-align:left;">Defensivo</th>
                            <th style="text-align:left;">Ofensivo</th>
                            <th style="text-align:left;">libres</th>
                            <th style="text-align:left;">faltas</th>
                            <th style="text-align:left;">controlB</th>
                             <th style="text-align:left;">jugador</th>
                            <th style="text-align:left;">partido</th>
                            <th style="text-align:left;">estadistica</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach ($model->Listar() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('tiro'); ?></td>
                            <td><?php echo $r->__GET('defensivo'); ?></td>
                            <td><?php echo $r->__GET('ofensivo') ?></td>
                            <td><?php echo $r->__GET('libres'); ?></td>
                            <td><?php echo $r->__GET('faltas'); ?></td>
                            <td><?php echo $r->__GET('controlB'); ?></td>
                            <td><?php echo $r->__GET('jugador'); ?></td>
                            <td><?php echo $r->__GET('partido'); ?></td>
                            <td><?php echo $r->__GET('estadistica'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </section>
        </div>
    </body>
</html>