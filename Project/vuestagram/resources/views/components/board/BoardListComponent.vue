<template>
	<!-- 보드 리스트 -->
	<div class="board-list">
		<div class="board-list-box">
			<div class="item" @click="openModal(item.board_id)" v-for="item in boardList" :key="item">
				<img :src="item.img" alt="">
			</div>
		</div>
		<div v-show="loading">
				<div class="loading-container">
					<span v-for="(char, index) in loadingText" :key="index" :class="{'fade-in': isVisible(index), 'fade-out': isFadingOut(index)}">
						{{ char }}
					</span>
				</div>
			</div>
	</div>

	<!-- 상세 모달 -->
	<div class="board-detail-box" v-show="modalFlg">
		<div class="item" v-show="modalLoading" style="text-align: center;">
			<h1>로딩중임 ㅅㄱ</h1>
		</div>
		<div class="item" v-show="!modalLoading" v-if="!modalLoading">
			<img :src="boardDetail.img" alt="">
			<hr>
			<p>{{ boardDetail.content }}</p>
			<div class="etc-box">
				<p>{{`작성자 : ${boardDetail.users.name}`}}</p>
				<button @click="modalFlg=false" class="btn btn-bg-black">닫기</button>
			</div>
		</div>
	</div>
</template>

<script setup>
	import { computed, onBeforeMount, onMounted, onUnmounted, ref } from 'vue';
	import { useStore } from 'vuex';

	const store = useStore();
	const boardList = computed(() => store.state.board.boardList);
	let loading = computed(() => store.state.board.isLoading);

	// before mount
	onBeforeMount(()=>{
		if(store.state.board.boardList.length < 1){
			store.dispatch('board/boardListPagenation');
		}
	});
	// 모달 관련
	const modalFlg = ref(false);
	const modalLoading = computed(()=> store.state.board.isModalLoading);
	const boardDetail = computed(()=> store.state.board.boardDetail);

	function openModal(board_id){
		store.dispatch('board/showBoard', board_id);
		modalFlg.value = true;
	}

	// 로딩 관련
	const loadingText = '로딩중임 ㅅㄱ';
	const visibleIndices = ref([]); // 보이는 글자의 인덱스 배열
	let intervalId; // interval ID 저장

	const showCharacters = () => {
		let index = 0;
		const length = loadingText.length;

		intervalId = setInterval(() => {
			// 현재 보이는 글자의 인덱스를 업데이트
			if (index < length+1) {
				visibleIndices.value.push(index);
				index++;
			} else {
				// 모든 글자가 보인 후, 다시 사라지기 시작
				setTimeout(() => {
					visibleIndices.value = [];
					index = 0; // 다시 처음으로 리셋
				}, 1000); // 모든 글자가 보인 후 1초 대기
			}
		}, 100); // 1초 간격으로 글자 나타남
	};

	const isVisible = (index) => {
		return visibleIndices.value.includes(index);
	};

	// 마지막 글자가 사라지는 애니메이션 상태를 결정
	const isFadingOut = (index) => {
		return visibleIndices.value.length === loadingText.length+1 && index === loadingText.length;
	};

	onMounted(() => {
		showCharacters();
	});

	onUnmounted(() => {
		clearInterval(intervalId); // 컴포넌트 언마운트 시 interval 정리
	});

	// scroll event
	const boardScrollEvent = ( e ) => {
		const docHeight = document.documentElement.scrollHeight; // 문서 기준 Y축 총 길이
		const winHeight = window.innerHeight;											// window Y축 총 길이
		const nowHeight = window.scrollY;												// 현재 Y축
		const viewHeight = docHeight - winHeight;								// 끝까지 스크롤 했을 때 Y축의 길이

		if(viewHeight <= nowHeight) {
			// store.dispatch('board/addBoardList');
			store.dispatch('board/boardListPagenation');
		}
	}
	window.addEventListener('scroll', boardScrollEvent);


</script>	

<style>
	@import url('../../../css/boardList.css');	

	.loading-container {
		font-size: 24px;
		display: flex;
		justify-content: center;
		align-items: center;
	}

	span {
		opacity: 0; /* 초기 상태에서 글자 안 보이게 */
		transition: opacity 0.5s ease; /* 부드러운 애니메이션 효과 */
	}

	.fade-in {
		opacity: 1; /* 보이는 상태 */
	}

	.fade-out {
		opacity: 0; /* 사라지는 상태 */
	}
</style>