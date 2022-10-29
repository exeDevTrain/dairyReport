<?php

function __construct(string $timestamp) {
}

function chageYear($timestamp): string {
    return date('Y', strtotime($timestamp));
}

function chageMonth($timestamp): string {
    return date('n', strtotime($timestamp));
}

function chageDay($timestamp): string {
    return date('d', strtotime($timestamp));
}

function changeWeekOfDay($timestamp): string {
    $week = ['日', '月', '火', '水', '木', '金', '土',];
    $day_of_week = $week[date('w', strtotime($timestamp))];
    return $day_of_week;
}

function changeYearAndMonth($timestamp): string {
    return chageYear($timestamp) . "年" . chageMonth($timestamp) . "月";
}

function changeDateAndDayOfWeek($timestamp): string {
    return chageDay($timestamp) . "(" . changeWeekOfDay($timestamp) . ")";
}

function changeHourAndMinutes($timestamp): string {
    return date('H:i', strtotime($timestamp));
}

?>