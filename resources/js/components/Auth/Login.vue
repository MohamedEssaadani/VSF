<template>
  <div>
    <div class="card">
      <div class="card-header">
        <h6>Authentification</h6>
      </div>
      <div class="card-body">
        <form @submit.prevent="login">
          <div class="row">
            <label class="col-sm-4 col-lg-4 col-form-label">Email</label>
            <div class="col-sm-6 col-lg-6">
              <div class="input-group">
                <span class="input-group-prepend">
                  <label class="input-group-text">
                    <i class="ik ik-terminal"></i>
                  </label>
                </span>
                <input type="text" v-model="email" class="form-control" />
              </div>
            </div>
          </div>
          <div class="row">
            <label class="col-sm-4 col-lg-4 col-form-label">Password</label>
            <div class="col-sm-6 col-lg-6">
              <div class="input-group">
                <span class="input-group-prepend">
                  <label class="input-group-text">
                    <i class="ik ik-terminal"></i>
                  </label>
                </span>
                <input type="password" v-model="password" class="form-control" />
              </div>
            </div>
          </div>
          <button
            type="submit"
            class="btn btn-dark"
            style="float: right;
                   margin-right: 170px;"
          >Connecter</button>
        </form>
      </div>
    </div>
  </div>
</template>


<script>
export default {
  data() {
    return {
      email: "",
      password: "",
    };
  },

  methods: {
    login() {
      this.$store
        .dispatch("login", {
          email: this.email,
          password: this.password,
        })
        .then(() => {
          this.$router.push({ name: "Dashboard" });
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>