<template>
  <!-- Modal -->
  <div
    class="modal fade"
    id="editStampModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="editStampModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editStampModalLabel">Modifier Timbre</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <label class="col-sm-4 col-lg-4 col-form-label">Type</label>
            <div class="col-sm-8 col-lg-8">
              <div class="input-group">
                <span class="input-group-prepend">
                  <label class="input-group-text">
                    <i class="ik ik-terminal"></i>
                  </label>
                </span>
                <input
                  type="text"
                  name="type"
                  v-model="stamp.type"
                  class="form-control"
                  :class="{
                           'is-invalid': form.errors.has('type')
                          }"
                />
                <has-error :form="form" field="type"></has-error>
              </div>
            </div>

            <label class="col-sm-4 col-lg-4 col-form-label">Description</label>
            <div class="col-sm-8 col-lg-8">
              <div class="input-group">
                <span class="input-group-prepend">
                  <label class="input-group-text">
                    <i class="ik ik-terminal"></i>
                  </label>
                </span>
                <input
                  type="text"
                  name="description"
                  v-model="stamp.description"
                  class="form-control"
                  :class="{
                           'is-invalid': form.errors.has('description')
                          }"
                />
                <has-error :form="form" field="description"></has-error>
              </div>
            </div>

            <label class="col-sm-4 col-lg-4 col-form-label">Prix</label>
            <div class="col-sm-8 col-lg-8">
              <div class="input-group">
                <span class="input-group-prepend">
                  <label class="input-group-text">
                    <i class="ik ik-terminal"></i>
                  </label>
                </span>
                <input
                  type="number"
                  name="price"
                  v-model="stamp.price"
                  class="form-control"
                  :class="{
                          'is-invalid': form.errors.has('price')
                           }"
                  required
                />
                <has-error :form="form" field="price"></has-error>
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

          <button class="btn btn-success" @click="edit" style="float: right;">
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
        type: "",
        description: "",
        price: 0,
      }),
    };
  },
  props: {
    stamp: {
      type: Object,
      required: true,
    },
  },
  methods: {
    edit() {
      this.form.type = this.stamp.type;
      this.form.description = this.stamp.description;
      this.form.price = this.stamp.price;

      this.form
        .put(`api/stamp/${this.stamp.id}`)
        .then(() => {
          this.$store.dispatch("getStamps").then(() => {
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
      $("#editStampModal").modal("hide");
      $(".modal-backdrop").remove();
    },
    clear() {
      this.form.type = "";
      this.form.description = "";
      this.form.price = 0;
    },
    /*v-model change data of user of the parent component in realtime
      if we clicked annuler then this button will close the modal but changement not canceled
      (changements are in the user object not in our source data) So we fire this method to reload the html table
      if user do not change anything*/
    refresh() {
      this.$store.dispatch("getStamps");
    },
  },
};
</script>
