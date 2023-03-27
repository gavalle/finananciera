<template>
    <div>
        <div class="card" :class="className">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-1"></i>
                    {{ title }}
                </h3>
            </div>
            <div class="card-body">
                <div class="chart" id="revenue-chart" style="position: relative" v-bind:style="{ height: height + 'px' }">
                    <canvas :id="id" v-bind:height="height" v-bind:style="{ height: height + 'px' }"></canvas>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        title: {
            type: String,
            default: "Gráfico",
        },
        id: {
            type: String,
            default: "revenue-chart-canvas2",
        },
        className: {
            type: String,
            default: "card-danger",
        },
        type: {
            type: String,
            default: "bar",
        },
        labels: Array,
        datasets: Array,
        height: {
            type: Number,
            default: 500,
        },
    },
    data() {
        return {
            salesChartCanvas: null,
        };
    },
    created() {
        this.$root.$on("updateChart", (data) => {
            if(this.salesChartCanvas != null) {
                this.salesChartCanvas.data.datasets[0].data = this.datasets[0].data;
                this.salesChartCanvas.update();
            }
        });
    },
    mounted() {

        let salesChartCanvas = document.getElementById(this.id).getContext("2d");

        var salesChartData = {
            labels: this.labels,
            datasets: this.datasets,
        };

        var salesChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: false,
            },
        };
        if (this.salesChartCanvas == null) {
            this.salesChartCanvas = new Chart(salesChartCanvas, {
                type: this.type,
                data: salesChartData,
                options: salesChartOptions,
            });
        } else {
            console.log(this.salesChartCanvas.data.datasets[0].data);
            this.salesChartCanvas.data.datasets[0].data = salesChartData;
            this.salesChartCanvas.update();
        }
    },
    methods: {
    }
};
</script>
