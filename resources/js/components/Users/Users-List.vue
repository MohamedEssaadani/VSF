<template>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header d-block">
          <h3 style="float:left;">Utilisateurs</h3>
          <div class="row" style="float:right;">
            <div>
              <input type="text" placeholder="rechercher" v-model="query" class="form-control" />
            </div>
          </div>
        </div>

        <div class="card-body p-0 table-border-style">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nom</th>
                  <th>E-mail</th>
                  <th>Type D'utilisateur</th>
                  <th class="nosort" v-show="auth.user.userType === 'administrateur'">
                    <a
                      data-toggle="modal"
                      data-target="#createUserModal"
                      class="text-green"
                      style="
                                                float: right;
                                                cursor: pointer;
                                            "
                    >
                      <i class="ik ik-plus-circle text-green"></i>
                      Nouveau
                    </a>
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="user in getUsers" :key="user.id">
                  <th scope="row">{{ user.id }}</th>
                  <td>{{ user.name }}</td>
                  <td>{{ user.email }}</td>
                  <td>{{ user.userType }}</td>
                  <td v-show="auth.user.userType === 'administrateur'">
                    <div class="table-actions">
                      <a
                        style="cursor: pointer;"
                        data-toggle="modal"
                        data-target="#showUserModal"
                        @click="show(user)"
                      >
                        <i class="ik ik-eye text-blue"></i>
                      </a>
                      /
                      <a
                        style="cursor: pointer;"
                        data-toggle="modal"
                        data-target="#editUserModal"
                        v-show="auth.user.userType ==='administrateur'"
                        @click="edit(user)"
                      >
                        <i class="ik ik-edit-2 text-green"></i>
                      </a>
                      /
                      <a @click="remove(user)" style="cursor: pointer;">
                        <i class="ik ik-trash-2 text-red"></i>
                      </a>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!--Create  modal-->
    <create-user></create-user>
    <!---Edit modal-->
    <edit-user v-if="isEdit" :user="user"></edit-user>
    <!---Show modal-->
    <show-user v-if="isShow" :user="user"></show-user>
    <!--Confirm dialog -->
    <vue-confirm-dialog></vue-confirm-dialog>
  </div>
</template>

<script>
import CreateUser from "./Create-User";
import EditUser from "./Edit-User";
import ShowUser from "./Show-User";

export default {
  data() {
    return {
      user: null,
      isEdit: false,
      isShow: false,
      query: "",
    };
  },
  components: {
    "create-user": CreateUser,
    "edit-user": EditUser,
    "show-user": ShowUser,
  },
  mounted() {
    this.$store.dispatch("usersList");
  },
  methods: {
    remove(user) {
      this.$confirm({
        message: `Vous êtes sure?`,
        button: {
          no: "Non",
          yes: "Oui",
        },
        /**
         * Callback Function
         * @param {Boolean} confirm
         */
        callback: (confirm) => {
          if (confirm) {
            this.$store.dispatch("deleteUser", user);
          }
        },
      });
    },
    edit(user) {
      this.isEdit = true;
      this.user = user;
    },
    show(user) {
      this.isShow = true;
      this.user = user;
    },
  },
  computed: {
    getUsers() {
      let users = undefined;
      //if user type something for filtering
      if (this.query !== "") {
        //filter data
        users = this.$store.getters.getUsers.filter(
          (user) =>
            JSON.stringify(user)
              .toLowerCase()
              .indexOf(this.query.toLowerCase()) !== -1
        );
      } //else get all data without filtering
      else users = this.$store.getters.getUsers;
      return users;
    },
    auth() {
      return this.$store.getters.auth;
    },
  },
};
</script>
