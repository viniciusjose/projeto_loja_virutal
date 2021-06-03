<?php
    
namespace MyApp\Controller;

use MyApp\Core\Controller;
/**
 * Classe responsável por todas as requisições de log do sistema
 */
class NotFoundController extends Controller
{
    /**
     * Método de renderização da página de Logs
     *
     * Responsável por requisitar para a camada view o conteúdo a ser exibido
     * na tela de Logs do sistema.
     *
     * @var Array $data Informações que serão inseridas na view Log.html
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