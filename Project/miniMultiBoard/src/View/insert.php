<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="./css/common.css">
</head>
<body class="vh-100">
	<?php require_once('View/inc/header.php'); ?>

	<main class="d-flex justify-content-center align-items-center h-75">
		<form style="width: 300px;" action="/boards/insert" method="post" enctype="multipart/form-data">
			<?php require_once('View/inc/errorMsg.php'); ?>
			<div class="mb-3">
				<label for="b_title" class="form-label">제목</label>
				<input type="text" class="form-control" id="b_title" name="b_title" required>
			</div>
			<div class="mb-3">
				<label for="b_content" class="form-label">내용</label>
				<input type="text" class="form-control" id="b_content" name="b_content" required> 
			</div>
			<div class="mb-3">
				<label for="file" class="form-label">이미지</label>
				<input type="file" name="file" required>
			</div>
			<button type="submit" class="btn btn-dark mb-3" style="width: 100%;">작성</button>
			<a href="/regist" class="btn btn-secondary" style="width: 100%;">취소</a>

			<input type="hidden" name="bc_type" value="<?php echo $this->boardType; ?>">
		</form>
	</main>

	<footer class="py-3 fixed-bottom bg-dark">
    <p class="text-center text-white d-flex justify-content-center align-items-center">© 2024 Company, Inc</p>
  </footer>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>