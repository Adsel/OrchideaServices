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
];

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes,
});

export default router;
