<template>
  <!-- Modal -->
  <div
    class="modal fade"
    id="createVisitModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="createVisitModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createVisitModalLabel">Nouveau Visite</h5>
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
                  v-model="form.type"
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
                  v-model="form.price"
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
                  v-model="form.tva"
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
                  <option v-for="stamp in getStamps" :key="stamp.id" :value="stamp">{{ stamp.type }}</option>
                  <!--  @click="addStamp(stamp.id)"-->
                </select>
                <has-error :form="form" field="timbre"></has-error>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">&times; Annuler</button>

          <button @click="add" class="btn btn-success" style="float: right;">
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
  mounted() {
    this.$store.dispatch("getStamps");
  },
  computed: {
    getStamps() {
      return this.$store.getters.getStamps;
    },
  },
  methods: {
    add() {
      this.form.stamps = this.selectedStamps.map((stamp) => stamp.id);
      this.form
        .post(`api/visit`)
        .then(() => {
          this.$store.dispatch("visits").then(() => {
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
      $("#createVisitModal").modal("hide");
      $(".modal-backdrop").remove();
    },
    clear() {
      this.form.type = "";
      this.form.price = 0;
      this.form.tva = 0;
      this.selectedStamps = [];
    },
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
