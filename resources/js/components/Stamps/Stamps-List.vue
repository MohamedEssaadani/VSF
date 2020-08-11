<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-block">
                    <h3 style="float:left;">Timbres</h3>
                    <div class="row" style="float:right;">
                        <div>
                            <input
                                type="text"
                                placeholder="rechercher"
                                v-model="query"
                                class="form-control"
                            />
                        </div>
                    </div>
                </div>

                <div
                    class="card-body p-0 table-border-style"
                    v-if="getStampsNumber > 0"
                >
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Type</th>
                                    <th>Description</th>
                                    <th>Prix</th>
                                    <th class="nosort">
                                        <a
                                            data-toggle="modal"
                                            data-target="#createStampModal"
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
                                <tr v-for="stamp in getStamps" :key="stamp.id">
                                    <th scope="row">
                                        {{ stamp.id }}
                                    </th>
                                    <td>{{ stamp.type }}</td>
                                    <td>{{ stamp.description }}</td>
                                    <td>{{ stamp.price }} DH</td>
                                    <td>
                                        <div class="table-actions">
                                            <a
                                                style="cursor: pointer;"
                                                data-toggle="modal"
                                                data-target="#showCustomerModal"
                                            >
                                                <i
                                                    class="ik ik-eye text-blue"
                                                ></i>
                                            </a>
                                            /
                                            <a
                                                style="cursor: pointer;"
                                                data-toggle="modal"
                                                data-target="#editCustomerModal"
                                            >
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
                <!--when no stamp available-->
                <not-available v-else></not-available>
                <!--create stamp modal -->
                <create-stamp></create-stamp>
            </div>
        </div>
    </div>
</template>

<script>
import NotAvailable from "./Not-Available";
import CreateStamp from "./Create-Stamp";

export default {
    components: {
        "not-available": NotAvailable,
        "create-stamp": CreateStamp
    },
    mounted() {
        this.$store.dispatch("getStamps");
    },
    computed: {
        getStamps() {
            let stamps = undefined;
            //if user type something for filtering
            if (this.query !== "") {
                //filter data
                stamps = this.$store.getters.getStamps.filter(
                    stamp =>
                        JSON.stringify(stamp)
                            .toLowerCase()
                            .indexOf(this.query.toLowerCase()) !== -1
                );
            } //else get all data without filtering
            else stamps = this.$store.getters.getStamps;

            return stamps;
        },
        getStampsNumber() {
            return this.$store.getters.getStampsNumber;
        }
    },
    methods: {
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
                    yes: "Oui"
                },
                /**
                 * Callback Function
                 * @param {Boolean} confirm
                 */
                callback: confirm => {
                    if (confirm) {
                        this.$store.dispatch("deleteCustomer", customer);
                    }
                }
            });
        }
    },
    data() {
        return {
            isEdit: false,
            isShow: false,
            customer: {},
            query: ""
        };
    }
};
</script>
