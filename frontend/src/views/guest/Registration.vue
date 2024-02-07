<script setup>
import {ref} from 'vue';
import { useAuthStore } from '@/stores/auth';

const authStore = useAuthStore();

const form = ref({
    name: '',
    email: '',
    password: '',
    password_confirmation: ''
});

</script>

<template>
    <div class="registration-page">
        <h3 class="text-center">Registration</h3>
        <div class="form">
            <form class="register-form" @submit.prevent="authStore.handleRegister(form)">
                <input type="text" placeholder="name" v-model="form.name"/>
                <div class="error-text" v-if="authStore.errors.name">{{ authStore.errors.name[0] }}</div>
                <input type="email" placeholder="email address" v-model="form.email"/>
                <div class="error-text" v-if="authStore.errors.email">{{ authStore.errors.email[0] }}</div>
                <input type="password" placeholder="password" v-model="form.password"/>
                <div class="error-text" v-if="authStore.errors.password">{{ authStore.errors.password[0] }}</div>
                <input type="password" placeholder="password confirmation" v-model="form.password_confirmation"/>
                <button>Register</button>
                <p class="message">Already registered? <routerLink to="/login">Login</routerLink></p>
            </form>
        </div>
    </div>
</template>

<style scoped>
@import url(https://fonts.googleapis.com/css?family=Roboto:300);
.registration-page {
  padding: 8% 0 0;
  margin: auto;
  background: #76b852;
  background: rgb(141,194,111);
  height: 100%;
}
.form {
  position: relative;
  z-index: 1;
  background: #FFFFFF;
  max-width: 360px;
  margin: 0 auto 100px;
  padding: 45px;
  text-align: center;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
} 
.form input {
  font-family: "Roboto", sans-serif;
  outline: 0;
  background: #f2f2f2;
  width: 100%;
  border: 0;
  margin: 0 0 15px;
  padding: 15px;
  box-sizing: border-box;
  font-size: 14px;
}
.form button {
  font-family: "Roboto", sans-serif;
  text-transform: uppercase;
  outline: 0;
  background: #4CAF50;
  width: 100%;
  border: 0;
  padding: 15px;
  color: #FFFFFF;
  font-size: 14px;
  -webkit-transition: all 0.3 ease;
  transition: all 0.3 ease;
  cursor: pointer;
}
.form button:hover,.form button:active,.form button:focus {
  background: #43A047;
}
.form .message {
  margin: 15px 0 0;
  color: #b3b3b3;
  font-size: 12px;
}
.form .message a {
  color: #4CAF50;
  text-decoration: none;
}
.container {
  position: relative;
  z-index: 1;
  max-width: 300px;
  margin: 0 auto;
}
.container:before, .container:after {
  content: "";
  display: block;
  clear: both;
}
.container .info {
  margin: 50px auto;
  text-align: center;
}
.container .info h1 {
  margin: 0 0 15px;
  padding: 0;
  font-size: 36px;
  font-weight: 300;
  color: #1a1a1a;
}
.container .info span {
  color: #4d4d4d;
  font-size: 12px;
}
.container .info span a {
  color: #000000;
  text-decoration: none;
}
.container .info span .fa {
  color: #EF3B3A;
}
</style>