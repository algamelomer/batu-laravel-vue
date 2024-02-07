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

        async handleNews(data) {
            this.authErrors = [];
            try {
                await this.getToken();
                if (!data.id) {
                    data.id = '';
                }

                const formData = new FormData();
                formData.append('title', data.title);
                formData.append('description', data.description);
                formData.append('file', data.file);
                formData.append('type', 'news');
                formData.append('user_id', data.user_id);

                console.log(data.file);

                const response = await axios.post('/api/posts/' + data.id, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                });

                if (response.status === 201) {
                    alert("Success");
                } else if (response.status === 200) {
                    alert("Success");
                } else {
                    alert("Error: Unexpected status code");
                    console.log(data)
                }
            } catch (error) {
                if (error.response) {
                    if (error.response.status === 422) {
                        this.authErrors = error.response.data.errors;
                        alert("Error: Validation failed");
                    } else {
                        alert("Error: Server error");

                    }
                } else {
                    alert("Error: Network error");
                }
            }
        },

        async handleNewsDelete(data) {
            this.authErrors = [];
            try {
                await this.getToken();
                await axios.delete('/api/posts/' + data);

                alert("deleted successfully")
            } catch (error) {
                if (error.response) {
                    if (error.response.status === 422) {
                        this.authErrors = error.response.data.errors;
                        alert("Error: Validation failed");
                    } else {
                        alert("Error: Server error");
                        // Handle other server errors
                    }
                } else {
                    alert("Error: Network error");
                    // Handle network errors
                }
            }
        },

        async handleArticle(data) {
            this.authErrors = [];
            try {
                await this.getToken();
                if (!data.id) {
                    data.id = '';
                }

                const formData = new FormData();
                formData.append('title', data.title);
                formData.append('description', data.description);
                formData.append('file', data.file);
                formData.append('type', 'article');
                formData.append('user_id', data.user_id);

                console.log(data.file);

                const response = await axios.post('/api/posts/' + data.id, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                });

                if (response.status === 201) {
                    alert("Success");
                } else if (response.status === 200) {
                    alert("Success");
                } else {
                    alert("Error: Unexpected status code");
                    console.log(data)
                }
            } catch (error) {
                if (error.response) {
                    if (error.response.status === 422) {
                        this.authErrors = error.response.data.errors;
                        alert("Error: Validation failed");
                    } else {
                        alert("Error: Server error");

                    }
                } else {
                    alert("Error: Network error");
                }
            }
        },


        async handleLetter(data) {
            this.authErrors = [];
            try {
                await this.getToken();
                if (!data.id) {
                    data.id = '';
                }

                const formData = new FormData();
                formData.append('title', data.title);
                formData.append('description', data.description);
                formData.append('file', data.file);
                formData.append('type', 'news');
                formData.append('user_id', data.user_id);

                console.log(data.file);

                const response = await axios.post('/api/posts/' + data.id, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                });

                if (response.status === 201) {
                    alert("Success");
                } else if (response.status === 200) {
                    alert("Success");
                } else {
                    alert("Error: Unexpected status code");
                    console.log(data)
                }
            } catch (error) {
                if (error.response) {
                    if (error.response.status === 422) {
                        this.authErrors = error.response.data.errors;
                        alert("Error: Validation failed");
                    } else {
                        alert("Error: Server error");

                    }
                } else {
                    alert("Error: Network error");
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