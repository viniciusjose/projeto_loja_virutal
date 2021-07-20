<?php

namespace MyApp\Model;

use MyApp\Core\Model;

/**
 * Classe com todos métodos de persistência de log ao
 *  banco de dados.
 */
class LogRepository extends Model
{
    /**
     * Método que realiza consulta a tabela de logs do sistema.
     *
     * Realiza a consulta ao banco de dados, para resgatar todos
     * os logs do sistema armazenados e os disponibiliza como
     * array para utilização.
     *
     * @return Array
     **/
    public function listLogs()
    {
        $sql = "SELECT * FROM log ORDER BY date_alter DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        }
    }
}
