<?php

    class HomeController extends Controller{

        public function index(){
            $data = [
                'title' => 'Dashboard',
                'BASE_URL' => BASE_URL,
                'scriptPage' => 'Dashboard'
            ];
            $this->loadTemplate('Dashboard', $data);
        }
    }
?>