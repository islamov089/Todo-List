<template>
  <div>
    <h2>Sign Up</h2>
    <el-form @submit.prevent="handleSignUp">
      <el-form-item>
        <el-input v-model="username" placeholder="Username" />
      </el-form-item>
      <el-form-item>
        <el-input type="password" v-model="password" placeholder="Password" />
      </el-form-item>
      <el-form-item>
        <el-input type="email" v-model="email" placeholder="Email" />
      </el-form-item>
      <el-button type="primary" native-type="submit">Sign Up</el-button>
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
      email: '',
    };
  },
  methods: {
    ...mapActions(['register']),
    async handleSignUp() {
      const userData = {
        username: this.username,
        password: this.password,
        email: this.email,
      };
      try {
        await this.register(userData); 
        this.$router.push('/login'); 
      } catch (error) {
        console.error('Registration error:', error);
      }
    },
  },
};
</script>
