<?php

class App {

    function __construct($json) {
        $this->cron = $json['jobs'];
//        echo "<pre>" . print_r($json, true) . "</pre>";
    }

    function showBr($lines, $is_return = false) {
        $result = str_repeat("<br/>\n", $lines ? $lines : 1);
        if ($is_return) return $result;
        echo $result;
    }

    function showSchedule() {
        echo "Current time: <b>" . date("Y-m-d H:i:s") . "</b> (" . date_default_timezone_get() .")";
        $this->showBr(2);
        for ($i = 0; $i < count($this->cron); $i++) {
            echo "<b>" . $this->cron[$i]['time'] . "</b> " . $this->cron[$i]['task'] . "<br/>\n";
        }
    }

    function showNextTasks($count) {
        echo "showNextTasks: " . $count . "<br/>\n";
        echo "Number of schedules: " . count($this->cron) . $this->showBr(1, true);

        $schedule = [];
        foreach ($this->cron as $jobs) {
            $schedule = array_merge($schedule, $this->getAllDates($jobs['time'], $jobs['task'], $count));
        }

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
