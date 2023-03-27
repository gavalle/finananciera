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
                            <h3 class="card-title">Edición del PAA</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="year_id">Año</label>
                                            <Select2  id="year_id" v-model="paa.year_id" :options="yearsOpt" placeholder="- Selecciona un año -"  />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Nombre</label>
                                            <input type="text" class="form-control" id="name" v-model="paa.name" placeholder="Nombre">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name">Descripción</label>
                                            <input type="text" class="form-control" id="description" v-model="paa.description" placeholder="Descripción">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="paa_status_id">Estado</label>
                                            <Select2  id="paa_status_id" v-model="paa.paa_status_id" :options="statusOpt" placeholder="- Selecciona un estado -" />
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="button" class="btn btn-default" style="margin-right: 25px;" @click="cancel()">Cancelar</button>
                                <button type="button" class="btn btn-primary " @click="savePAA()">Guardar</button>
                            </div>
                        </form>
                    </div>

                    <div class="card card-primary card-outline" v-if="paa.id > 0">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-edit"></i>Líneas del PAA</h3>
                            
                        </div>
                        <div class="card-body pad table-responsive">
                            <div class="row">
                                <a :href="'/paas/'+paa.id+'/lines/new'"  class="btn btn-success"><i class="far fa-credit-card"></i>
                                    Agregar nueva linea al PAA
                                </a>
                            </div>
                            <hr>
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>Área</th>
                                        <th>Linea</th>
                                        <th>Id PAA</th>
                                        <th>UNSPSC</th>
                                        <th>Descripción</th>
                                        <th>Inicio proceso</th>
                                        <th>Duración</th>
                                        <th>Modalidad</th>
                                        <th>Estado</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(line, index) in lines">
                                    <!--<tr v-for="line in lines" :key="line.id">-->
                                        <td>{{ line.organizational_area_cod+ '-' + line.organizational_area_name }}</td>
                                        <td>{{ line.cod }}</td>
                                        <td>{{ line.cod_paa_line }}</td>
                                        <td>{{ line.unspsc }}</td>
                                        <td>{{ line.description }}</td>
                                        <td>{{ line.start_date_selection_process }}</td>
                                        <td>{{ line.contract_duration + '-' + line.contract_duration_unit_name}}</td>
                                        <td>{{ line.selection_method_name }}</td>
                                        <td>{{ line.status.name }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a :href="'/paas/'+line.paa_id+'/lines/edit/'+line.id" class="btn btn-info"><i class="fas fa-eye"></i> Editar</a>
                                                <a class="btn btn-danger" @click="deletePAALine(line.paa_id,line.id)"><i class="fas fa-trash"></i> Eliminar</a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>
<script>
export default {
    setup: () => ({
        title: "Configuración del PAA",
    }),
    data() {
        return {
            paa: {
                cod: '',
                name: '',
                description: '',
                paa_status_id: '',
                year_id: ''
            },
            yearsOpt: [],
            statusOpt: [],
            lines:[]
        };
    },
    methods :{
        getYears() {
            axios
                .get('/api/paas/years/select',{
                    headers: {
                        'Authorization': this.AccessToken
                    }
                })
                .then(response => {
                    this.yearsOpt = response.data;
                    console.log(this.years);
                })
        },

        getStatus() {
            axios
                .get('/api/paas/status/select',{
                    headers: {
                        'Authorization': this.AccessToken
                    }
                })
                .then(response => {
                    this.statusOpt = response.data;
                    console.log(this.status);
                })
        },

        getPAALines(id) {
            axios
                .get('/api/paas/'+id+'/lines/',{
                    headers: {
                        'Authorization': this.AccessToken
                    }
                })
                .then(response => {
                    this.lines = response.data;
                    console.log(this.lines);
                })
        },

        getPAA(id) {
            axios
                .get('/api/paas/'+id,{
                    headers: {
                        'Authorization': this.AccessToken
                    }
                })
                .then(response => {
                    this.paa = response.data;
                    this.getPAALines(this.paa.id);
                })
        },

        savePAA() {
            if (this.paa.id) {
                this.updatePAA();
            } else {
                this.createPAA();
            }
        },

        createPAA() {
            axios
                .post('/api/paas', this.paa, {
                    headers: {
                        'Authorization': this.AccessToken
                    }
                })
                .then(response => {
                    this.paa = response.data;
                    this.$swal('¡Se guardo el PAA correctamente!');
                    //redirect to list
                    this.$router.push({ name: 'paas' });
                })
                .catch(error => {
                    this.$swal.fire({
                        icon: 'error',
                        title: 'Se presento un error al guardar el PAA!',
                        text: '',
                        footer: ''
                    })
                });
        },

        updatePAA() {
            axios
                .put('/api/paas/'+this.paa.id, this.paa, {
                    headers: {
                        'Authorization': this.AccessToken
                    }
                })
                .then(response => {
                    this.paa = response.data;
                    this.$swal('¡Se actualizo el PAA correctamente!');
                    this.$router.push({ name: 'paas' });
                })
                .catch(error => {
                    this.$swal.fire({
                        icon: 'error',
                        title: 'Se presento un error al actualizar el PAA!',
                        text: '',
                        footer: ''
                    })
                });
        },

        deletePAALine(paaId,paaLineId) {
            this.$swal.fire({
                title: '¿Está seguro de eliminar la Línea del PAA?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText:'Cancelar',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, bórralo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios
                        .delete('/api/paas/'+paaId+'/lines/'+paaLineId, {
                            headers: {
                                'Authorization': this.AccessToken
                            }
                        })
                        .then(response => {
                            this.paaLine = response.data;
                            this.$swal('¡Se elimino la Línea del PAA correctamente!');
                            this.getPAALines(paaId);
                        })
                        .catch(error => {
                            this.$swal.fire({
                                icon: 'error',
                                title: 'Se presento un error al eliminar la Línea del PAA!',
                                text: '',
                                footer: ''
                            })
                        });
                }
            })
        },

        cancel() {
            this.$router.push({ name: 'paas' });
        }
    },
    mounted () {
        this.getYears();
        this.getStatus();
        const paaId = this.$route.params.id ? this.$route.params.id : 0;
        if (paaId > 0) {
            this.getPAA(paaId);
        } else {
            this.paa = {
                cod: '',
                name: '',
                description: '',
                paa_status_id: '',
                year_id: ''
            }
        }
    }
};
</script>
