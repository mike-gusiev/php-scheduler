<?php

require_once "./vendor/autoload.php";
require_once "./app/app.php";
require_once "./app/utils.php";

$json = json_decode(file_get_contents("./schedule.json"), true);
$app = new App($json);

$app->showSchedule();
Utils::showBr(2);

$app->showNextTasks(100);
