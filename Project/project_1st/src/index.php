<?php

  require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
  require_once(MY_PATH_DB_LIB);

  $conn = null;

  try{

    $conn = my_db_conn();
    $max_board_cnt = my_board_total_count($conn);
    $max_page = (int)ceil($max_board_cnt/MY_LIST_COUNT); // 남은 데이터까지 전부 나와야 함

    $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;

    $offset = ($page - 1) * MY_LIST_COUNT;
    $start_page_button_number = (int)(floor(($page -1)/MY_PAGE_BUTTON_COUNT) * MY_PAGE_BUTTON_COUNT) + 1; // 페이지 시작 값
    $end_page_button_number = ($start_page_button_number + MY_PAGE_BUTTON_COUNT) - 1;                // 페이지 마지막 값
    $end_page_button_number = $end_page_button_number > $max_page ? $max_page : $end_page_button_number;

    $prev_page_button_number = $page - 1 < 1 ? 1 : $page - 1;
    $next_page_button_number = $page + 1 > $max_page ? $max_page : $page + 1;

    $arr_prepare = [
      "list_cnt" => MY_LIST_COUNT,
      "offset"   => $offset
    ];

    // pagination select
    $result = my_board_select_pagination($conn, $arr_prepare);
  }

  catch(Throwable $th){
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
    <link rel="stylesheet" href="./css/index.css">
    <title>리스트 페이지</title>
</head>
<body>
  <?php require_once(MY_PATH_ROOT."header.php") ?>

  <main>
    <div class="main-top">
      <button class="btn-middle"><a href="/insert.php">글 작성</a></button>
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
          <div><a href="/detail.php?id=<?php echo $value["id"]; ?>&page=<?php echo $page; ?>"><?php echo $value["title"]; ?></a></div>
          <div><?php echo $value["created_at"]; ?></div>
        </div>
      </div>
    <?php }?>

    <div class="main-footer">
      <?php if($page !== 1){ ?>
        <a href="/index.php?page=<?php echo $prev_page_button_number ?>"><button>이전</button></a>
      <?php } ?>
      <?php for($i = $start_page_button_number; $i<=$end_page_button_number; $i++) { ?>
        <a href="/index.php?page=<?php echo $i ?>"><button class="btn-small <?php echo $i === $page ? " btn-selected" : "" ?>"><?php echo $i ?></button></a>
        <?php } ?>
      <?php if($page !== $max_page){ ?>
        <a href="/index.php?page=<?php echo $next_page_button_number ?>"><button>다음</button></a>
      <?php } ?>
    </div>    
  </main>
    
</body>
</html>