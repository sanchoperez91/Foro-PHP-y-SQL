<?php
session_start();
if (!isset($_SESSION['ide_usu'])) {
    header("Location: login.php"); // Redirige al login si la sesión no está iniciada
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Inserción</title>
    <link rel="stylesheet" href="Assets/css/stylePost.css">
    <script src="Assets/js/motor.js"></script>
    <script src="Assets/js/login.js" defer></script>
</head>
<body>
    <div class="contenedor0">
        <a href="main.php" class="btn-main">TODOS LOS POST</a>
        
        <div class="forminsercion">
            <div class="divTituloAñadir">
                <h2 class="tituloAñadir">Insertar Nuevo Post</h2>
            </div>

            <form action="#" method="POST" class="contDatosForm1" id="formularioPost">
            <input type="hidden" id="ide_usu" name="ide_usu" value="<?php echo isset($_SESSION['ide_usu']) ? htmlspecialchars($_SESSION['ide_usu']) : ''; ?>">



                <div class="contAñadir1">
                    <label for="tit_pos">Título:</label>
                    <input type="text" id="tit_pos" name="tit_pos" required>
                </div>

                <div class="contAñadir1">
                    <label for="tex_pos">Mensaje:</label>
                    <textarea id="tex_pos" name="tex_pos" rows="4" required></textarea>
                </div>

                <div class="divBotonAñadirPost">
                    <button type="submit" class="botonAñadir" id="botonAñadirPost">Enviar</button>
                </div>

                <div id="divRespuesta"></div>
            </form>
        </div>
    </div>
    <div class="contenedor-cerrar-sesion">
            <a href="logout.php" class="btn-cerrar-sesion">CERRAR SESION</a>
        </div>
</body>
</html>