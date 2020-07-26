<template>
    <!-- Modal -->
    <div
        class="modal fade"
        id="createUserModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="createUserModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createUserModalLabel">
                        Nouveau Utilisateur
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
                            >Nom & Prénom</label
                        >
                        <div class="col-sm-8 col-lg-8">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <label class="input-group-text">
                                        <i class="ik ik-file-text"></i>
                                    </label>
                                </span>
                                <input
                                    type="text"
                                    name="name"
                                    class="form-control"
                                    required
                                />
                            </div>
                        </div>

                        <label class="col-sm-4 col-lg-4 col-form-label"
                            >Email</label
                        >
                        <div class="col-sm-8 col-lg-8">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <label class="input-group-text">
                                        <i class="ik ik-at-sign"></i>
                                    </label>
                                </span>
                                <input
                                    type="text"
                                    name="email"
                                    class="form-control"
                                    required
                                />
                            </div>
                        </div>

                        <label class="col-sm-4 col-lg-4 col-form-label"
                            >Type D'utilisateur</label
                        >
                        <div class="col-sm-8 col-lg-8">
                            <div class="input-group">
                                <span class="input-group-prepend">
                                    <label class="input-group-text">
                                        <i class="ik ik-user"></i>
                                    </label>
                                </span>
                                <select>
                                    <option>admin</option>
                                    <option>user</option>
                                </select>
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

                    <button class="btn btn-success" style="float:right;">
                        <i class="ik ik-save"></i>
                        Enregistrer
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {};
</script>
