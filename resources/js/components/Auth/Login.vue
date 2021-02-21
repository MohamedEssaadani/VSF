<template>
    <div>
        <div class="card" style="width:60%; margin:0 auto;">
            <div class="card-header">
                <h6>Authentification</h6>
            </div>
            <div class="card-body">
                <form @submit.prevent="login">
                    <div
                        class="alert alert-danger"
                        v-show="credentialsNotMatch !== ''"
                    >
                        <h6>{{ credentialsNotMatch }}</h6>
                    </div>
                    <div class="row">
                        <label class="col-sm-4 col-lg-4 col-form-label"
                            >Email</label
                        >
                        <div class="col-sm-6 col-lg-6">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <label class="input-group-text">
                                        <i class="ik ik-terminal"></i>
                                    </label>
                                </span>
                                <input
                                    type="text"
                                    v-model="form.email"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has('email')
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="email"
                                ></has-error>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-4 col-lg-4 col-form-label"
                            >Password</label
                        >
                        <div class="col-sm-6 col-lg-6">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <label class="input-group-text">
                                        <i class="ik ik-terminal"></i>
                                    </label>
                                </span>
                                <input
                                    type="password"
                                    v-model="form.password"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'password'
                                        )
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="password"
                                ></has-error>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-md-8"></div>
                      <div class="col-md-4">
                            <button
                        type="submit"
                        class="btn btn-dark"
                  
                      >
                        Connecter
                    </button>
                      </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { Form } from "vform";
export default {
    data() {
        return {
            form: new Form({
                email: "",
                password: ""
            }),
            credentialsNotMatch: ""
        };
    },

    methods: {
        login() {
            this.$store
                .dispatch("login", this.form)
                .then(() => {
                    this.$router.push({ name: "Customers.all" });
                })
                .catch(err => {
                    if (err.response.status === 404) {
                        this.credentialsNotMatch = err.response.data.message.toString();
                    }
                });
        }
    }
};
</script>
