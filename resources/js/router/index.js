import { createWebHistory, createRouter } from "vue-router";
import Login from "../components/auth/LoginView.vue";

const routes = [{ path: "/login", component: Login }];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
