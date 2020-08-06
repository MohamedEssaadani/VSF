<script>
import { Line } from "vue-chartjs";
export default {
    extends: Line,
    mounted() {
        let dates = [];
        let totals = [];
        this.$store.dispatch("getCustomersVisits").then(() => {
            let data = this.$store.getters.getCustomersVisits;

            if (data) {
                data.forEach(element => {
                    dates.push(element.created_at);
                    totals.push(element.total);
                });
                this.renderChart(
                    {
                        labels: dates,
                        datasets: [
                            {
                                label: "Revenus",
                                backgroundColor: "#BA55D3",
                                data: totals
                            }
                        ]
                    },
                    { responsive: true, maintainAspectRatio: false }
                );
            } else {
                console.log("No data");
            }
        });
    },
    computed: {
        getCustomersVisits() {
            return this.$store.getters.getCustomersVisits;
        }
    }
};
</script>
