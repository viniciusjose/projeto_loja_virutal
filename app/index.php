<?php

session_start();
require __DIR__."/vendor/autoload.php";

$core = new Core\Core();
$core->run();
