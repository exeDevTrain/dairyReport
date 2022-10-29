<?php

namespace App\DailyReports\UseCase;

use App\DailyReports\Common\OutputDate;

require_once(__DIR__ . './../Common/OutputDate.php');


final class FetchAllDto {
    public function __construct(private array $result)
    {}

    public function process() {
        $processedResult = array_map(function ($value) {
            $outputDate = new OutputDate();

            $day_weekDay = $outputDate->day_WeekDay($value['created_at']);
            $startTime = $outputDate->hour_Minutes($value['start_time']);
            $endTime = $outputDate->hour_Minutes($value[('end_time')]);

            return [
                    'day_weekDay' => $day_weekDay,
                    'startTime' => $startTime,
                    'endTime' => $endTime,
                    'breakTime' => $value['break'],
                    'summary' => $value['summary']
                ];
            
        }, $this->result);

        $outputDate = new OutputDate();

        return [
            'year_month' => $outputDate->year_Month(date('Y-n')),
            'dailyReports' => $processedResult
        ];
    }
}