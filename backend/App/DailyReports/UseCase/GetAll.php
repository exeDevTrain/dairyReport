<?php

namespace App\DailyReports\UseCase;

use App\DailyReports\Repository\DailyReportsRepository;
use App\DailyReports\UseCase\GetAllDto;

require_once(dirname(__FILE__) . '/GetAllDto.php');
require_once(dirname(__FILE__) . '/../Repository/DailyReportsRepository.php');


final class GetAll {
    public function execute()
    {
        $mysql = new DailyReportsRepository();
        
        $getAll = new GetAllDto($mysql->getAll());

        return $getAll->process();
    }
}