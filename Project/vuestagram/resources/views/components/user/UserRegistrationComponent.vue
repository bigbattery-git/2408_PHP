<template>
	<div class="form-box">
		<h3 class="form-title">회원가입</h3>
		<input type="text" name="account" placeholder="아이디">
		<input type="password" name="password" autocapitalize="off">
		<input type="password" name="password_chk" autocomplete="off">
		<input type="text" name="name" placeholder="이름">
		<div class="radio-box">
			<div>
				<label for="male">남자</label>
				<input type="radio" name="gender" id="male" value="0">
			</div>
			<div>
				<label for="female">여자</label>
				<input type="radio" name="gender" id="female" value="1">
			</div>
			<div>
				<label for="non">사람이 아님</label>
				<input type="radio" name="gender" id="non" value="2">
			</div>
		</div>
		<input type="file" name="profile" accept="image/*">
		<hr>
		<button class="btn btn-submit btn-bg-black">회원가입</button>
		<button class="btn btn-submit" @click="router.push('/login')">취소</button>
	</div>
</template>
<script setup>

</script>
<style>
	
</style>