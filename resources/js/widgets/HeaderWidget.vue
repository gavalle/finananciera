<template>
    <div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{title}}</h1>
                    </div>

                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li v-for="page in breadcrumbs" class="breadcrumb-item">
                                <router-link tag="a" :to="page.url">
                                {{page.text}}
                                </router-link>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        title: String,
        breadcrumbs: Array
    },
    mounted() {
        window.document.title = this.title + ' - ' + this.$appName
    },
};
</script>
