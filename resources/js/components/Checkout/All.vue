<template>
  <div>
    <customers-visits></customers-visits>
    <all-chart></all-chart>
  </div>
</template>

<script>
import CustomersVisits from "../Customers-Visits/Customers-Visits-List";
import Chart from "./Chart-Container";
export default {
  components: {
    "customers-visits": CustomersVisits,
  }
};
</script>
