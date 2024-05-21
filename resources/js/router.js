import { createRouter, createWebHistory } from "vue-router";
import Home from "./components/Home.vue";
import User from "./components/User.vue";
import UserCreate from "./components/UserCreate.vue";

import Task from "./components/Task.vue";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/users',
            name: 'users.list',
            component: User
        },
        {
            path: '/user/create',
            name: 'users.create',
            component: UserCreate
        },
        {
            path: '/tasks',
            name: 'tasks.list',
            component: Task
        }
    ]
})

export default router
