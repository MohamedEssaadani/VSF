import VueRouter from "vue-router";
import Vue from "vue";

Vue.use(VueRouter);

const routes = [
    {
        path: "/dashboard",
        component: require("./components/Dashboard/Dashboard.vue").default,
        name: "Dashboard"
    },
    {
        path: "/users",
        component: require("./components/Users/Users-List.vue").default,
        name: "Users.all"
    }
];

const router = new VueRouter({
    mode: "history",
    routes: routes
});

export default router;
