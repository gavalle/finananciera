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
                            <a :href="'/paas/new'"  class="btn btn-success"><i class="far fa-credit-card"></i>
                                Crear un nuevo PAA
                            </a>
                        </div>
                    </div>
                    <hr>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Listado de PAAs configurados en la plataforma</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">ID</th>
                                        <th>Año</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Estado</th>
                                        <th>Creación</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(paa, index) in paas">
                                        <td>{{ paa.id }}</td>
                                        <td>{{ paa.year.cod }}</td>
                                        <td>{{ paa.name }}</td>
                                        <td>{{ paa.description }}</td>
                                        <td>
                                            <span 
                                                class="badge "
                                                :class="{'bg-success':paa.status.id==1,'bg-warning':paa.status.id!=1}" >{{ paa.status.name}}
                                            </span>
                                        </td>
                                        <td>{{ paa.created_at }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a :href="'/paas/edit/'+paa.id" class="btn btn-info"><i class="fas fa-eye"></i> Editar</a>
                                                <a class="btn btn-danger" @click="deletePAA(paa.id)"><i class="fas fa-trash"></i> Eliminar</a>
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
        title: "Configuración del PAA",
    }),
    data() {
        return {
            paas: [],
        };
    },
    methods :{
        getPAAs() {
            axios
                .get('/api/paas',{
                    headers: {
                        'Authorization': this.AccessToken
                    }
                })
                .then(response => {
                    this.paas = response.data;
                    console.log(this.paas);
                })
        },
        deletePAA(id) {
            this.$swal.fire({
                title: '¿Está seguro de eliminar el PAA?',
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
                        .delete('/api/paas/'+id, {
                            headers: {
                                'Authorization': this.AccessToken
                            }
                        })
                        .then(response => {
                            this.paa = response.data;
                            this.$swal('¡Se elimino el PAA correctamente!');
                            this.getPAAs();
                        })
                        .catch(error => {
                            this.$swal.fire({
                                icon: 'error',
                                title: 'Se presento un error al eliminar el PAA!',
                                text: '',
                                footer: ''
                            })
                        });
                }
            })
        }
    },
    mounted () {
        this.getPAAs();
    }
};
</script>
