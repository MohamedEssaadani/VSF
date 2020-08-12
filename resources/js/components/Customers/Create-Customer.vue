<template>
    <!-- Modal -->
    <div
        class="modal fade"
        id="createCustomerModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="createCustomerModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createCustomerModalLabel">
                        Nouveau Client
                    </h5>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <label class="col-sm-4 col-lg-4 col-form-label"
                            >Matricule</label
                        >
                        <div class="col-sm-8 col-lg-8">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <label class="input-group-text">
                                        <i class="ik ik-terminal"></i>
                                    </label>
                                </span>
                                <input
                                    type="text"
                                    v-model="form.matricule"
                                    @keyup="fillIfExits"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'matricule'
                                        )
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="matricule"
                                ></has-error>
                            </div>
                        </div>

                        <label class="col-sm-4 col-lg-4 col-form-label"
                            >Nom & Prénom</label
                        >
                        <div class="col-sm-8 col-lg-8">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <label class="input-group-text">
                                        <i class="ik ik-terminal"></i>
                                    </label>
                                </span>
                                <input
                                    type="text"
                                    v-model="form.full_name"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'full_name'
                                        )
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="full_name"
                                ></has-error>
                            </div>
                        </div>

                        <label class="col-sm-4 col-lg-4 col-form-label"
                            >Téléphone</label
                        >
                        <div class="col-sm-8 col-lg-8">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <label class="input-group-text">
                                        <i class="ik ik-terminal"></i>
                                    </label>
                                </span>
                                <input
                                    type="number"
                                    v-model="form.phone"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has('phone')
                                    }"
                                    required
                                />
                                <has-error
                                    :form="form"
                                    field="phone"
                                ></has-error>
                            </div>
                        </div>

                        <label class="col-sm-4 col-lg-4 col-form-label"
                            >Marque</label
                        >
                        <div class="col-sm-8 col-lg-8">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <label class="input-group-text">
                                        <i class="ik ik-terminal"></i>
                                    </label>
                                </span>
                                <input
                                    class="form-control"
                                    v-model="form.car_brand"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'car_brand'
                                        )
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="car_brand"
                                ></has-error>
                            </div>
                        </div>

                        <label class="col-sm-4 col-lg-4 col-form-label"
                            >Visite</label
                        >
                        <div class="col-sm-8 col-lg-8">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <label class="input-group-text">
                                        <i class="ik ik-terminal"></i>
                                    </label>
                                </span>

                                <select
                                    class="form-control"
                                    v-model="form.visit"
                                    :class="{
                                        'is-invalid': form.errors.has('visit')
                                    }"
                                >
                                    <option
                                        v-for="visit in getVisits"
                                        :key="visit.id"
                                        :value="visit.id"
                                        >{{ visit.type }}</option
                                    >>
                                </select>
                                <has-error
                                    :form="form"
                                    field="visit"
                                ></has-error>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-danger"
                        data-dismiss="modal"
                    >
                        &times; Annuler
                    </button>

                    <button
                        @click="add"
                        class="btn btn-success"
                        style="float: right;"
                    >
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
    data() {
        return {
            form: new Form({
                matricule: "",
                full_name: "",
                phone: "",
                car_brand: "",
                visit: undefined
            })
        };
    },
    mounted() {
        this.$store.dispatch("visits");
    },
    computed: {
        getVisits() {
            return this.$store.getters.getVisits;
        }
    },
    methods: {
        add() {
            this.form.phone = this.form.phone.toString();
            this.form
                .post("api/customer")
                .then(() => {
                    this.$store.dispatch("customersList").then(() => {
                        // clear data
                        this.clear();
                        // close modal
                        this.closeModal();
                    });
                })
                .catch(err => {
                    console.log(`ERROR! ${err}`);
                });
        },
        closeModal() {
            $("#createCustomerModal").modal("hide");
            $(".modal-backdrop").remove();
        },
        clear() {
            this.form.matricule = "";
            this.form.full_name = "";
            this.form.phone = "";
            this.form.visite_type = undefined;
            this.form.car_brand = "";
        },
        fillIfExits(matricule) {
            //if user fill some characters in matricule
            if (this.form.matricule.length > 0) {
                //we get customer with (matricule)
                let customer = this.$store.getters.getCustomers.find(
                    customer => customer.matricule == this.form.matricule
                );
                //check if customer is not undefined
                if (customer !== undefined) {
                    this.form.full_name = customer.full_name;
                    this.form.phone = customer.phone;
                    this.form.car_brand = customer.car_brand;
                }
            }
        }
    }
};
</script>
