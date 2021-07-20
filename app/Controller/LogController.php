<?php

namespace MyApp\Controller;

use MyApp\Core\Controller;
use MyApp\Model\LogRepository;

/**
 * Classe responsável por todas as requisições de log do sistema
 */
class LogController extends Controller
{
    /**
     * Função de requisição e renderização da pagina de logs do sistema.
     *
     * Realiza a renderização da pagina de logs com as informações
     * necessárias para o seu bom funcionamento.
     *
     **/
    public function index()
    {
        $data = [
            'title' => 'Logs do Sistema',
            'BASE_URL' => BASE_URL,
            'scriptPage'      => 'logs'
        ];
        $this->loadTemplate('Log', $data);
    }

    /**
     * Método de renderização da página de Logs
     *
     * Responsável por requisitar para a camada view o conteúdo a ser exibido
     * na tela de Logs do sistema.
     *
     **/
    public function showLogs()
    {
        $logRepository = new LogRepository();
        echo json_encode($logRepository->listLogs());
    }
}
