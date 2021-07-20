<?php

namespace MyApp\Core;

/**
 * Classe responsável pelo recebimento do
 * mod_rewrite da pagina e encaminhar as
 * requisições da URL para seus devidos
 * controllers.
 */
class Core
{
    /**
     * Define qual controller esta sendo requisitado no momento.
     *
     * Após que o usuário digita a URL, esta função resgata o valor
     * digitado através do rewrite e encaminha a requisição do usuário
     * para os controllers desejados.
     */
    public function run()
    {
        $url = '/';
        if (isset($_GET['url'])) {
            $url .= $_GET['url'];
        }
        $params = [];
        if (!empty($url) && $url != '/') {
            $url = explode('/', $url);
            array_shift($url);
            $currentController = ucfirst($url[0]) . 'Controller';
            array_shift($url);

            if (isset($url[0]) && !empty($url[0])) {
                $currentAction = $url[0];
                array_shift($url);
            } else {
                $currentAction = 'index';
            }
            if (count($url) > 0) {
                $params = $url;
            }
        } else {
            $currentController = 'HomeController';
            $currentAction = 'index';
        }
        $namespace = "\MyApp\Controller\\";
        if (!file_exists('Controller/' . $currentController . '.php') || !method_exists($namespace . $currentController, $currentAction)) {
            $currentController = 'NotFoundController';
            $currentAction = 'index';
        }
        $currentController = $namespace . $currentController;
        $controller = new $currentController();
        call_user_func_array(array($controller, $currentAction), $params);
    }
}
