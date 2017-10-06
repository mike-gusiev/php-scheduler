<?php

class App {

    function __construct($json) {
        $this->cron = $json['jobs'];
//        echo "<pre>" . print_r($json, true) . "</pre>";
    }

    function showBr($lines, $is_return) {
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
        echo "Number of schedules: " . count($this->cron) . "<br/>\n";

        $cron = Cron\CronExpression::factory($this->cron[0]['time']);

        echo $cron->getNextRunDate()->format('Y-m-d H:i:s') . $this->showBr(1,true);
        echo $cron->getNextRunDate(null, 1)->format('Y-m-d H:i:s') . $this->showBr(1,true);
    }

};
