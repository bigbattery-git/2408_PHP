<?php
  require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
  require_once(MY_PATH_DB_LIB);

  $conn = null;

  try{
    if(strtoupper($_SERVER["REQUEST_METHOD"]) === "GET"){
      // Get 처리
      $conn = my_db_conn();
      $id = isset($_GET["id"])? (int)$_GET["id"] : 0;
      $page = isset($_GET["page"])? (int)$_GET["page"] : 1;

      if($id < 0){
        throw new Exception("파라미터 오류 : update.php");
      }

      $arr_prepare =[
        "id" => $id
      ];

      $result = my_board_select_id($conn, $arr_prepare);
    }
    else{
      // Post 처리
      $conn = my_db_conn();
      $id = isset($_POST["id"])? (int)$_POST["id"] : 0;
      $page = isset($_POST["page"])? (int)$_POST["page"] : 1;
      $title = isset($_POST["title"])? $_POST["title"] : "";
      $content = isset($_POST["content"])? $_POST["content"] : "";
      $file = $_FILES["file"];

      $arr_prepare =[
        "title"   => $title,
        "content" => $content,
        "id"      => $id
      ];

      $conn -> beginTransaction();

      if($file["name"] !== ""){
        $file_type = explode("/", $file["type"]);
        $file_extension = $file_type[1];
        $file_name = uniqid().".".$file_extension;
        $file_path = "resources/".$file_name;

        move_uploaded_file($file["tmp_name"], $file_path);

        $arr_prepare["img"] = $file_path;
      }

      if($id < 0){
        throw new Exception("파라미터 오류 : update.php id");
      }
      elseif($title === ""){
        throw new Exception("파라미터 오류 : update.php title");
      }

      my_board_update($conn, $arr_prepare);

      $conn -> commit();

      header("Location: /detail.php?id=".$id."&page=".$page);
      exit;
    }
  }
  catch(Throwable $th){
    if(!is_null($conn) && $conn->inTransaction()){
      $conn -> rollBack();
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
  <link rel="stylesheet" href="./css/update.css">
  <title>수정 페이지</title>
</head>
<body>

  <?php require_once(MY_PATH_ROOT."header.php") ?>

  <main>
    <form action="/update.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="id" value = <?php echo $result["id"] ?>>
      <input type="hidden" name="page" value = <?php echo $page ?>>

      <div class="box title-box">
        <div class="box-title">글번호</div>
        <div class="box-content"><?php echo $result["id"]; ?></div>
      </div>

      <div class="box title-box">
        <div class="box-title">제목</div>
        <div class="box-content">
        <input  class="box-content" type="text" name="title" id="title" value="<?php echo $result["title"]; ?>">
        </div>
      </div>

      <div class="box content-box">
        <div class="box-title">내용</div>
        <div class="box-content">
          <textarea name="content" id="content"><?php echo $result["content"] ?></textarea>
        </div>
      </div>

      <div class="box image-box">
        <div class="box-title">내용</div>
        <div class="box-content">
        <input type="file" name="file" id="file">
        </div>
      </div>

      <div class="main-footer">
        <button type="submit" class="btn-small">완료</button>
        <a href="/detail.php?id=<?php echo $id ?>&page=<?php echo $page;?>"><button type="button" class="btn-small">취소</button></a>
      </div>
    </form>
  </main>
</body>
</html>