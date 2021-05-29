<?php
    class NotFoundController extends Controller{
        public function index(){
            $data = [
                'title' => 'Not Found',
                'BASE_URL' => BASE_URL,
            ];
            $this->loadTemplate('Page404', array());
        }
    }