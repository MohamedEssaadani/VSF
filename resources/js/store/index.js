import Vuex from "vuex";
import Vue from "vue";

Vue.use(Vuex);

const storeData = {
    state: {
        users: [],
        customers: [],
        visits: []
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
        //visits
        getVisits: state => state.visits
    },
    mutations: {
        //users
        usersList(state, data) {
            state.users = data;
        },
        deleteUser(state, user) {
            let index = state.users.indexOf(user);
            state.users.splice(index, 1);
        },
        //customers
        customersList(state, data) {
            state.customers = data;
        },
        visits(state, data) {
            state.visits = data;
        }
    },
    actions: {
        //users
        usersList(context) {
            axios
                .get("api/user")
                .then(response => {
                    context.commit("usersList", response.data.data);
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
        customersList(context) {
            axios
                .get("api/customer")
                .then(response => {
                    context.commit("customersList", response.data.data);
                })
                .catch(error => {
                    console.log(`ERROR! ${error}`);
                });
        },
        //visits
        visits(context) {
            axios
                .get("api/visit")
                .then(res => {
                    context.commit("visits", res.data);
                })
                .catch(err => {
                    console.log(`Error! ${err}`);
                });
        }
    }
};
const store = new Vuex.Store(storeData);

export default store;
