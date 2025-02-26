

<?php
class Usuario {
    // Devuelve Datos (select)
    public function verificarUsuario($email, $contra) {
        // Conexión
        $mysqli = Conex1::con1();
        
        // Sentencia
        $stmt = $mysqli->prepare("SELECT ide_usu FROM usuarios WHERE ema_usu = ?  AND con_usu = ?");
        $stmt->bind_param("ss", $email, $contra); // 'ss' indica dos strings
        $stmt->execute();
        
        // Obtención del resultado
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        
        // Liberación del conjunto de resultados
        $result->free();
        // Cierre de la declaración
        $stmt->close();
        // Cierre de la conexión
        $mysqli->close();
        
        // Devolución del resultado
        return $data;
    }
}
?>