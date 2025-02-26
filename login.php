<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="Assets/css/styleLogin.css"> 
    <script src="Assets/js/login.js"></script>
</head>
<body>
    <div id="cont1" class="cont1">
        <div id="contCuadroRegistro" class="contRegistro">
            <div id="tituloRegistro">BIENVENIDO</div>
            
            <div id="contRegistro">
                <div id="iconoRegistro">
                    <img id="imgUsuario1" src="Assets/img/usuario1.png"/>
                </div>
                <form id="formRegistro">
                    <div id="contUsuario">
                        <div id="imgUsuario"><img src="Assets/img/email.png"/></div>
                        <div id="inputUsuario"><input id="inputEmail" name="inputEmail" type="text" placeholder="Introduzca Email"></div>
                    </div>
                    <div id="contContraseña">
                        <div id="imgContraseña"><img src="Assets/img/pass.png"/></div>
                        <div id="inputContraseña"><input id="inputContra" name="inputContra" type="password" placeholder="Introduzca contraseña"></div>
                    </div>
                    <div id="botonInicio">
                        <button type="submit" id="botonRegistro">Entrar</button>
                    </div>
                </form>
                
                <!-- Nuevo botón de registro -->
                <div id="botonRegistroNuevo">
                    <a href="registro.php"><button id="botonNuevoUsuario">Registrar Nuevo Usuario</button></a>
                </div>

            </div>
        </div>
    </div>
</body>
</html>