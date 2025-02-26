<?php
require_once "../Db/Con1Db.php"; // Asegúrate de incluir la clase de conexión

class PostModel {
    private $mysqli;

    public function __construct() {
        // Usamos la conexión existente
        $this->mysqli = Conex1::con1();
    }

    /**
     * Obtiene un post por su ID.
     * @param int $ide_pos ID del post.
     * @return array|null Datos del post o null si no se encuentra.
     */
    public function getPostById($ide_pos) {
        $query = "SELECT * FROM posts WHERE ide_pos = ?";
        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param("i", $ide_pos);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); // Devuelve un array asociativo o null
    }

    /**
     * Elimina un post por su ID.
     * @param int $ide_pos ID del post.
     * @return bool True si se eliminó correctamente, False en caso contrario.
     */
    public function deletePost($ide_pos) {
        $query = "DELETE FROM posts WHERE ide_pos = ?";
        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param("i", $ide_pos);
        return $stmt->execute(); // Devuelve true si se ejecutó correctamente
    }
    public function updatePost($ide_pos, $tit_pos, $tex_pos, $ide_usu) {
        $query = "UPDATE posts SET tit_pos = ?, tex_pos = ? WHERE ide_pos = ? AND ide_usu = ?";
        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param("ssii", $tit_pos, $tex_pos, $ide_pos, $ide_usu);
        return $stmt->execute() && $stmt->affected_rows > 0; 
    }
    
    
}