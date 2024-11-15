@extends('layout.layout')

@section('title', '회원가입')

@section('bodyClassVh', 'vh-100')

@section('main')
<main class="d-flex justify-content-center align-items-center h-75">
	
	<form style="width: 300px;" action="{{ route('register') }}" method="POST">
			<div id="errorMsg" class="form-text text-danger">
				@forelse ($errors->all() as $item)
					<span>{{ $item }}</span>
					<br>
				@empty

				@endforelse
			</div>
		@csrf
		<div class="mb-3">
			<label for="u_email" class="form-label">Email address</label>
			<input type="email" class="form-control" id="u_email" name="u_email" value="{{ old('u_email') }}">
		</div>
		<div class="mb-3">
			<label for="u_password" class="form-label">Password</label>
			<input type="password" class="form-control" id="u_password" name="u_password"> 
		</div>
		<div class="mb-3">
			<label for="u_password_chk" class="form-label">비번 췤</label>
			<input type="password" class="form-control" id="u_password_chk" name="u_password_chk"> 
		</div>
		<div class="mb-3">
			<label for="u_name" class="form-label">이름</label>
			<input type="text" class="form-control" id="u_name" name="u_name" value="{{ old('u_name') }}"> 
		</div>
		<button type="submit" class="btn btn-dark mb-3" style="width: 100%;">가입완료</button>
		<a href="{{ route('goLogin') }}" class="btn btn-secondary" style="width: 100%;">취소</a>
	</form>
</main>
@endsection