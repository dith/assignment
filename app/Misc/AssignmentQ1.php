<?php

namespace App\Misc;

class AssignmentQ1 {

    /*
     * $dir     directory to scan
     * $date    target date to grep, in 'DD-MM-YYYY' format
     **/
    public static function getDetailsOnly($dir, $date)
    {
        $date = date('ymd', strtotime($date));
        $files = scandir($dir);

        $pattern = '/^.+D' . $date . '(?:[01][0-9]|[2][0-3])[0-5][0-9]\.csv$/';
        $result = array_values(preg_grep($pattern, $files));

        return $result;
    }
}
