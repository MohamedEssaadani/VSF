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
                    <i class="ik ik-terminal"></i>
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
                    <i class="ik ik-terminal"></i>
                  </label>
                </span>
                <input
                  type="text"
                  name="price"
                  v-model="visit.price"
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
                    <i class="ik ik-terminal"></i>
                  </label>
                </span>
                <input
                  type="text"
                  name="tva"
                  v-model="visit.tva"
                  class="form-control"
                  :class="{
                            'is-invalid': form.errors.has('tva')
                          }"
                  required
                />
                <has-error :form="form" field="tva"></has-error>
              </div>
            </div>

            <label class="col-sm-4 col-lg-4 col-form-label">Timbres</label>
            <div class="col-sm-8 col-lg-8">
              <div class="input-group">
                <span class="input-group-prepend">
                  <label class="input-group-text">
                    <i class="ik ik-terminal"></i>
                  </label>
                </span>
                <select
                  name="timbres"
                  class="form-control"
                  v-model="selectedStamps"
                  multiple
                  :class="{
                            'is-invalid': form.errors.has('timbre')
                          }"
                  required
                >
                  <option v-for="stamp in getStamps" :key="stamp.id" :value="stamp">{{stamp.type}}</option>
                  <!--  @click="addStamp(stamp.id)"-->
                </select>
                <has-error :form="form" field="timbre"></has-error>
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
  mounted() {
    this.$store.dispatch("getStamps");
  },
  computed: {
    getStamps() {
      return this.$store.getters.getStamps;
    },
  },
  methods: {
    //calculate total when a price changed
    // calculateTotal() {
    //   let tva = this.visit.tva / 100;
    //   let ttc = this.visit.price * tva;
    //   this.selectedStamps.forEach((stamp) => {
    //     console.log(stamp.price);
    //   });
    //   // let total = ttc + stampsTotal;
    //   // console.log(total);
    //   //this total is for customer
    // },
    edit() {
      this.form.type = this.visit.type;
      this.form.price = this.visit.price;
      this.form.tva = this.visit.tva;
      this.form.stamps = this.selectedStamps.map((stamp) => stamp.id);
      this.form
        .put(`api/visit/${this.visit.id}`)
        .then(() => {
          this.$store.dispatch("visits").then((res) => {
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
    // addStamp(id) {
    //   if (!this.selectedStamps.find((item) => item == id))
    //     this.selectedStamps.push(id);
    // },
  },
  data() {
    return {
      form: new Form({
        type: "",
        price: 0,
        tva: 0,
      }),
      selectedStamps: [],
    };
  },
};
</script>
