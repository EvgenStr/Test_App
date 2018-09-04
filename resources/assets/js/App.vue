<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <nav>
                <ul class="list-inline">
                    <!--<li>-->
                        <!--<router-link :to="{ name: 'home' }">Home</router-link>-->
                    <!--</li>-->
                    <li v-if="!$auth.check()" class="pull-right">
                        <router-link :to="{ name: 'login' }">Login</router-link>
                    </li>
                    <li v-if="!$auth.check()" class="pull-right">
                        <router-link :to="{ name: 'register' }">Register</router-link>
                    </li>
                    <li v-if="!$auth.check()" class="pull-right">
                        <router-link :to="{ name: 'forgotpass' }">Forgot Password</router-link>
                    </li>
                    <li v-if="$auth.check()" class="pull-right">
                        <a href="#" @click.prevent="logout()">Logout</a>
                    </li>
                    <!--<li v-if="$auth.check()" class="pull-right">-->
                        <!--<router-link :to="{ name: 'admintable' }">Admin</router-link>-->
                    <!--</li>-->
                    <!--<li v-if="$auth.check()" class="pull-right">-->
                        <!--<router-link :to="{ name: 'usertable' }">UserTable</router-link>-->
                    <!--</li>-->
                </ul>
            </nav>
        </div>
        <div class="panel-body">
            <router-view></router-view>
        </div>
        <!--<footer>Footer</footer>-->
    </div>
</template>

<script>
    export default {
        name: "app",
        methods: {
            logout() {
                localStorage.removeItem('admin');
                this.$auth.logout()
            },

        },

    }
</script>

<style scoped>

</style>