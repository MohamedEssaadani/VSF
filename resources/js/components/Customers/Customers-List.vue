<template>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header d-block">
          <div class="row">
            <div class="col-md-4">
              <h3>Clients</h3>
            </div>
            <div class="col-md-4">
              Exporter :
              <button class="btn btn-outline-danger" @click="exportPDF">
                <i class="fa fa-file-pdf"></i>PDF
              </button>
              <export-excel
                class="btn btn-outline-success"
                :data="this.getCustomers.data"
                :fields="json_fields"
                type="csv"
                name="clients.xls"
              >
                <i class="fa fa-file-excel"></i>Excel
              </export-excel>
            </div>
            <div class="col-md-4">
              <input type="text" placeholder="rechercher" v-model="query" class="form-control" />
            </div>
          </div>
        </div>

        <div class="card-body p-0 table-border-style" v-if="getCustomersNumber > 0">
          <div class="table-responsive">
            <table class="table" id="customers">
              <thead>
                <tr>
                  <th># Matricule</th>
                  <th>Nom & Prénom</th>
                  <th>Téléphone</th>
                  <th>Marque</th>
                  <th class="nosort">
                    <a
                      data-toggle="modal"
                      data-target="#createCustomerModal"
                      class="text-green"
                      style="
                                                    float: right;
                                                    cursor: pointer;
                                                    "
                    >
                      <i class="ik ik-plus-circle text-green"></i>
                      Nouveau
                    </a>
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="customer in getCustomers.data" :key="customer.matricule">
                  <th scope="row">{{ customer.matricule }}</th>
                  <td>{{ customer.full_name }}</td>
                  <td>{{ customer.phone }}</td>
                  <td>{{ customer.car_brand }}</td>
                  <td>
                    <div class="table-actions">
                      <a
                        style="cursor: pointer;"
                        @click="show(customer)"
                        data-toggle="modal"
                        data-target="#showCustomerModal"
                      >
                        <i class="ik ik-eye text-blue"></i>
                      </a>
                      /
                      <a
                        style="cursor: pointer;"
                        @click="edit(customer)"
                        data-toggle="modal"
                        data-target="#editCustomerModal"
                      >
                        <i class="ik ik-edit-2 text-green"></i>
                      </a>
                      /
                      <a style="cursor: pointer;" @click="remove(customer)">
                        <i class="ik ik-trash-2 text-red"></i>
                      </a>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <pagination :data="getCustomers" @pagination-change-page="getResults"></pagination>
        </div>
        <not-available v-else></not-available>
      </div>
    </div>
    <!--Create customer modal-->
    <create-customer></create-customer>
    <!--Edit customer modal-->
    <edit-customer v-if="isEdit" :customer="customer"></edit-customer>
    <!---Show customer modal -->
    <show-customer v-if="isShow" :customer="customer"></show-customer>
    <!--Confirm dialog -->
    <vue-confirm-dialog></vue-confirm-dialog>
  </div>
</template>

<script>
import CreateCustomer from "./Create-Customer";
import EditCustomer from "./Edit-Customer";
import ShowCustomer from "./Show-Customer";
import NotAvailable from "./Not-Available";
import jsPDF from "jspdf";
import "jspdf-autotable";
import JsonExcel from "vue-json-excel";

export default {
  components: {
    "create-customer": CreateCustomer,
    "edit-customer": EditCustomer,
    "show-customer": ShowCustomer,
    "not-available": NotAvailable,
  },
  mounted() {
    // this.$store.dispatch("customersList");
    this.getResults();
  },
  computed: {
    getCustomers() {
      let customers = {};
      //if user type something for filtering
      if (this.query !== "") {
        //filter data
        customers.data = this.$store.getters.getCustomers.data.filter(
          (customer) =>
            JSON.stringify(customer)
              .toLowerCase()
              .indexOf(this.query.toLowerCase()) !== -1
        );
      } //else get all data without filtering
      else customers = this.$store.getters.getCustomers;

      return customers;
    },
    getCustomersNumber() {
      return this.$store.getters.getCustomersNumber;
    },
  },
  methods: {
    exportPDF() {
      const doc = new jsPDF();

      doc.autoTable({ html: "#customers" });

      doc.save("clients.pdf");
    },
    getResults(page = 1) {
      this.$store.dispatch("customersList", page);
    },
    edit(customer) {
      this.isEdit = true;
      this.customer = customer;
    },
    show(customer) {
      this.isShow = true;
      this.customer = customer;
    },
    remove(customer) {
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
            this.$store.dispatch("deleteCustomer", customer);
          }
        },
      });
    },
  },
  data() {
    return {
      isEdit: false,
      isShow: false,
      customer: {},
      query: "",
      //for excel exporting
      json_fields: {
        Matricule: "matricule",
        Client: "full_name",
        Téléphone: "phone",
        Marque: "car_brand",
      },
    };
  },
};
</script>
