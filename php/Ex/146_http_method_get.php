<?php
  echo $value = isset($_GET["id"]) ? $_GET["id"] : null;
?>

<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form action="#" method="get">
    <input type="text" name="id" id="id">
    <br>
    <button type="submit">제출</button>
  </form>
</body>
</html>