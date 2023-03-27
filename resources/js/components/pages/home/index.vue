<template>
    <div>
        <br />
        <div class="col-lg-12">
            <section class="content">
                <div class="container-fluid">
                    <div class="card-group">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-muted text-right">
                                    <i class="fa fa-users c-icon"></i>
                                </div>
                                <div class="text-value-lg">{{value1}}</div>
                                <small class="text-muted text-uppercase font-weight-bold">Caja 1</small>
                                <div class="progress progress-xs mt-3 mb-0">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="text-muted text-right">
                                    <i class="fa fa-cubes c-icon"></i>
                                </div>
                                <div class="text-value-lg">{{value2}}</div>
                                <small class="text-muted text-uppercase font-weight-bold">Caja 2</small>
                                <div class="progress progress-xs mt-3 mb-0">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>

<script>
export default {
    components: {
    },
    data() {
        return {
            breadcrumbs: Array,
            chartLabels: Array,
            chartDatasets: Array,
            _modules: Array,
            value1: "100",
            value2: "40"
        };
    },
    created() {
        this.breadcrumbs = [{ url: "/", text: "Dashboard" }];
        this.chartLabels = [];
        this.chartDatasets = [
            {
                label: "Convocatorias",
                backgroundColor: "rgba(60,141,188,0.9)",
                borderColor: "rgba(60,141,188,0.8)",
                pointRadius: false,
                pointColor: "#3b8bba",
                pointStrokeColor: "rgba(60,141,188,1)",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(60,141,188,1)",
                data: [],
            }
        ];
    },
    mounted() {
        // axios
        //     .get("/api/calls_actives_report", {
        //         headers: {
        //             Authorization: AT,
        //             Accept: "application/json",
        //         },
        //     })
        //     .then((response) => {
        //         this.calls = new String(response.data.calls);
        //         this.initiatives = new String(response.data.initiatives);
        //         let arrName = [];
        //         for(let it of response.data.data_calls) {
        //             this.chartLabels.push(it.name);
        //             this.chartDatasets[0].data.push(it.initiatives);
        //         }
        //     });
    },
};
</script>
