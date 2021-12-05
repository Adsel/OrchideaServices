import { createWebHistory, createRouter } from "vue-router";

const routes = [
    {
        path: "/",
        name: "Home",
        component: () => import(/* webpackChunkName: "home" */ './components/home/Home.vue')
    },
    {
        path: "/lottery",
        name: "Lottery",
        component: () => import(/* webpackChunkName: "lottery" */ './components/lottery/Lottery.vue')
    },
    {
        path: "/achievements",
        name: "Achievements",
        component: () => import(/* webpackChunkName: "achievements" */ './components/achievements/Achievements.vue')
    },
    {
        path: "zNG8z9VV4cJ9vmDx",
        name: "AdminPanel",
        component: () => import(/* webpackChunkName: "achievements" */ './components/panel/AdminPanel.vue')
    }
];

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes,
});

export default router;
