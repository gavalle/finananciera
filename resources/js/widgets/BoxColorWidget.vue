<template>
    <div>
        <div class="small-box" v-bind:class="color ? color : 'bg-info'">
            <div class="inner">
                <h3>{{value ? value : '0'}}</h3>

                <p>{{title}}</p>
            </div>
            <div class="icon">
                <i class="ion" v-bind:class="icon ? icon : 'ion-bookmark'"></i>
            </div>
            <a v-if="url != null" v-bind:href="url ? url : '#'" class="small-box-footer">{{textLink ? textLink : 'Más información'}} <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        color: String,
        title: String,
        value: String,
        textLink: String,
        url: String,
        icon: String,
    }
};
</script>

<style></style>
