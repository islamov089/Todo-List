<template>
  <div id="app">
    <nav>
      <router-link to="/login">Login</router-link>
      <router-link to="/signup">Sign Up</router-link>
      <router-link to="/">To-Do List</router-link>
    </nav>
    <router-view></router-view> 
  </div>
</template>

<script>
export default {
  name: 'App',
};
</script>


