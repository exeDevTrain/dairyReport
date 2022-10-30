<?php
use App\DailyReports\Controller\dailyReportsController;

require_once('./App/DailyReports/Controller/dailyReportsController.php');

$controller = new dailyReportsController;
$data = $controller->fetchAll();

$year_month = $data['year_month'];
$dailyReports = $data['dailyReports'];
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="./App/DailyReports/css/daily_Reports.css">

    <script type="text/javascript" src="./App/DailyReports/js/daily_reports.js"></script>
    
    <title>日報一覧</title>
</head>

<body>
    <!-- ヘッダー -->
    <header class="p-3 bg-secondary text-white position-relative">
        <h1 class="position-absolute top-50 start-50 translate-middle">日報記録</h1>
        <div class="text-end">
            <button type="button" class="btn btn-outline-light me-2">Logout</button>
        </div>
    </header>

    <main class="container-fluid d-flex justify-content-center">
        <div class="w-75 d-flex justify-content-center position-relative">
            <!-- 年月を表示 -->
            <div class="container">
                <div class="row">
                    <div class="col d-flex justify-content-center align-items-center">
                        <button type="button" class="fs-2 previous-btn">&#9664;</button>
                        <h2 class="mx-5 mt-2">
                            <strong><?php echo $year_month; ?></strong>
                        </h2>
                        <button type="button" class="fs-2 next-btn">&#9654;</button>
                    </div>
                </div>

                <!-- 日報一覧 -->
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">日付</th>
                            <th scope="col">始業</th>
                            <th scope="col">終業</th>
                            <th scope="col">休憩</th>
                            <th scope="col">業務内容</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dailyReports as $dailyReport) : ?>
                            <tr>
                                <th scope="row"><?php echo $dailyReport['day_weekDay']; ?></th>
                                <td><?php echo $dailyReport['startTime']; ?></td>
                                <td><?php echo $dailyReport['endTime']; ?></td>
                                <td><?php echo $dailyReport['breakTime']; ?></td>
                                <td><?php echo $dailyReport['summary']; ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>

                <div class="container px-4 mb-4 position-absolute bottom-0 start-50 translate-middle-x">
                    <div class="w-100 gx-5">
                        <input type="button" class="btn btn-secondary w-100" onclick="is_start(this)" value="出勤">
                    </div>
                </div>

            </div>
        </div>
    </main>
</body>
</html>