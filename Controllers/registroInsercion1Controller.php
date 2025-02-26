<?php

// Configurar el encabezado de respuesta como JSON
header('Content-Type: application/json');

try {
    // Obtener los datos del formulario
    $nom_usu = $_POST['nom_usu'] ?? null;
    $ema_usu = $_POST['ema_usu'] ?? null;
    $con_usu = $_POST['con_usu'] ?? null;

    // Validar que los datos no estén vacíos
    if (!$nom_usu || !$ema_usu || !$con_usu) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    // Validar el nombre de usuario
    if (!preg_match('/^[A-Za-z0-9!@#$%^&*(),.?":{}|<>]{5,20}$/', $nom_usu) || preg_match('/^\d/', $nom_usu)) {
        throw new Exception("El nombre de usuario debe tener entre 5 y 20 caracteres y no comenzar con un número.");
    }

    // Validar el email
    if (!filter_var($ema_usu, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("El email no es válido.");
    }

    // Validar la contraseña
    if (!preg_match('/^(?=.*\d)[A-Za-z\d]{5,20}$/', $con_usu)) {
        throw new Exception("La contraseña debe tener entre 5 y 20 caracteres y contener al menos un número.");
    }

    // Incluir el modelo y crear una instancia
    require_once "../Models/insercion1Model.php";
    $obj1 = new Datos();

    // Definir la instrucción SQL y los tipos de parámetros
    $sql1 = "INSERT INTO usuarios (nom_usu, con_usu, ema_usu) VALUES (?, ?, ?)";
    $typeParameters = "sss";

    // Llamar al método del modelo para insertar los datos
    $data1 = $obj1->insertData($sql1, $typeParameters, $nom_usu, $con_usu, $ema_usu);

    // Enviar la respuesta como JSON
    echo json_encode($data1);

} catch (Exception $e) {
    // Manejo de excepciones y respuesta de error en JSON
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

?>

