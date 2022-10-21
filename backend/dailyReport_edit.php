<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>日報編集ページ</title>
</head>

<!-- ヘッダー（ナビゲーション） -->
<header class="px-3 bg-secondary text-white position-relative">
<div class="container">
<nav class="navbar">
  <button type="button" class="btn btn-outline-light">社員登録</button>
  <h1 class="position-absolute top-50 start-50 translate-middle">日報編集</h1>
  <div class="px-3 text-end"><a class="text-white text-decoration-none" href="">ログアウト</a></div>
  </nav>
</div>
</header>

<body>
<div class="container">

<div class="d-flex justify-content-center p-3 mt-4">
  <h2>1200034 田中太郎</h2>
</div>

<div class="col d-flex justify-content-center">
  <button type="button" class="btn btn-light previous-btn">&#9664;</button>
  <h2>2022年 10月</h2>
  <button type="button" class="btn btn-light next-btn">&#9654;</button>
</div>

<table class="table mb-4">
  <thead>
    <tr>
      <th scope="col">日付</th>
      <th scope="col">始業</th>
      <th scope="col">終業</th>
      <th scope="col">休憩（分）</th>
      <th scope="col">業務内容</th>
      <th scope="col">操作</th>
    </tr>
  </thead>
  <tbody>
      <tr>
        <th scope="row">3(月)</th>
        <td><input type="text" value="09:00" readonly></td>
        <td><input type="text" value="18:00" readonly></td>
        <td><input type="text" value="60" readonly></td>
        <td><textarea rows="1" style="min-width: 100%" readonly>システム保守の効率化のため、保守性の向上に努めました。積極的にシステムのアップデートや改善、細かいエラーのデバッグと解決に取り組むことで、保守担当エンジニアの業務改善に貢献。</textarea></td>
        <td><button type="button" class="btn btn-danger">編集</button></td>
      </tr>
      <tr>
        <th scope="row">4(火)</th>
        <td><input type="text" value="08:30" readonly></td>
        <td><input type="text" value="17:30" readonly></td>
        <td><input type="text" value="60" readonly></td>
        <td><textarea rows="1" style="min-width: 100%" readonly>バグを発見し…</textarea></td>
        <td><button type="button" class="btn btn-danger">編集</button></td>
      </tr>
      <tr>
      <th scope="row">5(水)</th>
        <td><input type="text" value="09:00" readonly></td>
        <td><input type="text" value="18:00" readonly></td>
        <td><input type="text" value="60" readonly></td>
        <td><textarea rows="1" style="min-width: 100%" readonly>単体テストの項目を作成し…</textarea></td>
        <td><button type="button" class="btn btn-danger">編集</button></td>
      </tr>
      </tbody>
</table>

<table class="table mb-4">
  <thead></thead>
    <tr>
      <th scope="col">日付</th>
      <th scope="col">始業</th>
      <th scope="col">終業</th>
      <th scope="col">休憩（分）</th>
      <th scope="col">業務内容</th>
    </tr>
  </thead>
  <tbody>
      <tr>
        <th scope="row">3(月)</th>
        <td><input type="time" value="09:00"></td>
        <td><input type="time" value="18:00"></td>
        <td><input type="number" value="60" min="0" step="30"></td>
        <td><textarea rows="5" style="min-width: 100%">システム保守の効率化のため、保守性の向上に努めました。積極的にシステムのアップデートや改善、細かいエラーのデバッグと解決に取り組むことで、保守担当エンジニアの業務改善に貢献。</textarea></td>
      </tr>
      </tbody>
</table>

<div class="d-grid gap-2 col-3 mx-auto d-flex justify-content-between">
  <button class="btn btn-secondary fs-5 px-4 edit-btn" type="button">編集する</button>
  <button class="btn btn-secondary fs-5 px-4 delete-btn" type="button">削除する</button>
</div>

</div><!-- .container -->
</body>
</html>