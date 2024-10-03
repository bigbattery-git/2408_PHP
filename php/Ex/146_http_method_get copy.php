<?php
  echo $value = isset($_POST["id"]) ? $_POST["id"] : null;
?>

<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form action="#" method="POST"> <!-- 여기도 method Post로 변경해야 함 -->
    <input type="text" name="id" id="id">
    <br>
    <button type="submit">제출</button>
  </form>
</body>
</html>