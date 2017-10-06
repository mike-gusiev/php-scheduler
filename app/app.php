<?php

class App {

    function __construct($json) {
        $this->lastRun = $json["lastRun"] ? $json["lastRun"] : false;
        $this->cron = $json["jobs"];
    }

    function show_schedule() {
        echo "Current time: <b>" . date("Y-m-d H:i:s") . "</b> (" . date_default_timezone_get() .")";
        if ($this->lastRun) {
            Utils::show_br();
            echo "Last run: <b>" . $this->lastRun . "</b>";
        }
        Utils::show_br(2);
        foreach ($this->cron as $job) {
            echo "<b>" . $job["time"] . "</b> " . $job["task"];
            Utils::show_br();
        }
    }

    function show_next_tasks($count) {
        $schedule = [];
        foreach ($this->cron as $jobs) {
            $schedule = array_merge($schedule, $this->get_all_dates($jobs["time"], $jobs["task"], $count));
        }
        $schedule = Utils::sort_array_by_date($schedule);

        for ($i = 0; $i < $count; $i++) {
            echo $schedule[$i]["time"] . " <b>" . $schedule[$i]["task"] . "</b>";
            Utils::show_br();
        }
    }

    function get_all_dates($time, $task, $count) {
        $result = [];
        $cron = Cron\CronExpression::factory($time);
        $fromTime = $this->lastRun ? $this->lastRun : 'now';
        foreach ($cron->getMultipleRunDates($count, $fromTime) as $date) {
            $result[] = [
                "time" => $date->format("Y-m-d H:i:s"),
                "task" => $task
            ];
        }
        return $result;
    }

};
