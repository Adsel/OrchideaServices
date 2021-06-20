import { createWebHistory, createRouter } from "vue-router";
import Home from "./components/home/Home";
import Lottery from "./components/lottery/Lottery";

const routes = [
    {
        path: "/",
        name: "Home",
        component: Home,
    },
    {
        path: "/lottery",
        name: "Lottery",
        component: Lottery,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
