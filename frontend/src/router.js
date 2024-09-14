
import {createRouter, createWebHistory }  from 'vue-router';
import HomeWeb from '@/views/Home.vue';
import LoginWeb from '@/views/auth/Login.vue';

const routes = [
    {
        path: '/',
        name : 'home',
        component: HomeWeb
    },
    {
        path: '/login',
        name : 'login',
        component: LoginWeb
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;