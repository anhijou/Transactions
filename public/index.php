<?php

phpinfo();
include __DIR__ . "/../src/App/function.php";
$app = include __DIR__ . "/../src/App/bootstrap.php";

$app->run();
