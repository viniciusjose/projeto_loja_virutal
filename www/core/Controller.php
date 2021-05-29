<?php
    class Controller{

        public function loadTemplate($viewName, $viewData){
            extract($viewData);
            $html = file_get_contents('views/Template.html');
            $viewData['loadView'] = $this->loadViewInTemplate($viewName, $viewData);
            foreach($viewData as $key => $value){
                $html = str_replace('{'.$key.'}', $value, $html);
            }
            echo $html;
        }
        private function loadViewInTemplate($viewName, $viewData){
            $htmlView = file_get_contents('views/'.$viewName.'.html');
            foreach($viewData as $key => $value){
                $htmlView = str_replace('{'.$key.'}', $value, $htmlView);
            }
            return $htmlView;
        }
    }
?>