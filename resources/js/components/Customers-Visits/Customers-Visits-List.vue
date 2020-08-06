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
                                        v-for="customerVisit in getCustomersVisits"
                                        :key="customerVisit.id"
                                    >
                                        <th scope="row">
                                            {{ customerVisit.matricule }}
                                        </th>
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
                                            <a
                                                style="cursor: pointer; font-size:15px;"
                                                data-toggle="modal"
                                                data-target="#editVisitModal"
                                            >
                                                <i
                                                    class="ik ik-edit-2 text-green"
                                                ></i>
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
    </div>
</template>

<script>
export default {
    mounted() {
        this.$store.dispatch("getCustomersVisits");
    },
    computed: {
        getCustomersVisits() {
            return this.$store.getters.getCustomersVisits;
        }
    }
};
</script>
