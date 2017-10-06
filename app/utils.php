<?php

class Utils {

    public static function show_br($lines = 1, $is_return = false) {
        $result = str_repeat("<br/>\n", $lines);
        if ($is_return) return $result;
        echo $result;
    }

    public static function sort_array_by_date($arr) {
        $result = $arr;
        usort($result, "Utils::date_compare");
        return $result;
    }

    public static function date_compare($a, $b) {
        $t1 = strtotime($a["time"]);
        $t2 = strtotime($b["time"]);
        return $t1 - $t2;
    }

}
