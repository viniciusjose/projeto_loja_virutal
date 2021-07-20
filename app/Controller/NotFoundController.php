<?php

namespace MyApp\Controller;

use MyApp\Core\Controller;

/**
 * Classe responsável em encaminhar o usuário para pagina de erro 404.
 *
 * Para evitar que o usuário ao digitar uma URL invalida quebre a aplicação
 * esta classe recebe o tratamento da URL do arquivo Core.php e realiza
 * a renderização de uma tela de erro amigável para o usuário.
 *
 */
class NotFoundController extends Controller
{
    /**
     * Método de renderização da página erro 404.
     *
     * Responsável por requisitar para a camada view o conteúdo a ser exibido
     * na tela de erro 404 do sistema.
     *
     **/
    public function index()
    {
        $data = [
            'title' => 'Not Found',
            'BASE_URL' => BASE_URL,
        ];
        $this->loadTemplate('Page404', $data);
    }
}
