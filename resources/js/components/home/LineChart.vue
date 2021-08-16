<script>
    import { Line } from 'vue-chartjs';
    import moment from 'moment';

    export default {
        extends: Line,
        props: {
            label: {
                type:String,
                default: ''
            },
            chartdata: {
                type: Array,
                default: null
            },
            options: {
                type: Object,
                default: null
            },
            chartcolors: {
                type: Object,
            },
        },

        mounted() {
            this.renderLineChart();
        },

        methods: {
            renderLineChart: function() {
                const dates = this.chartdata.map(d => moment(d.date,'YYYY-MM-DD').format('MM/DD'));
                const totals = this.chartdata.map(d => d.total);

                const {borderColor, pointBorderColor, pointBackgroundColor, backgroundColor} = this.chartcolors;

                this.renderChart({
                    labels: dates,
                    datasets: [{
                        label: this.label,
                        data: totals,
                        borderColor: borderColor,
                        pointBorderColor: pointBorderColor,
                        pointBackgroundColor: pointBackgroundColor,
                        backgroundColor: backgroundColor
                    }],
                },this.options);
            }
        },

        watch: {
            chartdata() {
                this.renderLineChart();
            }
        }
}
</script>

<style>

</style>
