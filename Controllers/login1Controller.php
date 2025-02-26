<?php
session_start(); // Iniciar sesión
require_once '../Models/login1Model.php';

class LoginController {
    private $usuario;

    public function __construct() {
        $this->usuario = new Usuario();
    }

    public function confirmarLogin($email, $contra) {
        // Validar el email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("El email no es válido.");
        }

        // Validar la contraseña
        if (!preg_match('/^(?=.*\d)[A-Za-z\d]{5,20}$/', $contra)) {
            throw new Exception("La contraseña debe tener entre 5 y 20 caracteres y contener al menos un número.");
        }

        return $this->usuario->verificarUsuario($email, $contra);
    }
}

// Procesamiento de la solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../Db/con1Db.php'; // Asegúrate de que la ruta sea correcta

    $controller = new LoginController();
    $data = json_decode(file_get_contents('php://input'), true);
    $email = $data['email'];
    $contra = $data['contra'];

    error_log("email: $email, Contraseña: $contra"); // Mensaje de depuración

    try {
        $usuario = $controller->confirmarLogin($email, $contra);

        if ($usuario) {
            $_SESSION['email'] = $email; // Almacenar el email en la sesión
            $_SESSION['ide_usu'] = $usuario['ide_usu']; // Almacenar el ID del usuario en la sesión
            echo json_encode(['success' => true, 'ide_usu' => $usuario['ide_usu']]);
        } else {
            echo json_encode(['success' => false]);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}
?>