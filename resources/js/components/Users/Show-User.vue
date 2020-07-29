<template>
    <!-- Modal -->
    <div
        class="modal fade"
        id="showUserModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="showUserModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">
                        Utilisateur Détails
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
                        <label class="col-sm-8 col-lg-8 col-form-label">
                            {{ user.name }}
                        </label>

                        <label class="col-sm-4 col-lg-4 col-form-label"
                            >Email</label
                        >
                        <label class="col-sm-8 col-lg-8 col-form-label">
                            {{ user.email }}
                        </label>
                        <label class="col-sm-4 col-lg-4 col-form-label"
                            >Type D'utilisateur</label
                        >
                        <label class="col-sm-8 col-lg-8 col-form-label">
                            {{ user.userType }}
                        </label>

                        <label class="col-sm-4 col-lg-4 col-form-label">
                            Date Création
                        </label>
                        <label class="col-sm-8 col-lg-8 col-form-label">
                            {{ user.created_at | moment("DD/MM/YYYY") }}
                        </label>
                    </div>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        user: {
            type: Object,
            required: true
        }
    }
};
</script>
