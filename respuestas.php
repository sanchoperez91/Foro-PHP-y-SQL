<?php
session_start();

// Verifica si la sesión está iniciada y si 'ide_usu' está disponible
if (!isset($_SESSION['ide_usu'])) {
    header("Location: login.php"); // Redirige al login si no está logueado
    exit();
}

$ide_usu = $_SESSION['ide_usu'];  // Recupera el ide_usu de la sesión
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="Assets/js/motor.js" defer></script>
    <link rel="stylesheet" href="Assets/css/styleRespuestas.css"> 
</head>
<body class="bodyRespuestas">
    
    <div id="superior">
        <a href="main.php">
            <button id="botonVolver">Todos los post</button>
        </a>
        <label class="tituloRespuestas1">POST PRINCIPAL</label>
        <div class="contenedor-cerrar-sesion">
            <a href="logout.php" class="btn-cerrar-sesion">CERRAR SESION</a>
        </div>
    </div>
    <div id="contenedorPostRespuesta" class="contenedor2"></div>
    <label class="tituloRespuestas2">RESPUESTAS</label>
    <div id="contenedor2" class="contenedor2"></div>
    <div id="numRespuestas"></div> <!-- Div para mostrar el número de respuestas -->
    <form id="formularioRespuesta" action="#" method="POST">
        <div>
            <input type="hidden" id="ide_usu" required placeholder="ide_usu" name="ide_usu" value="<?php echo $ide_usu; ?>">
            <input type="hidden" id="ide_pos" required placeholder="ide_pos" name="ide_pos" value="<?php echo $_GET['ide_pos'];?>">  
        </div>
        <div id="contenedor3" class="contenedor3"> 
            <h1>Añadir nueva respuesta</h1>
            <textarea id="tex_res" name="tex_res" placeholder="Tu respuesta..."></textarea>
        </div>
        <div id="divbotonAñadirRespuesta" class="divBotonAñadir">
            <button type="submit" id="botonAñadirRespuesta" class="botonAñadir" name="botonAñadirRespuesta">Publicar</button>
        </div>
        <div id="divRespuesta"></div>
    </form>

</body>
</html>
