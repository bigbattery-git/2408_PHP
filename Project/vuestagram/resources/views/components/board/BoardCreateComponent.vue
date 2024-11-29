<template>
	<div class="form-box">
			<h3 class="form-title">글 작성</h3>
			<img :src="preview" alt="">
			<textarea name="content" placeholder="내용을 적어주세요" maxlength="200" v-model="boardInfo.content"></textarea>
			<div style="width: 100%; height: 100px; border: 2px dotted red; color:white;">
				<input type="file" name="file" id="file" accept="image/*" @change="setFile" style="display: none; width: 100%; height: 100%;">
				<label for="file" style="width: 100%; height: 100%; color : black; font-size: 2rem;  display: flex; justify-content: center; align-items: center;">파일 올리는 곳</label>
			</div>
			<button class="btn btn-bg-black btn-submit" @click="store.dispatch('board/storeBoard', boardInfo);">작성</button>
			<button class="btn btn-submit" @click="$router.push('/boards')">취소</button>
	</div>
</template>
<script setup>
	import {reactive, ref } from 'vue';
	import { useStore } from 'vuex';

	const store = useStore();

	const boardInfo = reactive({
		content: ''
		,file: null
	});

	const preview = ref('');

	const setFile = (e) => {
		boardInfo.file = e.target.files[0];
		preview.value = URL.createObjectURL(boardInfo.file);
	}

</script>
<style>
	
</style>