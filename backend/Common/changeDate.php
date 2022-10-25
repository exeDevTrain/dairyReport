<?php

declare(strict_types=1);

namespace Common;

final class ChangeDate
{
    public function __construct(private string $timestamp)
    {}

    private function chageYear(): string
    {
        return date('Y', strtotime($this->timestamp));
    }

    private function chageMonth(): string
    {
        return date('n', strtotime($this->timestamp));
    }

    private function chageDay(): string
    {
        return date('d', strtotime($this->timestamp));
    }

    private function changeWeekOfDay(): string
    {
        $week = ['日', '月', '火', '水', '木', '金', '土',];

        $day_of_week = $week[date('w', strtotime($this->timestamp))];

        return $day_of_week;
    }

    public function changeYearAndMonth(): string
    {
        return $this->chageYear() . "年" . $this->chageMonth() . "月";
    }

    public function changeDateAndDayOfWeek(): string
    {
        return $this->chageDay() . "(" . $this->changeWeekOfDay() . ")";
    }

    public function changeHourAndMinutes(): string
    {
        return date('H:i', strtotime($this->timestamp));
    }
}
