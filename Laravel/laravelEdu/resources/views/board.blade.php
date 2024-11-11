<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>
<body>
	@include('layout.header')

	<main>
		<h2>메인임</h2>
	</main>

	@include('layout.footer', ['키임' => '벨류임'])
</body>
</html>