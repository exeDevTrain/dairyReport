<?php

namespace App\DailyReports\Common;

final class OutputDate {

    public function year_Month(string $timestamp): string
    {
        return $this->chageYear($timestamp) . "年" . $this->chageMonth($timestamp) . "月";
    }

    public function day_WeekDay(string $timestamp): string
    {
        return $this->chageDay($timestamp) . "(" . $this->changeWeekDay($timestamp) . ")";
    }

    public function hour_Minutes(string $timestamp): string
    {
        return date('H:i', strtotime($timestamp));
    }

    /* private */

    private function chageYear(string $timestamp): string
    {
        return date('Y', strtotime($timestamp));
    }

    private function chageMonth(string $timestamp): string
    {
        return date('n', strtotime($timestamp));
    }

    private function chageDay(string $timestamp): string
    {
        return date('d', strtotime($timestamp));
    }

    private function changeWeekDay(string $timestamp): string
    {
        $week = ['日', '月', '火', '水', '木', '金', '土',];

        return $week[date('w', strtotime($timestamp))];

    }
}