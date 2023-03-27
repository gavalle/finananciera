<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <div class="text-center text-white">
            [ LOGO ]
        </div>

        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">

            </div>
            <nav class="options">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">
                    <li class="nav-item with-child active menu-is-opening menu-open" v-if="menu.length == 0">
                        <router-link class="nav-link" :tag="'span'" :to="'/'">
                            <i class="fas fa-home"></i>
                            Inicio
                        </router-link>
                    </li>
                    <li v-bind:class="(item.is_separator == 1 ? 'nav-header' : 'nav-item') + ' ' + (item.childs.length > 0 ? 'with-child' : '')" v-for="item of menu">
                        <router-link class="nav-link" :tag="(item.childs.length > 0 ? 'span' : 'a')" :to="(item.childs.length > 0 ? '#' : item.link)" v-if="item.is_separator != 1">
                            <i class="fas" :class="item.icon"></i>
                            {{ item.name }}
                        </router-link>
                        <span v-if="item.is_separator == 1">
                            <i class="fas" :class="item.icon"></i>
                            <p>
                                {{ item.name }}
                            </p>
                        </span>
                        <ul class="nav nav-treeview" v-if="item.is_separator != 1 && item.childs.length > 0">
                            <li class="nav-item" v-for="child of item.childs">
                                <router-link tag="a" class="nav-link" :to="child.link">
                                    <span>
                                        <i class="fa fa-dot-circle"></i>
                                        {{ child.name }}
                                    </span>
                                </router-link>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <br />
            <br />
        </div>
    </aside>
</template>

<script>
export default {
    data() {
        return {
            menu: []
        };
    },
    mounted() {
        if(this.UserData() != null) {
            axios
                .post(
                    "/api/menu",
                    {},
                    {
                        headers: {
                            Authorization: AT,
                        },
                    }
                )
                .then((resp) => {
                    if(resp.data.error == 1) {
                        window.localStorage.removeItem('userDataMin');
                        window.location.reload();
                    } else {
                        this.menu = resp.data;
                    }
                });
        }
    },
};
</script>
<style>
.brand-link {
    padding: 2px;
    text-align: center;
}
.user-panel .info .d-block {
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
}
</style>
