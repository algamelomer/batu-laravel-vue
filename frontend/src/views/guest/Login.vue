<template>
  <section class="bg-gray-50 dark:bg-gray-900 w-full">
      <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto h-screen lg:py-0">

          <div
              class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
              <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                  <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                      Sign in to your account
                  </h1>
                  <form @submit.prevent="authStore.handleLogin(form)">
                      <div>
                          <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                              email</label>
                          <input v-model="form.email" type="email" name="email" id="email"
                              class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                              placeholder="email@batu.edu.eg">
                      </div>
                      <div>
                          <label for="password"
                              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                          <input v-model="form.password" type="password" name="password" id="password"
                              placeholder="••••••••"
                              class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                      </div>
                      <div class="flex items-center justify-between">
                          <div class="flex items-start">
                              <div class="flex items-center h-5">
                                  <input id="remember" aria-describedby="remember" type="checkbox"
                                      class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800">
                              </div>
                              <div class="ml-3 text-sm">
                                  <label for="remember" class="text-gray-500 dark:text-gray-300">Remember me</label>
                              </div>
                          </div>
                          <a href="#"
                              class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">Forgot
                              password?</a>
                      </div>
                      <button type="submit"
                          class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Sign
                          in</button>

                  </form>
              </div>
          </div>
      </div>
  </section>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useAuthStore } from '@/stores/auth';
const authStore = useAuthStore();

const form = ref({
    email: '',
    password: ''
});

onMounted(() => {
    authStore.errors.email = '';
    authStore.errors.password = '';
});

</script>

<!-- <template>
    <div class="login-page">
        <h3 class="text-center">Login</h3>
        <div class="form">
            <form class="login-form" @submit.prevent="authStore.handleLogin(form)">
                <input type="email" placeholder="email" v-model="form.email"/>
                <div class="error-text" v-if="authStore.errors.email">{{ authStore.errors.email[0] }}</div>
                <input type="password" placeholder="password" v-model="form.password"/>
                <div class="error-text" v-if="authStore.errors.password">{{ authStore.errors.password[0] }}</div>
                <button>login</button>
                <p class="message">Forgot password? <routerLink to="/forgot-password">Click here</routerLink></p>
                <p class="message">Not registered? <routerLink to="/registration">Create an account</routerLink></p>
            </form>
        </div>
    </div>
</template>

<style scoped>
@import url(https://fonts.googleapis.com/css?family=Roboto:300);
.login-page {
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
.form .register-form {
  display: none;
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
</style> -->