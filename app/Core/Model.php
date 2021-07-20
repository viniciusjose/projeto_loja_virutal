<?php

namespace MyApp\Core;

/**
 * Classe responsável por disponibilizar a conexão
 * ao banco de dados.
 */
class Model
{
    protected $db;

    /**
     * Função resgata a variável global com a conexão
     * do banco de dados e disponibiliza para todas
     * as classes que a estenderam.
     */
    public function __construct()
    {
        global $db;
        $this->db = $db;
    }
}
