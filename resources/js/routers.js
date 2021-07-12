import Vue from "vue";
import VueRouter from "vue-router";
import Dashboard from "./components/Dashboard";
import Profile from "./components/Profile";
import Users from "./components/Users";
import Developer from "./components/Developer";
import NotFound from "./components/NotFound";
Vue.use(VueRouter);

const routes = [
    {
        path: "/dashboard",
        name: "Dashboard",
        component: Dashboard
    },
    {
        path: "/profile",
        name: "Profile",
        component: Profile
    },
    {
        path: "/users",
        name: "Users",
        component: Users
    },
    {
        path: "/developer",
        name: "Developer",
        component: Developer
    },
    {
        path: "*",
        name: "NotFound",
        component: NotFound
    },
];

const router = new VueRouter({
     mode: "history",

    // base: process.env.BASE_URL,
    routes
});

export default router;

