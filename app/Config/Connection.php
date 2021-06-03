<?php

$conf = parse_ini_file("conf.ini");

define("BASE_URL", $conf['base_url']);
$user = isset($conf['user']) ? $conf['user'] : null;
$pass = isset($conf['pass']) ? $conf['pass'] : null;
$name = isset($conf['name']) ? $conf['name'] : null;
$host = isset($conf['host']) ? $conf['host'] : null;
$type = isset($conf['type']) ? $conf['type'] : null;

global $db;

switch ($type){

    case 'pgsql':
        $port = isset($db['port']) ? $db['port'] : '5432';
        $db = new PDO("pgsql:dbname={$name}; user={$user}; password={$pass}; host={$host}; port={$port}");
        break;
    case 'mysql':
        $port = isset($db['port']) ? $db['port'] : '3306';
        $db = new PDO("mysql:host={$host};port={$port};dbname={$name}", $user, $pass);
        break;
    case 'sqlite':
        $db = new PDO("sqlite:{$name}");
        break;
}

