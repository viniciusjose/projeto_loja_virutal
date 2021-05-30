<?php
    namespace Controllers;
    use \Core\Controller;
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