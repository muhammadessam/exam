<script>
    import {Bar} from 'vue-chartjs'

    export default {
        extends: Bar,
        props: {
            data: {
                type: Object,
                default: null
            },
            options: {
                type: Object,
                default: null
            }
        },
        mounted() {
            // Overwriting base render method with actual data.
            this.renderChart(this.data, this.options);
        }
    }
</script>
