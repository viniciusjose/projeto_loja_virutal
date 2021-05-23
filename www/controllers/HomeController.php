<?php

    class HomeController extends Controller{

        public function index(){
            $data = [
                'page' => 'Dashboard'
            ];
            $this->loadTemplate('Dashboard', $data);
        }
    }
?>