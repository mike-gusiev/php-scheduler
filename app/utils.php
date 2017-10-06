<?php

function date_compare($a, $b) {
    $t1 = strtotime($a["time"]);
    $t2 = strtotime($b["time"]);
    return $t1 - $t2;
}

class Utils {

    public static function showBr($lines = 1, $is_return = false) {
        $result = str_repeat("<br/>\n", $lines);
        if ($is_return) return $result;
        echo $result;
    }

    public static function sortArrayByDate($arr) {
        $result = $arr;
        usort($result, "date_compare");
        return $result;
    }

}
