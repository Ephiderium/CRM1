import { createWebHistory, createRouter } from "vue-router";

const routes = [
    {
        path: "/login",
        name: "login",
        component: () => import("@/components/auth/LoginView.vue")
    },
    {
        path: "/admin",
        name: "admin-cabinet",
        component: () => import("@/components/users/AdminCabinetView.vue")
    },
    {
        path: "/user",
        name: "user-cabinet",
        component: () => import("@/components/users/UserCabinetView.vue")
    },
    {
        path: "/user/:id",
        name: "find-user",
        component: () => import("@/components/users/UserView.vue")
    },
    {
        path: "/create-user",
        name: "create-user",
        component: () => import("@/components/users/CreateUserView.vue")
    },
    {
        path: "/update-user/:id",
        name: "update-user",
        component: () => import("@/components/users/UpdateUserView.vue")
    },
    {
        path: "/clients",
        name: "clients",
        component: () => import("@/components/users/AllClientsView.vue")
    },
    {
        path: "/client/:id",
        name: "client",
        component: () => import("@/components/users/ClientView.vue")
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
