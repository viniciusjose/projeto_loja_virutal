<?php
    namespace MyApp\Core;
    
    class Model
    {

        protected $db;
        
        public function __construct(){
            global $db;
            $this->db = $db;
        }
    }