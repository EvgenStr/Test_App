<template>
    <div class="container">
        <h2>Registration form</h2>
        <form v-on:submit.prevent="reg">
            <h6>{{nameLog}}</h6>
            <input v-model="name" placeholder="Name">
            <h6>{{emailLog}}</h6>
            <input v-model="email" type="email" placeholder="Email">
            <h6>{{passLog}}</h6>
            <p>The password must be at least 8 characters and contain one number and one letter in uppercase</p>
            <input v-model="password" type="password" placeholder="Password">
            <h6>{{confirmLog}}</h6>
            <input v-model="confirm" type="password" placeholder="Confirm Password">
            <!--<button v-on:click.prevent="reg">Reg It</button>-->
            <button>Reg It</button>

        </form>

    </div>
</template>

<script>
    import axios from 'axios';
    import VueRouter from 'vue-router'

    export default {
        name: "RegistrationComponent",
        data: function () {
            return {
                name: "",
                email: "",
                password: "",
                confirm: "",
                nameLog: "",
                emailLog: "",
                passLog: "",
                confirmLog: "",

                error: false,
                errors: {},
                success: false
            }
        },

        methods: {
            reg(e) {
                this.name === "" ? this.nameLog = "Enter Name" : this.nameLog = "";
                this.email === "" ? this.emailLog = "Enter Email" : this.emailLog = "";
                this.password === "" ? this.passLog = "Enter Password" : this.passLog = "";
                this.confirm === "" ? this.confirmLog = "Confirm password" : this.confirmLog = "";
                if (this.confirm !== "") {
                    if (this.password !== this.confirm) {
                        this.confirmLog = "Passwords do not match"
                    }
                    else {
                        if (ValidateMail(this.email)) {
                            if (ValidatePass(this.password)) {
                                axios.post('/api/registration', {
                                    name: this.name,
                                    email: this.email,
                                    password: this.password
                                }).then(respond => {
                                    if (respond.status === 201) {
                                        this.$router.push('/');
                                    }
                                    if (respond.data === "Error") {
                                        this.emailLog = "This E-mail is already registered"
                                    }
                                })
                            } else {
                                this.passLog = "Wrong Password"
                            }
                        } else {
                            this.passLog = "Wrong Email"
                        }
                    }
                }
            },
        }
    }


    function ValidateMail(mail) {
        var mailCheck = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if (mailCheck.test(mail)) {
            return (true)
        }
        return (false)
    }

    function ValidatePass(password) {
        var passCheck = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{6,})/;
        let validation = false
        if (passCheck.test(password)) {
            validation = true
        }
        return validation
    }

    //

</script>

<style scoped>
    form {
        /*justify-items: center;*/
    }

    input {
        display: block;
        width: 100%;
        margin-bottom: 10px;
    }

    button {
        /*display: block;*/
        margin: 0 auto;
    }

    h6 {
        color: red;
    }
</style>