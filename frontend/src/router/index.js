import { createRouter, createWebHistory } from 'vue-router';
import HomeView from '../views/main/HomeView.vue'
import Main from '../views/Main.vue'

const router = createRouter({
    history: createWebHistory(
        import.meta.env.BASE_URL),
    routes: [{
            path: '/',
            name: 'Main',
            component: Main,
            children: [{
                    path: '',
                    name: 'home',
                    component: HomeView
                }, {
                    path: '/faculties',
                    name: 'faculties',
                    component: () =>
                        import ('../views/main/Faculties.vue')
                },
                {
                    path: '/faculties/:id',
                    component: () =>
                        import ('@/components/faculties/facultie.vue')
                },
                {
                    path: '/contact',
                    name: 'contact',
                    component: () =>
                        import ('../views/main/Contact.vue')
                },
                {
                    path: '/about',
                    name: 'about',

                    component: () =>
                        import ('../views/main/AboutView.vue')
                }
            ]
        },
        {
            path: '/registration',
            name: 'Registration',
            component: () =>
                import ('@/views/guest/Registration.vue')
        },
        {
            path: '/login',
            name: 'Login',
            component: () =>
                import ('@/views/guest/Login.vue')
        },
        {
            path: '/dashboard',
            name: 'Dashboard',
            component: () =>
                import ('@/views/auth/Dashboard.vue'),
            children: [{
                    path: '',
                    name: 'DashboardHome',
                    component: () =>
                        import ('@/views/auth/dashboard/Dashboard_home.vue'),
                },
                {
                    path: '/dashboard/Faculties',
                    name: 'DashboardFaculties',
                    component: () =>
                        import ('@/views/auth/dashboard/Dashboard_faculties.vue'),
                }, {
                    path: '/dashboard/News',
                    name: 'DashboardNews',
                    component: () =>
                        import ('@/views/auth/dashboard/Dashboard_news.vue'),
                }, {
                    path: '/dashboard/Users',
                    name: 'DashboardUsers',
                    component: () =>
                        import ('@/views/auth/dashboard/Dashboard_users.vue'),
                }, {
                    path: '/dashboard/Departments',
                    name: 'DashboardDepartments',
                    component: () =>
                        import ('@/views/auth/dashboard/Dashboard_departments.vue'),
                },
                {
                    path: '/dashboard/:category/Upload', // Dynamic parameter ":category"
                    name: 'DashboardUpload',
                    component: () =>
                        import ('@/components/dashboard/Upload.vue'),
                },
                {
                    path: '/dashboard/:category/edit/:id', // Dynamic parameter ":category"
                    name: 'DashboardEdit',
                    component: () =>
                        import ('@/components/dashboard/Edit.vue'),
                }


            ]
        },

        {
            path: '/forgot-password',
            name: 'ForgotPassword',
            component: () =>
                import ('@/views/guest/ForgotPassword.vue')
        },
        {
            path: '/password-reset/:token',
            name: 'PasswordReset',
            component: () =>
                import ('@/views/guest/PasswordReset.vue')
        },

    ]
});

export default router;