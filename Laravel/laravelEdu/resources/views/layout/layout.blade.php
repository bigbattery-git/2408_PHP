<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>@yield('key', 'value')</title>
</head>
<body>
	@include('layout.header')
		@yield('main')
		
		@section('show')
			<h2>부모 show</h2>
			<h3>많은 처리중</h3>
		@show
		
	@include('layout.footer')
</body>
</html>