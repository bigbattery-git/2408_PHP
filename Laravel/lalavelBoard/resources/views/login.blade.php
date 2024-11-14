@extends('layout.layout')

@section('title', '로그인')

@section('bodyClassVh', 'vh-100')



@section('main')
<main class="d-flex justify-content-center align-items-center h-75">
	<form style="width: 300px;" action="{{ route('login') }}" method="POST">
		@csrf

		{{-- $error : 에러메시지를 담을 때 라라벨에서 이 이름으로 담아옴 --}}
		{{-- $error->any 에러메시지가 있으면 true, 없으면 false를 반환함 --}}
		@if ($errors->any)
			{{-- $errors->all : 에러메시지를 배열로 반환함 --}}
			<div id="errorMsg" class="form-text text-danger">
				@foreach ($errors->all() as $errorMsg)
					<span>{{ $errorMsg }}</span>
					<br>
				@endforeach
			</div>
		@endif
		<div class="mb-3">
			<label for="u_email" class="form-label">Email address</label>					
			<input type="email" class="form-control" id="u_email" name="u_email" value="{{ old('u_email') }}">				
		</div>
		<div class="mb-3">
			<label for="u_password" class="form-label">Password</label>
			<input type="password" class="form-control" id="u_password" name="u_password"> 
		</div>
		<button type="submit" class="btn btn-dark mb-3" style="width: 100%;">로그인</button>
		<a href="./regist.html" class="btn btn-secondary" style="width: 100%;">회원가입</a>
	</form>
</main>
@endsection