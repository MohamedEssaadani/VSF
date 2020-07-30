<template>
  <!-- Modal -->
  <div
    class="modal fade"
    id="showCustomerModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="showCustomerModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="showCustomerModalLabel">Client Détails</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <label class="col-sm-4 col-lg-4 col-form-label">Matricule</label>
            <label class="col-sm-8 col-lg-8 col-form-label">{{ customer.matricule }}</label>

            <label class="col-sm-4 col-lg-4 col-form-label">Nom & Prénom</label>
            <label class="col-sm-8 col-lg-8 col-form-label">{{ customer.full_name }}</label>

            <label class="col-sm-4 col-lg-4 col-form-label">Téléphone</label>
            <label class="col-sm-8 col-lg-8 col-form-label">{{ customer.phone }}</label>

            <label class="col-sm-4 col-lg-4 col-form-label">Marque de voiture</label>
            <label class="col-sm-8 col-lg-8 col-form-label">{{ customer.car_brand }}</label>
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
    customer: {
      type: Object,
      required: true,
    },
  },
};
</script>
