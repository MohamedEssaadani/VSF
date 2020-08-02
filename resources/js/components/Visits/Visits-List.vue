<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header d-block">
            <h3 style="float:left;">Types des visites</h3>
          </div>
          <div class="card-body p-0 table-border-style">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Type</th>
                    <th>Prix</th>
                    <th>Tva</th>
                    <th>Total</th>
                    <th class="nosort"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="visit in getVisits" :key="visit.id">
                    <th scope="row">{{ visit.id }}</th>
                    <td>{{ visit.type }}</td>
                    <td>{{ visit.price }} DH</td>
                    <td>{{ visit.tva }} %</td>
                    <td>0</td>
                    <td>
                      <a
                        style="cursor: pointer; font-size:15px;"
                        @click="edit(visit)"
                        data-toggle="modal"
                        data-target="#editVisitModal"
                      >
                        <i class="ik ik-edit-2 text-green"></i>
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--Edit visit modal-->
    <edit-visit v-show="isEdit" :visit="visit"></edit-visit>
  </div>
</template>

<script>
import EditVisit from "./Edit-Visit";

export default {
  components: {
    "edit-visit": EditVisit,
  },
  mounted() {
    this.$store.dispatch("visits");
  },
  computed: {
    getVisits() {
      return this.$store.getters.getVisits;
    },
  },
  methods: {
    edit(visit) {
      this.isEdit = true;
      this.visit = visit;
    },
  },
  data() {
    return {
      isEdit: false,
      visit: {},
    };
  },
};
</script>
