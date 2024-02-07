import { defineStore } from "pinia";
import axios from "axios";
import router from "../router/index";

export const useAuthStore = defineStore('auth', {
    state: () => ({
        authUser: null,
        authErrors: []
    }),
    getters: {
        user: (state) => state.authUser,
        errors: (state) => state.authErrors
    },
    actions: {
        async getToken() {
            await axios.get('/sanctum/csrf-cookie');
        },

        async getUser() {
            try {
                await this.getToken();
                const data = await axios.get('/api/user');
                this.authUser = data.data;
            } catch (error) {
                if (error.response.status == 401) {
                    this.authUser = false
                } else {
                    console.error(error.response.status)
                }
            }
        },

        async handleLogin(data) {
            this.authErrors = [];

            await this.getToken();

            try {
                await axios.post('/api/login', {
                    email: data.email,
                    password: data.password
                });

                this.router.push('/dashboard');
            } catch (error) {
                if (error.response.status === 422) {
                    this.authErrors = error.response.data.errors;
                }
            }
        },

        async handleLogout() {
            try {
                await axios.post('/api/logout');
                document.cookie.split(";").forEach((c) => {
                    document.cookie = c.replace(/^ +/, "").replace(/=.*/, "=;expires=" + new Date().toUTCString() + ";path=/");
                });
                this.authUser = null;
                this.router.push('/login');
            } catch (error) {
                console.error("Logout failed:", error);
            }
        },


        async handleRegister(data) {
            this.authErrors = [];

            await this.getToken();

            try {
                await axios.post('/api/register', {
                    name: data.name,
                    email: data.email,
                    password: data.password,
                    password_confirmation: data.password_confirmation,
                });

                this.router.push('/dashboard');
            } catch (error) {
                if (error.response.status === 422) {
                    this.authErrors = error.response.data.errors;
                }
            }
        },

        // async handleLogout() {
        //     await axios.post('/logout');

        //     this.authUser = null;
        // },

        async handleForgotPassword(email) {
            this.authErrors = [];

            try {
                await axios.post('/api/forgot-password', {
                    email: email
                });
            } catch (error) {
                if (error.response.status === 422) {
                    this.authErrors = error.response.data.errors;
                }
            }
        },

        async handleResetPassword(resetData) {
            this.authErrors = [];

            try {
                await axios.post('/api/reset-password', resetData);
                this.router.push('/');
            } catch (error) {
                if (error.response.status === 422) {
                    this.authErrors = error.response.data.errors;
                }
            }
        }

    }
});