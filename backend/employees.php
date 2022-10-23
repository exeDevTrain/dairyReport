<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Document</title>

</head>

<!-- ヘッダー（ナビゲーション） -->
<header class="px-3 bg-secondary text-white position-relative">
<div class="container">
<nav class="navbar">
  <button type="button" class="btn btn-outline-light">社員日報一覧</button>
  <h1 class="position-absolute top-50 start-50 translate-middle">社員一覧</h1>
  <div class="px-3 text-end"><a class="text-white" href="">ログアウト</a></div>
  </nav>
</div>
</header>

<body>
<div class="container">
<table class="table">
  <thead>
    <tr>
      <th width="40%" scope="col">ID</th>
      <th width="40%" scope="col">名前</th>
      <th width="10%" scope="col">選択</th>
      <th width="10%" scope="col">削除</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1100007</th>
      <th scope="row">佐藤えいじ</th>
      <td><button type="button" class="btn btn-success">選択</button></td>
      <td><button type="button" class="btn btn-danger">削除</button></td>
    </tr>
    <tr>
      <th scope="row">1200001</th>
      <th scope="row">山田花子</th>
      <td><button type="button" class="btn btn-success">選択</button></td>
      <td><button type="button" class="btn btn-danger">削除</button></td>
    </tr>
    <tr>
      <th scope="row">1200034</th>
      <th scope="row">田中太郎</th>
      <td><button type="button" class="btn btn-success">選択</button></td>
      <td><button type="button" class="btn btn-danger">削除</button></td>
    </tr>
  </tbody>
</div> <!-- .container -->
</body>
</html>