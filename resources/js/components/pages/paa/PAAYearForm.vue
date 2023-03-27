<template>
    <div class="row">
        <div class="col-lg-12">
            <section class="content">
                <div class="container-fluid">
                    
                    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 sm:items-center py-4 sm:pt-0">
                        <h1>{{ title }}</h1>
                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edición de Años</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Año</label>
                                            <VueDatePicker v-model="year.cod" year-picker auto-apply />
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="description">Descripción</label>
                                            <input type="text" class="form-control" id="description" v-model="year.description" placeholder="Descripción">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group toogle-row">
                                            <label for="active">Estado</label>
                                            <Toggle v-model="year.active" id="active" on-label="ACTIVO" off-label="INACTIVO"/>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Inicio de contración</label>
                                            <VueDatePicker v-model="year.start_date_hiring" auto-apply :enable-time-picker="false" format="dd-MM-yyyy"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Fin de contración</label>
                                            <VueDatePicker v-model="year.end_date_hiring" auto-apply :enable-time-picker="false" format="dd-MM-yyyy"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="button" class="btn btn-default" style="margin-right: 25px;" @click="cancel()">Cancelar</button>
                                <button type="button" class="btn btn-primary " @click="saveYear()">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>
<script>
export default {
    setup: () => ({
        title: "Configuración de los Años para el PAA",
    }),
    data() {
        return {
            year: {
                cod: new Date().getFullYear(),
                description: '',
                start_date_hiring: '',
                end_date_hiring: '',
                active: true,
            },
        };
    },
    methods :{
        getYear(id) {
            axios
                .get('/api/paas/years/'+id,{
                    headers: {
                        'Authorization': this.AccessToken
                    }
                })
                .then(response => {
                    this.year = response.data;
                    console.log(this.year);
                })
        },
        saveYear() {
            if (this.year.id) {
                this.updateYear();
            } else {
                this.createYear();
            }
        },
        createYear(){
            axios
                .post('/api/paas/years', this.year, {
                    headers: {
                        'Authorization': this.AccessToken
                    }
                })
                .then(response => {
                    this.years = response.data;
                    console.log(this.years);
                    this.$swal('¡Se guardo el año correctamente!');
                    //redirect to list
                    this.$router.push({ name: 'paa-years' });
                })
                .catch(error => {
                    this.$swal.fire({
                        icon: 'error',
                        title: 'Se presento un error al guardar el año!',
                        text: '',
                        footer: ''
                    })
                });
        },
        updateYear() {
            axios
                .put('/api/paas/years/'+this.year.id, this.year, {
                    headers: {
                        'Authorization': this.AccessToken
                    }
                })
                .then(response => {
                    this.years = response.data;
                    console.log(this.years);
                    this.$swal('¡Se actualizo el año correctamente!');
                    //redirect to list
                    this.$router.push({ name: 'paa-years' });
                })
                .catch(error => {
                    this.$swal.fire({
                        icon: 'error',
                        title: 'Se presento un error al actualizar el año!',
                        text: '',
                        footer: ''
                    })
                });
        },
        
        formatActive(active) { 
            return active == 1 ? 'ACTIVO' : 'INACTIVO';
        },
        cancel() {
            this.$router.push({ name: 'paa-years' });
        }
    },
    mounted () {
        const yearId = this.$route.params.id ? this.$route.params.id : 0;
        if (yearId > 0) {
            this.getYear(yearId);
        } else {
            this.year = {
                cod: new Date().getFullYear(),
                description: '',
                start_date_hiring: '',
                end_date_hiring: '',
                active: true,
            };
        }
    }
};
</script>
