<template>
    <div>
      <h2>Login</h2>
      <el-form @submit.prevent="handleLogin">
        <el-form-item>
          <el-input v-model="username" placeholder="Username" />
        </el-form-item>
        <el-form-item>
          <el-input type="password" v-model="password" placeholder="Password" />
        </el-form-item>
        <el-button type="primary" native-type="submit">Login</el-button>
      </el-form>
    </div>
  </template>
  
  <script>
  import { mapActions } from 'vuex';
  
  export default {
    data() {
      return {
        username: '',
        password: '',
      };
    },
    methods: {
      ...mapActions(['login']),
      async handleLogin() {
        const credentials = { username: this.username, password: this.password };
        await this.login(credentials); 
        this.$router.push('/'); 
      },
    },
  };
  </script>
  