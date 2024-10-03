<?php

  require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
  require_once(MY_PATH_DB_LIB);


  $conn = null;
  try{
    if(strtoupper($_SERVER["REQUEST_METHOD"]) === "GET"){
      $conn = my_db_conn();
      $id = isset($_GET["id"]) ? $_GET["id"] : 0;
      $page = isset($_GET["page"]) ? $_GET["page"] : 1;
      $arr_prepare = [
        "id" => $id
      ];

      if($id < 1){
        throw new Exception("파라미터 오류");
      }

      $result = my_board_select_id($conn, $arr_prepare);
    }
    else{
      $conn = my_db_conn();
      $id = isset($_POST["id"]) ? $_POST["id"] : 0;
      $arr_prepare =[
        "id" => $id
      ];

      if($id < 1){
        throw new Exception("파라미터 오류");
      }

      $conn -> beginTransaction();

      my_board_delete_id($conn, $arr_prepare);

      $conn -> commit();
      header("Location: /");
      exit;
    }
  }
  catch(Throwable $th){
    if(!is_null($conn) && $conn->inTransaction()){
      $conn -> rollback();
    }

    require_once(MY_PATH_ERROR);
    exit;
  }
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/delete.css">
    <title>삭제 페이지</title>
</head>
<body>
  <?php
    require_once(MY_PATH_ROOT."header.php");
  ?>
  <main>
    <div class="main-header">
      <p>삭제하면 영구적으로 복구할 수 없습니다.</p>
      <p>정말로 삭제하시겠습니까?</p>                
    </div>
    <div class="main-content">
      <div class="box">
        <div class="box-title">게시글 번호</div>
        <div class="box-content"><?php echo $result["id"]; ?></div>
      </div>
      <div class="box">
        <div class="box-title">제목</div>
        <div class="box-content"><?php echo $result["title"]; ?></div>
      </div>
      <div class="box">
        <div class="box-title">내용</div>
        <div class="box-content"><?php echo $result["content"]; ?></div>
      </div>
      <div class="box">
        <div class="box-title">작성일자</div>
        <div class="box-content"><?php echo $result["created_at"]; ?></div>
      </div>
    </div>
    
    <form action="/delete.php" method="post">
      <input type="hidden" name="id" value = "<?php echo $id ?>"> 
      <div class="main-footer">
        <button type="submit" class="btn-small">삭제</button>
        <a href="/detail.php?<?php echo "id=".$id."&page=".$page; ?>"><button type="button" class="btn-small">취소</button></a>
      </div>
    </form>
  </main>
</body>
</html>