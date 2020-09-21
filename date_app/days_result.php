<?php
    function is_uruu($y) { //閏年か判定
        if ($y%4==0) {
            if ($y%100==0 && $y%400!=0) return false;
            return true;
        }
        return false;
    }

    function is_invalid($y, $m, $d) { //入力された日付が不正でないか確認
        if ($m==2) {
            if (is_uruu($y) && $d>=30) return true;
            elseif (!is_uruu($y) && $d>=29) return true;
        }
        elseif ($m==4 || $m==6 || $m==9 || $m==11) {
            if ($d==31) return true;
        }
        return false;
    }

    function calc($y1, $m1, $d1, $y2, $m2, $d2) { //日数計算
        $days = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        $serial = array_fill(0, 200, array_fill(0, 12, array_fill(0, 31, 0)));
        $c = 0;
        for ($y=1900; $y<2100; $y++) for ($m=1; $m<=12; $m++) {
            $dlim = $days[$m-1];
            if (is_uruu($y) && $m==2) $dlim++; //閏年分
            for ($d=1; $d<=$dlim; $d++) {
                $serial[$y-1900][$m-1][$d-1] = $c;
                $c++;
            }
        }
        return $serial[$y2-1900][$m2-1][$d2-1]-$serial[$y1-1900][$m1-1][$d1-1];
    }

    $year1 = $_REQUEST['year1'];
    $month1 = $_REQUEST['month1'];
    $day1 = $_REQUEST['day1'];
    $year2 = $_REQUEST['year2'];
    $month2 = $_REQUEST['month2'];
    $day2 = $_REQUEST['day2'];
    $error = false;

    if (is_invalid($year1, $month1, $day1) && !isset($message)) {
        $message = '開始日が不正な入力です';
        $error = true;
    }
    
    if (is_invalid($year2, $month2, $day2) && !isset($message)) {
        $message = '終了日が不正な入力です';
        $error = true;
    }

    $result = calc($year1, $month1, $day1, $year2, $month2, $day2);
    if ($result<0 && !isset($message)) {
        $message = '終了日は開始日以降でないといけません';
        $error = true;
    }
    
    if ($error) require_once('templates/error.tpl.php');
    else require_once('templates/days_result.tpl.php');