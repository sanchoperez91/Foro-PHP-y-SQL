<?php
session_start();
if (!isset($_SESSION['ide_usu'])) {
    header("Location: login.php"); // Redirige al login si la sesión no está iniciada
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <script src="Assets/js/motor.js" defer></script>
        <script>
            // Redirige a post.php y respuestas.php con el parámetro ide_usu
            window.location.href = `post.php?ide_usu=<?php echo $ide_usu; ?>`;
            setTimeout(function() {
                window.location.href = `respuestas.php?ide_usu=<?php echo $ide_usu; ?>`;
            }, 1000);  // Ajusta el tiempo según lo necesites
        </script>
        <link rel="stylesheet" href="Assets/css/styleRespuestas.css"> 
    </head>
    <body class="bodyMain">
        <input type="hidden" id="ide_usu" name="ide_usu" value="<?php echo isset($_SESSION['ide_usu']) ? htmlspecialchars($_SESSION['ide_usu']) : ''; ?>">
        <label class="tituloRespuestas1">POST PRINCIPAL</label>
        <div id="contenedor2" class="contenedor2" > </div>
        
        <div class="contenedor-boton">
            <a href="post.php" ><button class="btn-nuevo-post">Añadir nuevo post</button></a>
        </div>
        <div class="contenedor-cerrar-sesion">
            <a href="logout.php" class="btn-cerrar-sesion">CERRAR SESION</a>
        </div>
    </body>
</html>