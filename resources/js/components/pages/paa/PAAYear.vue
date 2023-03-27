<template>
    <div class="row">
        <div class="col-lg-12">
            <section class="content">
                <div class="container-fluid">
                    
                    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 sm:items-center py-4 sm:pt-0">
                        <h1>{{ title }}</h1>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <a :href="'/paa/years/new'"  class="btn btn-success"><i class="far fa-credit-card"></i>
                                Crear un nuevo año
                            </a>
                        </div>
                    </div>
                    <hr>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Listado de años configurados en la plataforma</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">ID</th>
                                        <th>Año</th>
                                        <th>Descripción</th>
                                        <th>Inicio de contrataciones</th>
                                        <th>Finalización de contrataciones</th>
                                        <th>Estado</th>
                                        <th>Creación</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(year, index) in years">
                                        <td>{{ year.id }}</td>
                                        <td>{{ year.cod }}</td>
                                        <td>{{ year.description }}</td>
                                        <td>{{ year.start_date_hiring }}</td>
                                        <td>{{ year.end_date_hiring }}</td>
                                        <td>
                                            <span 
                                                class="badge " 
                                                :class="{'bg-success':year.active==1,'bg-warning':year.active!=1}" >{{ formatActive(year.active) }}</span>
                                        </td>
                                        <td>{{ year.created_at }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a :href="'/paa/years/edit/'+year.id" class="btn btn-info"><i class="fas fa-eye"></i> Editar</a>
                                                <a class="btn btn-danger" @click="deleteYear(year.id)"><i class="fas fa-trash"></i> Eliminar</a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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
            years: [],
        };
    },
    methods :{
        getYears() {
            axios
                .get('/api/paas/years',{
                    headers: {
                        'Authorization': this.AccessToken
                    }
                })
                .then(response => {
                    this.years = response.data;
                    console.log(this.years);
                })
        },
        deleteYear(id) {
            this.$swal.fire({
                title: '¿Está seguro de eliminar el año?',
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
                        .delete('/api/paas/years/'+id, {
                            headers: {
                                'Authorization': this.AccessToken
                            }
                        })
                        .then(response => {
                            this.years = response.data;
                            console.log(this.years);
                            this.$swal('¡Se elimino el año correctamente!');
                            //redirect to list
                            //this.$router.push({ name: 'paa-years' });
                            this.getYears();
                        })
                        .catch(error => {
                            this.$swal.fire({
                                icon: 'error',
                                title: 'Se presento un error al eliminar el año!',
                                text: '',
                                footer: ''
                            })
                        });
                }
            })
        },
        formatActive(active) {
            return active == 1 ? 'ACTIVO' : 'INACTIVO';
        }
    },
    mounted () {
        this.getYears();
    }
};
</script>
