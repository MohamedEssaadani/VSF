import Vuex from "vuex";
import Vue from "vue";

Vue.use(Vuex);

const storeData = {
    state: {
        users: []
    },
    getters: {
        getUsers(state) {
            return state.users;
        }
    },
    mutations: {
        usersList(state, data) {
            state.users = data;
        }
    },
    actions: {
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
            axios.post("api/post", user).then(response => {});
        }
    }
};
const store = new Vuex.Store(storeData);

export default store;
