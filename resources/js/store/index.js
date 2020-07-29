import Vuex from "vuex";
import Vue from "vue";

Vue.use(Vuex);

const storeData = {
    state: {
        users: []
    },
    getters: {
        //users
        getUsers(state) {
            return state.users;
        },
        getUser: state => id => {
            return state.users.find(user => user.id === id);
        }
    },
    mutations: {
        //users
        usersList(state, data) {
            state.users = data;
        },
        deleteUser(state, user) {
            let index = state.users.indexOf(user);
            state.users.splice(index, 1);
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
        }
    }
};
const store = new Vuex.Store(storeData);

export default store;
