<?php

require_once "./utils.php";

class App {

    function __construct($json) {
        $this->cron = $json["jobs"];
        $this->utils = new Utils();
    }

    function showSchedule() {
        echo "Current time: <b>" . date("Y-m-d H:i:s") . "</b> (" . date_default_timezone_get() .")";
        $this->utils->showBr(2);
        foreach ($this->cron as $job) {
            echo "<b>" . $job["time"] . "</b> " . $job["task"];
            $this->utils->showBr();
        }
    }

    function showNextTasks($count) {
        $schedule = [];
        foreach ($this->cron as $jobs) {
            $schedule = array_merge($schedule, $this->getAllDates($jobs["time"], $jobs["task"], $count));
        }
        $schedule = $this->utils->sortArrayByDate($schedule);

        for ($i = 0; $i < $count; $i++) {
            echo $schedule[$i]["time"] . " <b>" . $schedule[$i]["task"] . "</b>";
            $this->utils->showBr();
        }
    }

    function getAllDates($time, $task, $count) {
        $result = [];
        $cron = Cron\CronExpression::factory($time);
        foreach ($cron->getMultipleRunDates($count) as $date) {
            $result[] = [
                "time" => $date->format("Y-m-d H:i:s"),
                "task" => $task
            ];
        }
        return $result;
    }

};
