<?php

class App {

    function __construct($json) {
        $this->cron = $json['jobs'];
//        echo "<pre>" . print_r($json, true) . "</pre>";
    }

    function showNextTasks($count) {
        echo "showNextTasks: " . $count . "<br/>\n";
        echo "Number of schedules: " . count($this->cron) . "<br/>\n";
    }

};
