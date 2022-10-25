<?php

namespace App\DailyReports\Controller;

use App\DailyReports\UseCase\GetAll;


require_once(dirname(__FILE__) . './../UseCase/GetAll.php');


final class dailyReportsController {
    public function getAll()
    {
        $getAll = new GetAll();

        return $getAll->execute();
    }
}