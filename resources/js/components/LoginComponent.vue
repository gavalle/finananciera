<template>
    <div>
        <div class="row">
            <div class="col-sm-8"></div>
            <div class="col-sm-4">
                <h1 class="text-center title-h1">PAA</h1>
                <div class="card card-form">
                    <div class="card-body">
                        <div>
                            <a href="/login" class="btn btn-primary btn-block">Acceder a la plataforma</a>
                            <br />
                            <p class="text-center mb-0 pb-0">
                                <a class="text-white px-2 py-0" href="#" target="_blank">Registrar una nueva membresía</a>
                            </p>
                            <p class="text-center mb-0 pb-0">
                                <a class="text-white px-2 py-0" href="#" target="_blank">¿Olvidaste tu contraseña?</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import jQuery from "jquery";
export default {
    data() {
        return {
            submodules: [],
            callList: [],
            page: 0
        };
    },
    mounted() {
        jQuery(window).resize(function() {
            var w = jQuery('.left-content').width() + 29.5;
            jQuery('.login-footer').width(w);
            jQuery('.login-header').width(w);
        });
        jQuery(window).resize();
        this.loadData();
    },
    methods: {
        clearSubmodules() {
            this.submodules = [];
        },
        loadData() {
            axios
                .get("/api/calls_actives_public?page=" + this.page, {
                    headers: {
                        Authorization: '',
                        Accept: "application/json",
                    },
                })
                .then((response) => {
                    for(let i of response.data) {
                        this.callList.push(i);
                    }
                    if(response.data.length > 0) {
                        this.page++;
                        jQuery('.btn-show-more').removeClass('hide');
                    } else {
                        jQuery('.btn-show-more').addClass('hide');
                    }
                });
        },
        showItem(row) {
            window.open(window.location.protocol + "//" + window.location.host + "/e/" + row.slug, '_blank');
        },
    },
};
</script>
<style scoped>
.badge {
    border-radius: 10px;
    text-transform: uppercase;
    font-size: 10px;
    font-weight: 400;
    color: white;
}
.badge.badge-dark {
    background: rgb(0, 0, 0);
}
.badge.badge-success2 {
    background: rgb(7, 90, 7);
}
.badge.badge-warning {
    background: rgb(150, 137, 24);
}
.badge.badge-danger {
    background: rgb(201, 27, 27);
}
.badge.badge-success {
    background: rgb(24, 189, 24);
}
#temp {
    background-color: white;
}

#principalTemp {
    height: 100vh;
    background-color: white;
}

#tempCard {
    background-color: white;
    box-shadow: 0.1px 0.1px 0px #e3042d;
    border: 1px solid #e3042d;
}
#btnTemp {
    color: #e3042d;
    background-color: #ffffff;
    border-color: #ffffff;
    box-shadow: none;
}
.btn-secondary {
    background-color: #e3042d;
    border-color: #e3042d;
    color: white;
    border-radius: 20px;
}

.login-footer {
    display: block;
    position: fixed;
    background-image: url("/img/background/bg-footer.png");
    height: 80px;
    bottom: 0;
    width: 100%;
    background-repeat: repeat-x;
    background-size: cover;
    left: 0px;
    z-index: 9999;
}

.login-header {
    display: flex;
    position: fixed;
    height: 150px;
    top: 0;
    width: 100%;
    background-repeat: repeat-x;
    background-size: contain;
    left: 0px;
    z-index: 9999;
    overflow: hidden;
}

.card-form p a {
    color: black !important;
}

.left-content {
    border-right: 1px solid red;
}

.tr1 {
    background-color: #ffb305;
    width: 60%;
    height: 140px;
    flex: 1;
    transform: rotate(356deg);
    margin-top: -3%;
    margin-left: -2%;
    margin-right: -2px;

    background-image: url(/img/background/bg-footer.png);
    background-size: cover;
    background-position: 0% 0%;
    background-repeat: repeat;
}

.tr2 {
    background-color: #fdce24;
    width: 60%;
    height: 140px;
    flex: 1;
    transform: rotate(364deg);
    margin-top: -3%;
    margin-right: -2%;
    margin-left: -2px;

    background-image: url(/img/background/bg-footer.png);
    background-size: cover;
    background-position: 0% 0%;
    background-repeat: repeat;
}

.tr2:before {
    display: block;
    content: " ";
    background-color: #fdce24;
    width: 10px;
    height: 140px;
    transform: rotate(356deg);
    margin-left: -5px;
    margin-top: 0.4px;
}
</style>
