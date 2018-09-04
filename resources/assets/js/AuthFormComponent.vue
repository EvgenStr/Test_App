<template>
    <div class="main">
        <h2>Welcome!</h2>
        <h5> {{log}} </h5>
        <form v-on:submit.prevent="sub">
            <input v-model="email" placeholder="Email">
            <input v-model="password" type="password" placeholder="Password">
            <button v-on:click.prevent="submit">Log In</button>
        </form>
        <div class="links">
            <router-link to="/registration">Registration</router-link>
            <router-link to="/forgot">Forgot Password</router-link>
        </div>
    </div>
</template>

<script>
    // import {mapActions} from 'vuex';
    import axios from 'axios';

    export default {
        name: "AuthFormComponent",
        data: function () {
            return {
                email: "",
                password: "",
                log: ""
            }
        },
        methods: {
            submit(e) {
                if (this.email === "" || this.password === "") {
                    this.log = "Enter login and password";
                    e.preventDefault();
                } else {
                    axios.post('/api/check', {email: this.email, password: this.password}).then(respond => {
                            console.log('qweqweqweqwe',respond);
                            this.log = respond.data;
                            console.log(respond.data);
                            if (respond.data === "user") {
                                console.log(respond.data);
                                this.$router.push('/tweetuser');
                            }
                            if (respond.data === "admin") {
                                console.log(respond.data);
                                this.$router.push('/tweetadmin');
                            }
                        }
                    )
                }
            }
        }
    }
</script>

<style scoped>
    h5 {
        color: red;
    }

    form > * {
        margin: 5px;
    }
    form{
        margin:0 auto;
        display: grid;
    }

    .main {
        text-align: center;
        margin: 0 auto;
        justify-item: center;
        width: 25vw;
        vertical-align: middle;
        margin-top: 15%;
    }

    .links {
        text-align: center;
    }
    a{
        display: block;
        width: 100%;
    }


</style>