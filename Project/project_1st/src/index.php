<?php

  require_once($_SERVER["DOCUMENT_ROOT"]."/config.php");
  require_once(MY_PATH_DB_LIB);

  $conn = null;
  try{
    $conn = my_db_conn();

    $arr_prepare = [
      "list_cnt" => 5,
      "offset"   => 0
    ];

    // pagination select
    $result = my_board_select_pagination($conn, $arr_prepare);

    print_r($result);
  }
  catch(Throwable $tr){

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

    <div class="main-list">
      <div class="item list-body">
        <div>30</div>
        <a href="./detail.html"><div>제목 30</div></a>
        <div>2024-01-01 10:53:20</div>
      </div>
    </div>

    <div class="main-list">
      <div class="item list-body">
        <div>29</div>
        <a href="./detail.html"><div>제목 29</div></a>
        <div>2024-01-01 10:53:20</div>
      </div>
    </div>

    <div class="main-list">
      <div class="item list-body">
        <div>28</div>
        <a href="./detail.html"><div>제목 28</div></a>
        <div>2024-01-01 10:53:20</div>
      </div>
    </div>

    <div class="main-list">
      <div class="item list-body">
        <div>27</div>
        <a href="./detail.html"><div>제목 27</div></a>
        <div>2024-01-01 10:53:20</div>
      </div>
    </div>

    <div class="main-list">
      <div class="item list-body">
        <div>26</div>
        <a href="./detail.html"><div>제목 26</div></a>
        <div>2024-01-01 10:53:20</div>
      </div>
    </div>


    <div class="main-footer">
      <a href="index.html"><button>이전</button></a>
      <a href="index.html"><button>1</button></a>
      <a href="index.html"><button>다음</button></a>
    </div>    
  </main>
    
</body>
</html>