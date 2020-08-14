import Vuex from "vuex";
import Vue from "vue";

Vue.use(Vuex);

const storeData = {
    state: {
        users: {},
        customers: {},
        visits: {},
        stamps: {},
        customersVisits: [],
        //for auth
        user: null
    },
    getters: {
        //users
        getUsers: state => state.users,
        getUser: state => id => {
            return state.users.find(user => user.id === id);
        },
        //customers
        getCustomers: state => state.customers,
        getCustomer: state => id => {
            return state.customers.find(customer => customer.id == id);
        },
        getCustomersNumber: (state, getters) => getters.getCustomers.total,
        //visits
        getVisits: state => state.visits,
        //stamps
        getStamps: state => state.stamps,
        getStampsNumber: (state, getters) => getters.getStamps.total,
        //customers visits
        getCustomersVisits: state => state.customersVisits,
        //auth
        isLogged: state => !!state.user,
        auth: state => state.user
    },
    mutations: {
        //users
        usersList(state, data) {
            state.users = data;
        },
        deleteUser(state, user) {
            let index = state.users.data.indexOf(user);
            state.users.data.splice(index, 1);
        },
        //customers
        customersList(state, data) {
            state.customers = data;
        },
        deleteCustomer(state, customer) {
            let index = state.customers.data.indexOf(customer);
            state.customers.data.splice(index, 1);
        },
        //visits
        visits(state, data) {
            state.visits = data;
        },
        deleteVisit(state, visit) {
            let index = state.visits.indexOf(visit);
            state.visits.splice(index, 1);
        },
        //stamps
        getStamps(state, data) {
            state.stamps = data;
        },
        deleteStamp(state, stamp) {
            let index = state.stamps.indexOf(stamp);
            state.stamps.splice(index, 1);
        },
        //customers visits
        getCustomersVisits(state, data) {
            state.customersVisits = data;
        },
        deleteCustomerVisit(state, customerVisit) {
            let index = state.customersVisits.indexOf(customerVisit);
            state.customersVisits.splice(index, 1);
        },
        //auth
        setUserData(state, userData) {
            state.user = userData;
            localStorage.setItem("user", JSON.stringify(userData));
            axios.defaults.headers.common.Authorization = `Bearer ${userData.token}`;
        },
        clearUserData() {
            localStorage.removeItem("user");
            location.reload();
        }
    },
    actions: {
        //users
        usersList(context, page = 1) {
            axios
                .get(`api/user?page=${page}`)
                .then(response => {
                    context.commit("usersList", response.data);
                })
                .catch(error => {
                    console.log(`ERROR! ${error}`);
                });
        },
        addUser(context, user) {
            axios
                .post("api/user", user)
                .then(() => {
                    context.dispatch("usersList");
                })
                .catch(error => {
                    console.log(`ERROR! ${error}`);
                });
        },
        deleteUser(context, user) {
            axios
                .delete(`api/user/${user.id}`)
                .then(() => {
                    context.commit("deleteUser", user);
                })
                .catch(error => {
                    console.log(`ERROR! ${error}`);
                });
        },
        //customers
        customersList(context, page = 1) {
            axios
                .get(`api/customer?page=${page}`)
                .then(response => {
                    context.commit("customersList", response.data);
                })
                .catch(error => {
                    console.log(`ERROR! ${error}`);
                });
        },
        deleteCustomer(context, customer) {
            axios
                .delete(`api/customer/${customer.matricule}`)
                .then(() => {
                    context.commit("deleteCustomer", customer);
                })
                .catch(error => {
                    console.log(`ERROR! ${error}`);
                });
        },
        //visits
        visits(context, page) {
            axios
                .get(`api/visit?page=${page}`)
                .then(response => {
                    context.commit("visits", response.data);
                })
                .catch(err => {
                    console.log(`Error! ${err}`);
                });
        },
        deleteVisit(context, visit) {
            axios
                .delete(`api/visit/${visit.id}`)
                .then(() => {
                    context.commit("deleteVisit");
                })
                .catch(err => {
                    console.log(`ERROR! ${err}`);
                });
        },
        //stamps
        getStamps(context, page) {
            axios
                .get(`api/stamp?page=${page}`)
                .then(res => {
                    context.commit("getStamps", res.data);
                })
                .catch(err => {
                    console.log(`ERROR : ${err}`);
                });
        },
        deleteStamp(context, stamp) {
            axios
                .delete(`api/stamp/${stamp.id}`)
                .then(() => {
                    context.commit("deleteStamp", stamp);
                })
                .catch(err => {
                    console.log(`ERROR! ${err}`);
                });
        },
        //customers visits
        getCustomersVisits(context) {
            return new Promise((resolve, reject) => {
                axios
                    .get("api/customer_visit")
                    .then(res => {
                        context.commit("getCustomersVisits", res.data.data);
                        resolve();
                    })
                    .catch(err => {
                        console.log(`ERROR! ${err}`);
                    });
            });
        },
        deleteCustomerVisit(context, customerVisit) {
            axios
                .delete(`api/customer_visit/${customerVisit.id}`)
                .then(() => {
                    context.commit("deleteCustomerVisit", customerVisit);
                })
                .catch(err => {
                    console.log(`ERROR! ${err}`);
                });
        },
        //auth
        login({ commit }, form) {
            return form.post("api/login").then(({ data }) => {
                commit("setUserData", data);
            });
        },

        logout({ commit }) {
            commit("clearUserData");
        }
    }
};
const store = new Vuex.Store(storeData);

export default store;
