<?php

require_once "./utils.php";

class App {

    function __construct($json) {
        $this->cron = $json['jobs'];
        $this->utils = new Utils();
    }

    function showSchedule() {
        echo "Current time: <b>" . date("Y-m-d H:i:s") . "</b> (" . date_default_timezone_get() .")";
        $this->utils->showBr(2);
        for ($i = 0; $i < count($this->cron); $i++) {
            echo "<b>" . $this->cron[$i]['time'] . "</b> " . $this->cron[$i]['task'];
            $this->utils->showBr();
        }
    }

    function showNextTasks($count) {
        echo "showNextTasks: " . $count . "<br/>\n";
        echo "Number of schedules: " . count($this->cron);
        $this->utils->showBr();

        $schedule = [];
        foreach ($this->cron as $jobs) {
            $schedule = array_merge($schedule, $this->getAllDates($jobs['time'], $jobs['task'], $count));
        }
        $schedule = $this->utils->sortArrayByDate($schedule);


        echo '<pre>' . print_r($schedule, true) . '</pre>';
    }

    function getAllDates($time, $task, $count) {
        $result = [];
        $cron = Cron\CronExpression::factory($time);
        foreach ($cron->getMultipleRunDates($count) as $date) {
            $result[] = [
                "time" => $date->format('Y-m-d H:i:s'),
                "task" => $task
            ];
        }
        return $result;
    }

};
