<template>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header d-block">
          <h3>Utilisateurs</h3>
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
                  <th class="nosort">
                    <a
                      data-toggle="modal"
                      data-target="#createUserModal"
                      class="text-green"
                      style="float:right; cursor:pointer;"
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
                  <td>
                    <div class="table-actions">
                      <a href>
                        <i class="ik ik-eye text-blue"></i>
                      </a>
                      /
                      <a href>
                        <i class="ik ik-edit-2 text-green"></i>
                      </a>
                      /
                      <a
                        href
                        onclick="return confirm('Vous êtes de supprimer cet utilisateur?');"
                      >
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
    <!--Create user modal-->
    <create-user></create-user>
  </div>
</template>

<script>
import CreateUser from "./Create-User";

export default {
  components: {
    "create-user": CreateUser
  },
  mounted() {
    this.$store.dispatch("usersList");
  },
  computed: {
    getUsers() {
      return this.$store.getters.getUsers;
    }
  }
};
</script>
