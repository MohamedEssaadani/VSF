<template>
  <!-- Modal -->
  <div
    class="modal fade"
    id="showCustomerVisitModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="showCustomerVisitModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="showCustomerVisitModalLabel">Customer Visit Détails</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <label class="col-sm-4 col-lg-4 col-form-label">Matricule</label>
            <label class="col-sm-8 col-lg-8 col-form-label">{{ customerVisit.matricule }}</label>

            <label class="col-sm-4 col-lg-4 col-form-label">Nom & Prénom</label>
            <label class="col-sm-8 col-lg-8 col-form-label">{{ customerVisit.full_name }}</label>

            <label class="col-sm-4 col-lg-4 col-form-label">Type de visite</label>
            <label class="col-sm-8 col-lg-8 col-form-label">{{ customerVisit.type }} DH</label>

            <label class="col-sm-4 col-lg-4 col-form-label">Date de visite</label>
            <label class="col-sm-8 col-lg-8 col-form-label">
              {{
              customerVisit.created_at
              | moment("DD/MM/YYYY")
              }}
            </label>

            <label class="col-sm-4 col-lg-4 col-form-label">Total</label>
            <label class="col-sm-8 col-lg-8 col-form-label">{{ customerVisit.total }} DH</label>
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
    customerVisit: {
      type: Object,
      required: true,
    },
  },
};
</script>
