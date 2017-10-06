<?php

require_once "./vendor/autoload.php";
require_once "./app.php";
require_once "./utils.php";

$json = json_decode(file_get_contents("./schedule.json"), true);
$app = new App($json);
$utils = new Utils();

$app->showSchedule();
$utils->showBr(2);

$app->showNextTasks(2);
