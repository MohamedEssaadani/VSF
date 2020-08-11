<template>
    <!-- Modal -->
    <div
        class="modal fade"
        id="createStampModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="createStampModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createStampModalLabel">
                        Nouveau Timbre
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
                            >Type</label
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
                                    v-model="form.type"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has('type')
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="type"
                                ></has-error>
                            </div>
                        </div>

                        <label class="col-sm-4 col-lg-4 col-form-label"
                            >Description</label
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
                                    v-model="form.description"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'description'
                                        )
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="description"
                                ></has-error>
                            </div>
                        </div>

                        <label class="col-sm-4 col-lg-4 col-form-label"
                            >Prix</label
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
                                    v-model="form.price"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has('price')
                                    }"
                                    required
                                />
                                <has-error
                                    :form="form"
                                    field="price"
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
                type: "",
                description: "",
                price: 0
            })
        };
    },
    methods: {
        add() {
            this.form
                .post("api/stamp")
                .then(() => {
                    this.$store.dispatch("getStamps").then(() => {
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
            $("#createStampModal").modal("hide");
            $(".modal-backdrop").remove();
        },
        clear() {
            this.form.type = "";
            this.form.description = "";
            this.form.price = 0;
        }
    }
};
</script>
