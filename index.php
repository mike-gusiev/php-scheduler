<?php

require_once "./vendor/autoload.php";
require_once "./app/app.php";
require_once "./app/utils.php";

$json = json_decode(file_get_contents("./schedule.json"), true);
$app = new App($json);

$app->show_schedule();
Utils::show_br(2);

$app->show_next_tasks(100);
