<template>
  <!-- Modal -->
  <div
    class="modal fade"
    id="editVisitModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="editVisitModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editVisitModalLabel">Modifier Visite</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <label class="col-sm-4 col-lg-4 col-form-label">Type Visite</label>
            <div class="col-sm-8 col-lg-8">
              <div class="input-group">
                <span class="input-group-prepend">
                  <label class="input-group-text">
                    <i class="ik ik-file-text"></i>
                  </label>
                </span>
                <input
                  type="text"
                  name="type"
                  v-model="visit.type"
                  class="form-control"
                  :class="{
                            'is-invalid': form.errors.has('type')
                          }"
                  required
                />
                <has-error :form="form" field="type"></has-error>
              </div>
            </div>

            <label class="col-sm-4 col-lg-4 col-form-label">Prix</label>
            <div class="col-sm-8 col-lg-8">
              <div class="input-group">
                <span class="input-group-prepend">
                  <label class="input-group-text">
                    <i class="ik ik-at-sign"></i>
                  </label>
                </span>
                <input
                  type="text"
                  name="price"
                  v-model="visit.price"
                  @keyup="calculateTotal"
                  class="form-control"
                  :class="{
                            'is-invalid': form.errors.has('price')
                          }"
                  required
                />
                <has-error :form="form" field="price"></has-error>
              </div>
            </div>

            <label class="col-sm-4 col-lg-4 col-form-label">TVA</label>
            <div class="col-sm-8 col-lg-8">
              <div class="input-group">
                <span class="input-group-prepend">
                  <label class="input-group-text">
                    <i class="ik ik-user"></i>
                  </label>
                </span>
                <input
                  type="text"
                  name="tva"
                  v-model="visit.tva"
                  @keyup="calculateTotal"
                  class="form-control"
                  :class="{
                            'is-invalid': form.errors.has('tva')
                          }"
                  required
                />
                <has-error :form="form" field="tva"></has-error>
              </div>
            </div>

            <label class="col-sm-4 col-lg-4 col-form-label">Narfa</label>
            <div class="col-sm-8 col-lg-8">
              <div class="input-group">
                <span class="input-group-prepend">
                  <label class="input-group-text">
                    <i class="ik ik-user"></i>
                  </label>
                </span>
                <input
                  type="text"
                  name="tva"
                  v-model="visit.narfa"
                  @keyup="calculateTotal"
                  class="form-control"
                  :class="{
                            'is-invalid': form.errors.has('narfa')
                          }"
                  required
                />
                <has-error :form="form" field="narfa"></has-error>
              </div>
            </div>

            <label class="col-sm-4 col-lg-4 col-form-label">Kitonce</label>
            <div class="col-sm-8 col-lg-8">
              <div class="input-group">
                <span class="input-group-prepend">
                  <label class="input-group-text">
                    <i class="ik ik-user"></i>
                  </label>
                </span>
                <input
                  type="text"
                  name="kitonse"
                  v-model="visit.kitonse"
                  @keyup="calculateTotal"
                  class="form-control"
                  :class="{
                            'is-invalid': form.errors.has('kitonse')
                          }"
                  required
                />
                <has-error :form="form" field="kitonse"></has-error>
              </div>
            </div>

            <label class="col-sm-4 col-lg-4 col-form-label">Local</label>
            <div class="col-sm-8 col-lg-8">
              <div class="input-group">
                <span class="input-group-prepend">
                  <label class="input-group-text">
                    <i class="ik ik-user"></i>
                  </label>
                </span>
                <input
                  type="text"
                  name="local"
                  v-model="visit.local"
                  @keyup="calculateTotal"
                  class="form-control"
                  :class="{
                         'is-invalid': form.errors.has('local')
                      }"
                  required
                />
                <has-error :form="form" field="local"></has-error>
              </div>
            </div>

            <label class="col-sm-4 col-lg-4 col-form-label">Total</label>
            <div class="col-sm-8 col-lg-8">
              <div class="input-group">
                <span class="input-group-prepend">
                  <label class="input-group-text">
                    <i class="ik ik-user"></i>
                  </label>
                </span>
                <input type="text" name="total" v-model="visit.total" class="form-control" disabled />
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
  props: {
    visit: {},
  },
  data() {
    return {
      form: new Form({
        type: "",
        price: 0,
        tva: 0,
        narfa: 0,
        kitonse: 0,
        local: 0,
        total: 0,
      }),
    };
  },
  methods: {
    //calculate total when a price changed
    calculateTotal() {
      let tva = this.visit.tva / 100;
      let ttc = this.visit.price * tva;
      let total =
        ttc + this.visit.narfa + this.visit.kitonse + this.visit.local;
      this.visit.total = total;
    },
    edit() {
      this.form.type = this.visit.type;
      this.form.price = this.visit.price;
      this.form.tva = this.visit.tva;
      this.form.narfa = this.visit.narfa;
      this.form.kitonse = this.visit.kitonse;
      this.form.local = this.visit.local;
      this.form.total = this.visit.total;

      this.form
        .put(`api/visit/${this.visit.id}`)
        .then(() => {
          this.$store.dispatch("visits").then((res) => {
            console.log(res);
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
      $("#editVisitModal").modal("hide");
      $(".modal-backdrop").remove();
    },
    clear() {
      this.form.type = "";
      this.form.price = 0;
      this.form.tva = 0;
      this.form.narfa = 0;
      this.form.kitonse = 0;
      this.form.local = 0;
    },
    /*v-model change data of user of the parent component in realtime
    if we clicked annuler then this button will close the modal but changement not canceled
    (changements are in the user object not in our source data) So we fire this method to reload the html table
    if user do not change anything*/
    refresh() {
      this.$store.dispatch("visits");
    },
  },
};
</script>
