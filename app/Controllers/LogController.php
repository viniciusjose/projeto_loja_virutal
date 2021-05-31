<?php
    namespace Controllers;

    use \Core\Controller;
    
    class LogController extends Controller
    {
        public function index()
        {
            $data = [
                'title' => 'Logs do Sistema',
                'BASE_URL' => BASE_URL,
            ];
            $this->loadTemplate('Log', $data);
        }
    }