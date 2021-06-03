<?php
    
namespace MyApp\Controller;

use MyApp\Core\Controller;

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