<template>
  <div class="container">
    <div style="background-color:#ffffff;">
      <button class="btn btn-primary">Tous</button>
      <button class="btn btn-primary">Client</button>
      <button class="btn btn-primary">Type Visite</button>
      <button class="btn btn-primary">Date</button>
    </div>

    <revenues-chart></revenues-chart>
  </div>
</template>

<script>
import RevenuesChart from "./Revenues-Chart.vue";
export default {
  components: {
    "revenues-chart": RevenuesChart,
  },
};
</script>
