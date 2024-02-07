import { createRouter, createWebHistory } from 'vue-router';
import HomeView from '../views/HomeView.vue'

const router = createRouter({
    history: createWebHistory(
        import.meta.env.BASE_URL),
    routes: [{
            path: '/',
            name: 'home',
            component: HomeView
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
        // {
        //     path: '/home',
        //     name: 'Home',
        //     component: () =>
        //         import ('@/views/auth/Home.vue')
        // },
        {
            path: '/dashboard',
            name: 'Dashboard',
            component: () =>
                import ('@/views/auth/Dashboard.vue')
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
        {
            path: '/faculties',
            name: 'faculties',
            component: () =>
                import ('../views/Faculties.vue')
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
                import ('../views/Contact.vue')
        },
        {
            path: '/about',
            name: 'about',
            // route level code-splitting
            // this generates a separate chunk (About.[hash].js) for this route
            // which is lazy-loaded when the route is visited.
            component: () =>
                import ('../views/AboutView.vue')
        }
    ]
});

export default router;