<?php
    class NotFoundController extends Controller{
        public function index(){
            $this->loadTemplate('Page404', array());
        }
    }