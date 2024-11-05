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
	<header>
		<nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
			<div class="container-fluid">
				<a class="navbar-brand" href="#">미니보드</a>
			</div>
		</nav>
	</header>

	<main class="d-flex justify-content-center align-items-center h-75">
		<form style="width: 300px;" action="/login" method="post">
			<?php require_once('View/inc/errorMsg.php'); ?>
			<div class="mb-3">
				<label for="u_email" class="form-label">Email address</label>
				<input type="email" class="form-control" id="u_email" name="u_email">
			</div>
			<div class="mb-3">
				<label for="u_password" class="form-label">Password</label>
				<input type="password" class="form-control" id="u_password" name="u_password"> 
			</div>
			<button type="submit" class="btn btn-dark mb-3" style="width: 100%;">로그인</button>
			<a href="./regist.html" class="btn btn-secondary" style="width: 100%;">회원가입</a>
		</form>
	</main>

	<footer class="py-3 fixed-bottom bg-dark">
    <p class="text-center text-white d-flex justify-content-center align-items-center">© 2024 Company, Inc</p>
  </footer>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>