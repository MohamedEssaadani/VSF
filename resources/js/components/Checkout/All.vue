<template>
    <div>
        <customers-visits></customers-visits>
        <h3 style="background-color:#ffffff;"></h3>
        <div class="container">
            <line-chart :data="visits"></line-chart>
        </div>
    </div>
</template>

<script>
import CustomersVisits from "../Customers-Visits/Customers-Visits-List";

export default {
    components: {
        "customers-visits": CustomersVisits
    },
    async created() {
        await this.$store.dispatch("getCustomersVisits");

        this.visits = this.$store.getters.getCustomersVisits.data;
        let chartData = [];
        this.visits.forEach(item => {
            let check = undefined;
            check = chartData.find(obj => item.created_at === obj.created_at);
            if (check !== undefined) {
                check.total += item.total;
                let index = chartData.findIndex(
                    x => x.created_at == check.created_at
                );
                chartData[index] = check;
            } else chartData.push([item.created_at, item.total]);
        });
        console.log(chartData);
        this.visits = chartData;
    },
    data() {
        return {
            visits: []
        };
    }
};
</script>
