<?php
    class LogController extends Controller{
        public function index(){
            $data = [
                'page' => 'Logs do Sistema'
            ];
            $this->loadTemplate('Log', $data);
        }
    }
?>