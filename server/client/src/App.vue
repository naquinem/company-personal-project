<template>
  <RouterView/>
</template>

<script>
import { RouterView } from 'vue-router';
export default {
  name: 'App',
  components: {
    RouterView
  }
}
</script>

<style>
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
body{
  font-family: sans-serif, Arial, Helvetica;
}

</style>
