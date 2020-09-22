<script>
    import { Line } from 'vue-chartjs';

    export default {
        extends: Line,
        props: ['chartlabel', 'chartdata'],
        mounted() {
            this.renderChart({
                labels: this.chartlabel,
                datasets: [
                    {
                        label: 'Total Page Visits',
                        backgroundColor: '#ff9900',
                        data: this.chartdata
                    }
                ]
            }, {responsive: true, maintainAspectRatio: false})
        }
    }
</script>