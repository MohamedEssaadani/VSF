<template>
  <!-- Modal -->
  <div
    class="modal fade"
    id="editUserModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="editUserModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editUserModalLabel">Modifier Utilisateur</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <label class="col-sm-4 col-lg-4 col-form-label">Nom & Prénom</label>
            <div class="col-sm-8 col-lg-8">
              <div class="input-group">
                <span class="input-group-prepend">
                  <label class="input-group-text">
                    <i class="ik ik-file-text"></i>
                  </label>
                </span>
                <input
                  type="text"
                  name="name"
                  v-model="user.name"
                  class="form-control"
                  :class="{
                                        'is-invalid': form.errors.has('name')
                                    }"
                  required
                />
                <has-error :form="form" field="name"></has-error>
              </div>
            </div>

            <label class="col-sm-4 col-lg-4 col-form-label">Email</label>
            <div class="col-sm-8 col-lg-8">
              <div class="input-group">
                <span class="input-group-prepend">
                  <label class="input-group-text">
                    <i class="ik ik-at-sign"></i>
                  </label>
                </span>
                <input
                  type="text"
                  name="email"
                  v-model="user.email"
                  class="form-control"
                  :class="{
                                        'is-invalid': form.errors.has('email')
                                    }"
                  required
                />
                <has-error :form="form" field="email"></has-error>
              </div>
            </div>

            <label class="col-sm-4 col-lg-4 col-form-label">Type D'utilisateur</label>
            <div class="col-sm-8 col-lg-8">
              <div class="input-group">
                <span class="input-group-prepend">
                  <label class="input-group-text">
                    <i class="ik ik-user"></i>
                  </label>
                </span>
                <select
                  class="form-control"
                  v-model="user.userType"
                  name="userType"
                  :class="{
                                        'is-invalid': form.errors.has(
                                            'userType'
                                        )
                                    }"
                >
                  <option value="administrateur">administrateur</option>
                  <option value="utilisateur">user</option>
                </select>
                <has-error :form="form" field="userType"></has-error>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-danger"
            @click="refresh"
            data-dismiss="modal"
          >&times; Annuler</button>

          <button @click="edit" class="btn btn-success" style="float: right;">
            <i class="ik ik-save"></i>
            Enregistrer
          </button>
        </div>
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
        name: "",
        email: "",
        userType: "",
      }),
    };
  },
  props: {
    user: {
      type: Object,
      required: true,
    },
  },

  methods: {
    edit() {
      this.form.name = this.user.name;
      this.form.email = this.user.email;
      this.form.userType = this.user.userType;
      this.form
        .put(`api/user/${this.user.id}`)
        .then(() => {
          this.$store.dispatch("usersList").then(() => {
            // clear data
            this.clear();
            // close modal
            this.closeModal();
          });
        })
        .catch((error) => {
          console.log(`ERROR : ${error}`);
        });
    },
    closeModal() {
      $("#editUserModal").modal("hide");
      $(".modal-backdrop").remove();
    },
    clear() {
      this.form.name = "";
      this.form.email = "";
      this.form.userType = "";
    },
    /*v-model change data of user of the parent component in realtime
    if we clicked annuler then this button will close the modal but changement not canceled
    (changements are in the user object not in our source data) So we fire this method to reload the html table
    if user do not change anything*/
    refresh() {
      this.$store.dispatch("usersList");
    },
  },
};
</script>
