<template>
  <!-- Modal -->
  <div
    class="modal fade"
    id="showStampModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="showStampModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="showStampModalLabel">Timbre Détails</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <label class="col-sm-4 col-lg-4 col-form-label">Type</label>
            <label class="col-sm-8 col-lg-8 col-form-label">{{ stamp.type }}</label>

            <label class="col-sm-4 col-lg-4 col-form-label">Description</label>
            <label class="col-sm-8 col-lg-8 col-form-label">{{ stamp.description }}</label>

            <label class="col-sm-4 col-lg-4 col-form-label">Prix</label>
            <label class="col-sm-8 col-lg-8 col-form-label">{{ stamp.price }} DH</label>
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
    stamp: {
      type: Object,
      required: true,
    },
  },
};
</script>
