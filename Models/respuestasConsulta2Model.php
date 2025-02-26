<?php
class Datos
{

    // Devuelve Datos (select)
    public function getData1($sql, $numero)
    {
        // Conexión
        $mysqli = Conex1::con1();
        
        // Sentencia
        $statement = $mysqli->prepare($sql);

        // Enlazar el parámetro
        $statement->bind_param('i', $numero);
        
        // Parámetros (ejemplo: si = string integer)
        $statement->execute();
        // Obtención del resultado
        $result = $statement->get_result();
        // Obtención del numero de registros devueltos
        $data = [];

        if($result->num_rows >= 1) {
            // Obtención de los datos
            while ($row = $result->fetch_assoc()) {
                $data[] = [
                    'nom_usu' => $row['nom_usu'],
                    'tit_pos' => $row['tit_pos'],
                    'tex_pos' => $row['tex_pos'],
                ];
            }
        }

        // Liberación del conjunto de resultados
        $result->free();
        // Cierre de la declaración
        $statement->close();
        // Cierre de la conexión
        $mysqli->close();

        // Devolución del resultado
        return $data;
    }
    
}
?>
