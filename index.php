<?php

require_once './vendor/autoload.php';
require "./app.php";

$json = json_decode(file_get_contents("./schedule.json"), true);
$app = new App($json);

$app->showNextTasks(100);
