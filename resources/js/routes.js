import VueRouter from "vue-router";
import Vue from "vue";

Vue.use(VueRouter);

const routes = [
    // {
    //     path: "/",
    //     component: require("./components/Dashboard/Dashboard.vue").default,
    //     meta: {
    //         auth: true
    //     },
    //     name: "Dashboard"
    // },

    {
        path: "/users",
        component: require("./components/Users/Users-List.vue").default,
        meta: {
            auth: true
        },
        name: "Users.all"
    },
    {
        path: "/customers",
        alias: "/",
        component: require("./components/Customers/Customers-List.vue").default,
        meta: {
            auth: true
        },
        name: "Customers.all"
    },
    {
        path: "/visits",
        component: require("./components/Visits/Visits-List.vue").default,
        meta: {
            auth: true
        },
        name: "Visits.all"
    },
    {
        path: "/customers-visits",
        component: require("./components/Customers-Visits/Customers-Visits-List.vue")
            .default,
        meta: {
            auth: true
        },
        name: "Customers.visits"
    },
    {
        path: "/login",
        component: require("./components/Auth/Login.vue").default,
        name: "Login"
    },
    {
        path: "/revenues",
        component: require("./components/Checkout/Revenues-Chart-Container.vue")
            .default,
        meta: {
            auth: true
        },
        name: "Revenues"
    },
    {
        path: "/stamps",
        component: require("./components/Stamps/Stamps-List").default,
        meta: {
            auth: true
        },
        name: "Stamps.all"
    }
];

const router = new VueRouter({
    mode: "history",
    routes: routes
});

router.beforeEach((to, from, next) => {
    const loggedIn = localStorage.getItem("user");

    if (to.matched.some(record => record.meta.auth) && !loggedIn) {
        next("/login");
        return;
    }
    next();
});
export default router;
