<?php

session_start();
require "Config/Config.php";
require __DIR__ . "/vendor/autoload.php";

$core = new Core\Core();
$core->run();
