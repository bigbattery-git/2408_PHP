@extends('layout.layout')

@section('title', '로그인')

@section('bodyClassVh', 'vh-100')

@section('main')
<main class="d-flex justify-content-center align-items-center h-75">
	<form style="width: 300px;">
		<div id="errorMsg" class="form-text text-danger">에러뜸.</div>
		<div class="mb-3">
			<label for="id" class="form-label">Email address</label>
			<input type="email" class="form-control" id="id" name="id">
		</div>
		<div class="mb-3">
			<label for="password" class="form-label">Password</label>
			<input type="password" class="form-control" id="password" name="password"> 
		</div>
		<button type="submit" class="btn btn-dark mb-3" style="width: 100%;">로그인</button>
		<a href="./regist.html" class="btn btn-secondary" style="width: 100%;">회원가입</a>
	</form>
</main>
@endsection