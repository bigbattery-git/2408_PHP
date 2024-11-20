<template>
  <img src="./assets/logo.png" alt="Vue logo">
  <h1 style="font-size: 10rem;"> Hello World! </h1>
  <BoardListComponent/>
</template>

<script setup>
  import BoardListComponent from './components/BoardListComponent.vue';
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
