<template>
    <div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{titleTable}}</h3>
            </div>

            <div class="card-body">
                <table id="datadable1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th v-for="label in labels">{{ label }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="row in items">
                            <td v-for="cell in row">
                                <span v-html="cell"></span>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th v-for="label in labels">{{ label }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
const langDatatables = require('../datatables-lang');
export default {
    props: {
        titleTable: String,
        items: {
            type: Array,
            required: true,
            defaults: []
        },
        labels: {
            type: Array,
            required: true,
            defaults: []
        }
    },
    mounted() {
        jQuery("#datadable1")
            .DataTable({
                responsive: true,
                lengthChange: false,
                autoWidth: false,
                buttons: ["copy", "csv", "excel"],
                language: langDatatables.langDatatables
            })
            .buttons()
            .container()
            .appendTo("#example1_wrapper .col-md-6:eq(0)");
    },
};
</script>
