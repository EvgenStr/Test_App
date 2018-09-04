<template>
    <div class="container">
        <p>E-mail</p>
        <span>{{log}}</span>
        <input placeholder="E-mail" v-model="email" value=""/>
        <md-button v-on:click="sendEmail">Submit</md-button>
    </div>
</template>

<script>
    export default {
        name: "ForgotPassword",
        data() {
            return {
                email: "",
                log: ""
            }
        },
        methods: {
            sendEmail() {
                axios.defaults.baseURL = 'http://localhost/';
                axios.post('/password/email', {
                    email: this.email
                }).then(respond => {
                    console.log(respond)
                });
                axios.defaults.baseURL = 'http://localhost/api';

            }
        }

    }
</script>

<style scoped>
    div {
        /*display: table-caption;*/
        /*flex-direction: ;*/
    }

    input {
        display: block;
    }
</style>