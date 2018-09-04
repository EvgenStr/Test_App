<template id="user-table">
    <div class="container">
        <header class="table-info">
            <!--<p> Viewing {{ resultIndexBeg }} - {{ resultIndexEnd }} of {{ totalData }} results </p>-->
            <!--<logout></logout>-->
            <router-link v-if="this.root" :to="{ name: 'admintable' }">Admintable</router-link>


        </header>
        <table>
            <thead>
            <tr>
                <th v-for="col in userCols" :key="col">{{ col }}</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="user in users" :key="user.id">
                <td>{{ user.id }}</td>
                <td>
                    <img class="avatar" :src="user.user_img" alt="">
                </td>
                <td>{{ user.username }}</td>
                <td>{{ user.text }}</td>
                <!--<td>{{ user.hashtags }}</td>-->
                <td>{{ user.created_post }}</td>
            </tr>
            </tbody>
        </table>
        <pagination-control
                @change="test"
                :current-page="page"
                :max-pages="totalPages">
        </pagination-control>
    </div>

</template>

<script>
    import pagination from './PaginationControll'
    import {MdButton, MdContent, MdTabs} from 'vue-material/dist/components'
    import 'vue-material/dist/vue-material.min.css'
    import logout from './LogOut'


    export default {
        name: "user-table",
        template: '#user-table',
        components: {'pagination-control': pagination, logout},
        data() {
            return {
                page: 1,
                perPage: 10,
                totalPages: 0, //ddddd 0000
                users: [],
                userCols: ['id', 'Image', 'Name', 'Text', 'Created'],
                totalData: 0,
                root: false
            };
        },
        computed: {
            // resultIndexBeg() {
            //     // return this.users[0].id || 0;
            //     return this.users.length > 0 ? this.users[0].id : 0;
            //     // return 1;
            // },
            // resultIndexEnd() {
            //     // return this.users[4].id || 0;
            //     return this.users.length > 0 ? this.users[this.users.length - 1].id : 0;
            // },
        },
        methods: {
            getData() {
                if (this.page == 1) {
                    axios.get('/twitsDB').then(respond => {
                        this.totalPages = Math.ceil(respond.data / this.perPage);
                        this.totalData = respond.data;
                        console.log(respond.data + "count");
                        if (respond.data !== 0) {
                            axios.post('/gettweets', {page: 1, perPage: this.perPage}).then(respond => {
                                console.log(respond);
                                this.users = respond.data.reverse();
                            })
                        }
                    });
                } else {
                    axios.post('/gettweets', {
                        page: this.page,
                        perPage: this.perPage,
                        totalData: this.totalData
                    }).then(respond => {
                        console.log(respond);
                        this.users = respond.data.reverse();
                    })
                }
            },
            test(page) {
                this.page = page;
            },
            checkedRoot(){
                let check = localStorage.getItem('admin');
                if(check==true){
                    this.root = true;
                }else{
                    this.root = false;
                }

            }
        },
        watch: {
            page: {
                immediate: true,
                handler(newVal, oldVal) {
                    this.getData();
                },
            },
        },
        mounted(){
            this.checkedRoot()
        }

    }
</script>

<style scoped>

    @import url('https://fonts.googleapis.com/css?family=Nunito:400,600,700');

    html {
        font-size: 16px;
        font-weight: 400;
        line-height: 1.5;
    }

    li {
        display: inline-block;
        border: 1px solid white;
        box-sizing: border-box;
        margin-left: -1px;
    }

    a {
        background: blue;
        margin: .25rem;
        padding: .25rem .5rem;
        border-radius: 4px;
        text-decoration: none;
        position: relative;
        display: block;
        color: blue;
    }

    .table-info {
        display: flex;
        justify-content: space-between;
    }

    .avatar {
        width: 64px;
    }

    table {
        border-collapse: collapse;
        display: block;
    }

    td {
        border-top: 1px solid #dee2e6;
    }

    th, td {
        padding: .5rem;
    }

    li {
        display: inline-block;
        border: 1px solid #D5D5D5;
        box-sizing: border-box;
        margin-left: -1px;
    }

    a {
        background: darkgreen;
        margin: .25rem;
        padding: .25rem .5rem;
        border-radius: 4px;
        text-decoration: none;
        position: relative;
        display: block;
        color: blue;
    }

    .md-accent {
        background-color: #941513;
    }

</style>