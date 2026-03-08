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
        component: () => import("@/components/clients/AllClientsView.vue")
    },
    {
        path: "/client/:id",
        name: "client",
        component: () => import("@/components/clients/ClientView.vue")
    },
    {
        path: "/create-client/",
        name: "create-client",
        component: () => import("@/components/clients/CreateClientView.vue")
    },
    {
        path: "/update-client/:id",
        name: "update-client",
        component: () => import("@/components/clients/UpdateClientView.vue")
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
