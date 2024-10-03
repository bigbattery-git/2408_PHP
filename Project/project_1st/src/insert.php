<?php
  require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
  require_once(MY_PATH_DB_LIB);

  $request = $_SERVER["REQUEST_METHOD"];

  if(strtoupper($request) === "POST"){
    try{
      $conn = my_db_conn();

      $arr_prepare = [
        "title" => $_POST["title"]
        ,"content" => $_POST["content"]
      ];

      $conn -> beginTransaction();

      my_board_insert($conn, $arr_prepare);

      $conn -> commit();

      header("Location: /");
      exit;
    }
    catch(throwable $th){
      $conn -> rollBack();

      require_once(MY_PATH_ERROR);

      exit;
    }
  }
?>


<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/insert.css">
    <title>작성 페이지</title>
</head>
<body>

  <?php 
    require_once(MY_PATH_ROOT."header.php") 
  ?>

  <main>
    <form action="/insert.php" method="post">
      <div class="box title-box">
        <div class="box-title">제목</div>
        <div class="box-content">
          <input  class="box-content" type="text" name="title" id="title">
        </div>
      </div>
      <div class="box content-box">
        <div class="box-title">내용</div>
        <div class="box-content">
          <textarea name="content" id="content"></textarea>
        </div>
      </div>
      <div class="main-footer">
        <button type="submit" class="btn-small">작성</button>
        <a href="/"><button type="button" class="btn-small">취소</button></a>
      </div>
    </form>
  </main>
</body>
</html>