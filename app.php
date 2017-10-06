<?php

class App {

    function __construct($json) {
        $this->cron = $json['jobs'];
//        echo "<pre>" . print_r($json, true) . "</pre>";
    }

    function showBr($lines) {
        echo str_repeat("<br/>\n", $lines ? $lines : 1);
    }

    function showSchedule() {
        for ($i = 0; $i < count($this->cron); $i++) {
            echo "<b>" . $this->cron[$i]['time'] . "</b> " . $this->cron[$i]['task'] . "<br/>\n";
        }
    }

    function showNextTasks($count) {
        echo "showNextTasks: " . $count . "<br/>\n";
        echo "Number of schedules: " . count($this->cron) . "<br/>\n";
    }

};
