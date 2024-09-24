<?php

  require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
  require_once(MY_PATH_DB_LIB);

  $conn = null;
  $offset = (null - 1) * MY_LIST_COUNT;

  try{
    $conn = my_db_conn();

    $arr_prepare = [
      "list_cnt" => 10,
      "offset"   => 0
    ];

    // pagination select
    $result = my_board_select_pagination($conn, $arr_prepare);
  }
  catch(Throwable $tr){
    echo $tr -> getMessage();
  }
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/index.css">
    <title>리스트 페이지</title>
</head>
<body>
  <header>
    <h1>mini Board</h1>
  </header>

  <main>
    <div class="main-top">
      <button class="btn-middle">글 작성</button>
    </div>   

    <div class="main-list">
      <div class="item list-head">
        <div>게시글 번호</div>
        <div>게시글 제목</div>
        <div>작성일자</div>
      </div>
    </div>

    <?php foreach($result as $value){ ?>
      <div class="main-list">
        <div class="item list-body">
          <div><?php echo $value["id"]; ?></div>
          <div><a href="./detail.html"><?php echo $value["title"]; ?></a></div>
          <div><?php echo $value["created_at"]; ?></div>
        </div>
      </div>
    <?php }?>

    <div class="main-footer">
      <a href="index.php"><button>이전</button></a>
      <a href="index.php"><button>1</button></a>
      <a href="index.php"><button>다음</button></a>
    </div>    
  </main>
    
</body>
</html>