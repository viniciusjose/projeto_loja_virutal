<?php
    namespace Core;
    /**
     * Classe responsável por requisitar a view selecionada pelo controller
     * e imprimir na tela para o usuário, utilizando o conceito de template. 
     */    
    class Controller{
        /**
         * Renderiza o template para o usuário
         *
         * Responsável pelo replace das informações tratadas pelo backend pelas
         * keys configuradas no html e renderizar o html para o usuário.
         *
         * @param String $viewName Nome da view à ser requisitada.
         * @param Array $var Dados a serem inseridos no html da view.
         **/
        public function loadTemplate($viewName, $viewData){
            extract($viewData);
            $html = file_get_contents('Views/Template.html');
            $viewData['loadView'] = $this->loadViewInTemplate($viewName, $viewData);
            //Substituição dos dados tratados pelo PHP por todas as chaves configuradas no HTML
            foreach($viewData as $key => $value){
                $html = str_replace('{'.$key.'}', $value, $html);
            }
            echo $html;
        }
         /**
         * Salva o html da view selecionada
         * 
         *
         * Salva o conteúdo da pagina view selecionada e retorna o conteúdo
         * para renderização dentro do template.
         *
         * @param String $viewName Nome da view à ser requisitada.
         * @param Array $var Dados a serem inseridos no html da view.
         * @var String $htmlView HTML da View selecionada.
         * @return String
         **/
        private function loadViewInTemplate($viewName, $viewData){
            $htmlView = file_get_contents('Views/'.$viewName.'.html');
            //Substituição dos dados tratados pelo PHP por todas as chaves configuradas no HTML
            foreach($viewData as $key => $value){
                $htmlView = str_replace('{'.$key.'}', $value, $htmlView);
            }
            return $htmlView;
        }
    }