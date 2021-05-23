<?php
    require 'environment.php';
    $config = array();
    if(ENVIRONMENT == 'development'){
        /*
        * Configuração padrão de conexão para
        */
        define("BASE_URL", "http://localhost:8000/");//URL padrão para utilização em localhost.
        $config['db_driver'] = 'mysql';
        $config['dbname'] = 'projeto_webjump';
        $config['host'] = 'db';
        $config['dbuser'] = 'webjump';
        $config['dbpass'] = '676247307f67b84210663f19ff9878cd';
    }else{
        /*Para configuração do banco de dados de seu provedor preencha
        * conforme seus dados de provedor.
        */
        define("BASE_URL", "");//Definir URL do seu site.
        $config['db_driver'] = 'mysql';
        $config['dbname'] = '';
        $config['host'] = '';
        $config['dbuser'] = '';
        $config['dbpass'] = '';
    }
    global $db;
    try{
        $db = new PDO($config['db_driver'].":dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass']);
    }catch(PDOException $e){
        echo "Erro de conexão ao banco de dados <br>".$e->getMessage();
    }
?> 