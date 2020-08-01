<template>
  <!-- Modal -->
  <div
    class="modal fade"
    id="editCustomerModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="editCustomerModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editCustomerModalLabel">Modifier Client</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <label class="col-sm-4 col-lg-4 col-form-label">Matricule</label>
            <div class="col-sm-8 col-lg-8">
              <div class="input-group">
                <span class="input-group-prepend">
                  <label class="input-group-text">
                    <i class="ik ik-terminal"></i>
                  </label>
                </span>
                <input
                  type="text"
                  name="matricule"
                  v-model="customer.matricule"
                  class="form-control"
                  :class="{
                           'is-invalid': form.errors.has('matricule')
                          }"
                />
                <has-error :form="form" field="matricule"></has-error>
              </div>
            </div>

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
                  name="full_name"
                  v-model="customer.full_name"
                  class="form-control"
                  :class="{
                           'is-invalid': form.errors.has('full_name')
                          }"
                />
                <has-error :form="form" field="full_name"></has-error>
              </div>
            </div>

            <label class="col-sm-4 col-lg-4 col-form-label">Téléphone</label>
            <div class="col-sm-8 col-lg-8">
              <div class="input-group">
                <span class="input-group-prepend">
                  <label class="input-group-text">
                    <i class="ik ik-at-sign"></i>
                  </label>
                </span>
                <input
                  type="number"
                  name="phone"
                  v-model="customer.phone"
                  class="form-control"
                  :class="{
                          'is-invalid': form.errors.has('phone')
                           }"
                  required
                />
                <has-error :form="form" field="phone"></has-error>
              </div>
            </div>

            <!-- <label class="col-sm-4 col-lg-4 col-form-label">Visite</label>
            <div class="col-sm-8 col-lg-8">
              <div class="input-group">
                <span class="input-group-prepend">
                  <label class="input-group-text">
                    <i class="ik ik-terminal"></i>
                  </label>
                </span>

                <select
                  class="form-control"
                  v-model="form.visite_type"
                  :class="{
                                        'is-invalid': form.errors.has(
                                            'visite_type'
                                        )
                                    }"
                >
                  <option
                    v-for="visit in getVisits"
                    :key="visit.id"
                    :value="visit.id"
                  >{{ visit.type }}</option>>
                </select>
                <has-error :form="form" field="visite"></has-error>
              </div>
            </div>-->

            <label class="col-sm-4 col-lg-4 col-form-label">Marque</label>
            <div class="col-sm-8 col-lg-8">
              <div class="input-group">
                <span class="input-group-prepend">
                  <label class="input-group-text">
                    <i class="ik ik-user"></i>
                  </label>
                </span>
                <input
                  class="form-control"
                  name="car_brand"
                  v-model="customer.car_brand"
                  :class="{
                            'is-invalid': form.errors.has('car_brand')
                          }"
                />
                <has-error :form="form" field="car_brand"></has-error>
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
        matricule: "",
        full_name: "",
        phone: "",
        car_brand: "",
      }),
    };
  },
  props: {
    customer: {
      type: Object,
      required: true,
    },
  },
  methods: {
    edit() {
      this.form.matricule = this.customer.matricule;
      this.form.full_name = this.customer.full_name;
      this.form.phone = this.customer.phone;
      this.form.car_brand = this.customer.car_brand;
      this.form
        .put(`api/customer/${this.customer.matricule}`)
        .then(() => {
          this.$store.dispatch("customersList").then(() => {
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
      $("#editCustomerModal").modal("hide");
      $(".modal-backdrop").remove();
    },
    clear() {
      this.form.matricule = "";
      this.form.full_name = "";
      this.form.phone = "";
      this.form.car_brand = "";
    },
    /*v-model change data of user of the parent component in realtime
      if we clicked annuler then this button will close the modal but changement not canceled
      (changements are in the user object not in our source data) So we fire this method to reload the html table
      if user do not change anything*/
    refresh() {
      this.$store.dispatch("customersList");
    },
  },
};
</script>
