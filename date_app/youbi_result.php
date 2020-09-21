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

    $year = $_REQUEST['year'];
    $month = $_REQUEST['month'];
    $day = $_REQUEST['day'];
    $error = false;

    if (is_invalid($year, $month, $day)) {
        $message = '不正な入力です';
        $error = true;
    }

    //1900年1月1日は月曜日
    $r = calc(1900, 1, 1, $year, $month, $day)%7;
    $a = ['月', '火', '水', '木', '金', '土', '日'];
    $result = $a[$r];

    if ($error) require_once('templates/error.tpl.php');
    else require_once('templates/youbi_result.tpl.php');