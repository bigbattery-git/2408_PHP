<template>
	<!-- 보드 리스트 -->
	<div v-if="loading">
		<h1>로딩중임 ㅅㄱ</h1>
	</div>
	<div v-else class="board-list-box" >
		<div class="item" @click="openModal" v-for="item in boardList" :key="item">
			<img :src="item.img" alt="">
		</div>
	</div>

	<!-- 상세 모달 -->
	<div class="board-detail-box" v-show="modalFlg">
		<div class="item">
			<img src="../../../../public/img/sample3.png" alt="">
			<hr>
			<p>내용임</p>
			<div class="etc-box">
				<span>작성자 : abc</span>
				<button @click="modalFlg=false">닫기</button>
			</div>
		</div>
	</div>
</template>

<script setup>
	import { computed, onBeforeMount, ref } from 'vue';
	import { useStore } from 'vuex';

	const store = useStore();
	const boardList = computed(() => store.state.board.boardList);
	let loading = ref(store.state.board.isLoading);

	// before mount
	onBeforeMount(()=>{
		if(store.state.board.boardList.length < 1){
			store.dispatch('board/getBoardListPagenation');
		}
	});
	// 모달 관련
	const modalFlg = ref(false);

	function openModal(){
		modalFlg.value = true;
	}
</script>	

<style>
	@import url('../../../css/boardList.css');	
</style>