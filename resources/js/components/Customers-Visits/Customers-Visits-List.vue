<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header d-block">
            <h3 style="float:left;">Visites des clients</h3>
          </div>
          <div class="card-body p-0 table-border-style">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>#Matricule</th>
                    <th>Client</th>
                    <th>Visite</th>
                    <th>Date Visite</th>
                    <th>Total</th>
                    <th class="nosort"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="customerVisit in getCustomersVisits" :key="customerVisit.id">
                    <th scope="row">{{ customerVisit.matricule }}</th>
                    <td>{{ customerVisit.full_name }}</td>
                    <td>{{ customerVisit.type }}</td>
                    <td>
                      {{
                      customerVisit.created_at
                      | moment("DD/MM/YYYY")
                      }}
                    </td>
                    <td>{{ customerVisit.total }} DH</td>
                    <td>
                      <div class="table-actions">
                        <a
                          style="cursor: pointer;"
                          data-toggle="modal"
                          data-target="#showCustomerVisitModal"
                          @click="show(customerVisit)"
                        >
                          <i class="ik ik-eye text-blue"></i>
                        </a>
                        /
                        <a
                          style="cursor: pointer;"
                          @click="remove(customerVisit)"
                        >
                          <i class="ik ik-trash-2 text-red"></i>
                        </a>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--Show customer visit details Modal-->
    <show-customer-visit v-show="isShow" :customerVisit="customerVisit"></show-customer-visit>
    <!--Confirm dialog -->
    <vue-confirm-dialog></vue-confirm-dialog>
  </div>
</template>

<script>
import ShowCustomerVisit from "./Show-Customer-Visit";

export default {
  components: {
    "show-customer-visit": ShowCustomerVisit,
  },
  mounted() {
    this.$store.dispatch("getCustomersVisits");
  },
  computed: {
    getCustomersVisits() {
      return this.$store.getters.getCustomersVisits;
    },
  },
  methods: {
    show(customerVisit) {
      this.isShow = true;
      this.customerVisit = customerVisit;
    },
    remove(customerVisit) {
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
            this.$store.dispatch("deleteCustomerVisit", customerVisit);
          }
        },
      });
    },
  },
  data() {
    return {
      customerVisit: {},
      isShow: false,
    };
  },
};
</script>
