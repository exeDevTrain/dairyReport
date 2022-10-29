<?php

namespace App\DailyReports\UseCase;

use App\DailyReports\Repository\DailyReportsRepository;
use App\DailyReports\UseCase\FetchAllDto;

require_once(__DIR__ . '/FetchAllDto.php');
require_once(__DIR__ . '/../Repository/DailyReportsRepository.php');


final class FetchAll {
    public function execute()
    {
        $mysql = new DailyReportsRepository();
        
        $fetchAll = new FetchAllDto($mysql->fetchAll());

        return $fetchAll->process();
    }
}