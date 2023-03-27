<template>
    <div>
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a class="nav-link">{{ $appName }}</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item" v-if="UserData() != null">
                    <div class="dropdown">
                        <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <b>Módulos</b>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" :href="mod.url_login" v-for="mod of modules">
                                {{ mod.name }}
                            </a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:;" role="button" v-if="UserData() != null">
                        <b>{{ UserData().name }}</b>
                    </a>
                </li>
                <li class="nav-item" v-if="UserData() != null">
                    <a href="javascript:;" class="nav-link" v-on:click="LogOut()" title="Cerrar sesión">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </li>
                <li class="nav-item" v-if="UserData() == null">
                    <a href="/login" class="nav-link">
                        <b>Iniciar sesión</b>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
export default {
    data() {
        return {
            modules: []
        }
    },
    mounted() {
        this.modules = window.PLATFORMS;
    },
    methods: {
        LogOut: function () {
            window.localStorage.removeItem('userDataMin');
            window.open('/logout', '_top');
        }
    },
};
</script>
