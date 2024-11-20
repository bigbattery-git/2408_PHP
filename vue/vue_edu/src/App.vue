<template>
	<!-- 컴포넌트 이벤트  -->
	<h3>부모쪽 cnt : {{ cnt }}</h3>
	<button @click="setCnt(1)">증증가가잼잼</button>

	<EventComponent :cnt="cnt" @eventAddCnt="setCnt">

	</EventComponent>
	<!-- props -->
	<ChildComponent 
		:data = "data"
		:count = "cnt">
		<h3>부모쪽에서 작성한 태그들</h3>
		<p>아아ㅏㅇ아아아아</p>
	</ChildComponent>
	<hr>
	<br><br>
	<h1 v-if="cnt>=5" >5보다 큽니다</h1>
	<h1 v-else-if="cnt<0" >음수입니다</h1>
	<h1 v-else >기타</h1>
	<h1>{{ cnt }}</h1>
	<div class="buttons">
		<button @click="()=>{setCnt(1)}">증가 잼</button>
		<button @click="()=>{setCnt()}">초기화 잼</button>
		<button @click="() => {setCnt(-1)}">감소 노잼</button>
	</div>

	<h1 v-show="flgShow">으히히힛</h1>
	<button @click="flgShow = !flgShow">vshow toggle</button>

	<!-- v-for 1. 단순반복 -->
	<div v-for="value in 5" :key="value">
		<p>{{ value }}</p>
	</div>
<!-- 
	99단 -->

	<!-- <div v-for="value in 29 " :key="value">
		<p v-if="value >= 2">{{ value }}단</p>		
		<div v-if="value >= 2">
			<div v-for="value2 in 29" :key="value2">
				<p>{{ value }} * {{ value2 }} = {{ value * value2 }}</p>			
			</div>
			<br>
		</div>
	</div> -->

	<!-- 배열 반복 -->
	<div v-for="(item, i) in data" :key="item">
		<p>{{  `${i} : ${item.name} - ${item.age} - ${item.gender}` }}</p>
	</div>
	<hr>
	<h1>이름 : {{ userInfo.name }}</h1>
	<h1 :class="ageBlue">나이 : {{ userInfo.age }}</h1>
	<h1>성별 : {{ userInfo.gender }}</h1>
	<button @click="() => {changeName('갑순이');}">이름 변경</button>
	<button @click="changeAgeBlue">나이 파란색으로 수정</button>
	<hr>
	<input type="text" name="gender" id="gender" v-model="trans">
	<button @click="() => {userInfo.gender = trans}">성별 변경 기계</button>

	<!-- 자식 컴포넌트 호출 -->
	<BoardComponent />
	<hr>
</template>

<script setup>
import BoardComponent from './components/BoardComponent.vue'
import ChildComponent from './components/ChildComponent.vue';

// count =====================
	import { reactive, ref } from 'vue';
import EventComponent from './components/EventComponent.vue';

	const cnt = ref(0);

	function setCnt(count){
		if(count === null || isNaN(count)){
			cnt.value = 0;
			return;
		}
		cnt.value += count;
	}
// count ===========================
// userinfo ====================

const userInfo = reactive({
	name : '홍길동'
	,age : 30
	,gender : 'undefind'
});

const changeName = (name = null) =>{
	if (name === null) return;

	userInfo.name = name;

}

// ageBlue =======================================
const ageBlue = ref('');
const changeAgeBlue = () =>{
	ageBlue.value = ageBlue.value === 'textColorBlue' ? '' : 'textColorBlue';
}
// 성별 변경 기계
const trans = ref('');

// flgShow
const flgShow = ref(true);

(()=>{

	setInterval(() => {
		flgShow.value = !flgShow.value
	}, 10);

});

// data

const data = reactive([
	{name : '홍길동', age: 20, gender : '남자'}
	,{name : '김영희', age:12, gender:'여자'}
	,{name:'둘리', age:41, gender:'수컷'}
]);

</script>

<style>
	*{
		margin: 1rem 0;
		padding: 0;
		box-sizing: border-box;
	}

	body{
		display: flex;
		flex-direction: column;
		justify-content: center;
		text-align: center;		
		align-items: center;
	}
	.buttons{
		display: flex;
		justify-content: center;
		gap : 1rem;
	}
	.textColorBlue{
		color : blue;
	}
</style>