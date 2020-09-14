<template>
  <div class="container">
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
