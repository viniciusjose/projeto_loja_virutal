<?php

    session_start();

    require __DIR__ . "/vendor/autoload.php";

    use MyApp\Core\Core;

    $core = new Core();
    $core->run();
