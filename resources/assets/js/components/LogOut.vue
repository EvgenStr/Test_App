<template>
    <md-button class="md-raised md-accent" v-on:click="logOut">LogOut</md-button>
</template>

<script>
    import Vue from 'vue'
    import { MdButton} from 'vue-material/dist/components'
    import 'vue-material/dist/vue-material.min.css'

    Vue.use(MdButton)


    export default {
        name: "logout",
        methods:{
            logOut(){
                this.$router.push('/');
            }
        }
    }
</script>

<style scoped>

</style>