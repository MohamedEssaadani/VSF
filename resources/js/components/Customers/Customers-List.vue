<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-block">
                    <h3 style="float:left;">Clients</h3>
                    <div class="row" style="float:right;">
                        <div>
                            <input
                                type="text"
                                placeholder="rechercher"
                                class="form-control"
                            />
                        </div>
                    </div>
                </div>
                <div class="card-body p-0 table-border-style">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th># Matricule</th>
                                    <th>Nom & Prénom</th>
                                    <th>Téléphone</th>
                                    <th>Visite</th>
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
                                            <i
                                                class="ik ik-plus-circle text-green"
                                            ></i>
                                            Nouveau
                                        </a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="customer in getCustomers"
                                    :key="customer.matricule"
                                >
                                    <th scope="row">
                                        {{ customer.matricule }}
                                    </th>
                                    <td>{{ customer.full_name }}</td>
                                    <td>{{ customer.phone }}</td>
                                    <td>{{ customer.visite_type }}</td>
                                    <td>{{ customer.car_brand }}</td>
                                    <td>
                                        <div class="table-actions">
                                            <a style="cursor: pointer;">
                                                <i
                                                    class="ik ik-eye text-blue"
                                                ></i>
                                            </a>
                                            /
                                            <a style="cursor: pointer;">
                                                <i
                                                    class="ik ik-edit-2 text-green"
                                                ></i>
                                            </a>
                                            /
                                            <a style="cursor: pointer;">
                                                <i
                                                    class="ik ik-trash-2 text-red"
                                                ></i>
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
        <!--Create customer modal-->
        <create-customer></create-customer>
    </div>
</template>

<script>
import CreateCustomer from "./Create-Customer";

export default {
    components: {
        "create-customer": CreateCustomer
    },
    mounted() {
        this.$store.dispatch("customersList");
    },
    computed: {
        getCustomers() {
            let customers = this.$store.getters.getCustomers;

            return customers;
        }
    }
};
</script>
