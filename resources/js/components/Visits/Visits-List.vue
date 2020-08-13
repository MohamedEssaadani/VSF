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
                    <th class="nosort">
                      <a
                        data-toggle="modal"
                        data-target="#createVisitModal"
                        class="text-green"
                        style="
                                                float: right;
                                                cursor: pointer;
                                              "
                        v-show="
                                                    auth.user.userType ===
                                                        'administrateur'
                                                "
                      >
                        <i class="ik ik-plus-circle text-green"></i>
                        Nouveau
                      </a>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="visit in getVisits.data" :key="visit.id">
                    <th scope="row">{{ visit.id }}</th>
                    <td>{{ visit.type }}</td>
                    <td>{{ visit.price }} DH</td>
                    <td>{{ visit.tva }} %</td>
                    <td>
                      <div class="table-actions">
                        <a
                          style="cursor: pointer; "
                          @click="show(visit)"
                          data-toggle="modal"
                          data-target="#showVisitModal"
                        >
                          <i class="ik ik-eye text-blue"></i>
                        </a>
                        /
                        <a
                          style="cursor: pointer; "
                          @click="edit(visit)"
                          data-toggle="modal"
                          data-target="#editVisitModal"
                        >
                          <i class="ik ik-edit-2 text-green"></i>
                        </a>
                        /
                        <a
                          style="cursor: pointer; "
                          @click="remove(visit)"
                        >
                          <i class="ik ik-trash-2 text-red"></i>
                        </a>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <pagination :data="getVisits" @pagination-change-page="getResults"></pagination>
          </div>
        </div>
      </div>
    </div>
    <!--Edit visit modal-->
    <edit-visit v-show="isEdit" :visit="visit"></edit-visit>
    <!--Create visit modal-->
    <create-visit></create-visit>
    <!--Show visit modal-->
    <show-visit v-show="isShow" :visit="visit"></show-visit>
    <!--Confirm dialog -->
    <vue-confirm-dialog></vue-confirm-dialog>
  </div>
</template>

<script>
import EditVisit from "./Edit-Visit";
import CreateVisit from "./Create-Visit";
import ShowVisit from "./Show-Visit";

export default {
  components: {
    "edit-visit": EditVisit,
    "create-visit": CreateVisit,
    "show-visit": ShowVisit,
  },
  mounted() {
    // this.$store.dispatch("visits");
    this.getResults();
  },
  computed: {
    getVisits() {
      return this.$store.getters.getVisits;
    },
    auth() {
      return this.$store.getters.auth;
    },
  },
  methods: {
    getResults(page = 1) {
      this.$store.dispatch("visits", page);
    },
    edit(visit) {
      this.isEdit = true;
      this.visit = visit;
    },
    show(visit) {
      this.isShow = true;
      this.visit = visit;
    },
    remove(visit) {
      this.$confirm({
        message: `Vous êtes sure?`,
        button: {
          no: "Non",
          yes: "Oui",
        },
        /**
         * Callback Function
         * @param {Boolean} confirm
         */
        callback: (confirm) => {
          if (confirm) {
            this.$store.dispatch("deleteVisit", visit);
          }
        },
      });
    },
  },
  data() {
    return {
      isEdit: false,
      isShow: false,
      visit: {},
    };
  },
};
</script>
