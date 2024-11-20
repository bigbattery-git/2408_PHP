<template>
	<hr>
		<h1 @mouseenter="()=>{cnt++;}" class="cntH1" :class="clr">{{ cnt }}</h1>
	<hr>

	<input type="tel" name="tel" id="tel" v-model="tel">
	<br>
	<label :style="color" for="tel">{{ msg }}</label>
</template>
<script setup>
	import { ref, watch } from 'vue';

	const cnt = ref(0);
	const clr = ref('blue');

	// (()=>{
	// 	setInterval(() => {
	// 		document.querySelector('body').style.backgroundColor = 
	// 		document.querySelector('body').style.backgroundColor === 'red'
	// 		? 'blue' : 'red';
	// 	}, 10);
	// })();

	// watchers
	const tel = ref('');
	const msg = ref('X');
	const color = ref('color : red');

	// value : tel의 값이 담김 
	watch(tel, (value) => {
		const regex = /^[0-9]{10,11}$/;

		if(regex.test(value)){
			msg.value = 'O';
			color.value = 'color : green';
		} else {
			msg.value = 'X';
			color.value = 'color : red';
		}
	})
</script>
<style>
	.cntH1{
		cursor: pointer;
		background-color: black;
		color: white;
		font-size: 10rem;
	}
	.blue{
		color: blue;
	}
	.red{
		color: red;
	}
</style>