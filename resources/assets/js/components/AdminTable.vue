<template>

    <div class="container">
        <header class="table-info">
            <h2> Admin</h2>
            <p> Viewing {{ resultIndexEnd }} - {{ resultIndexBeg }} of {{ totalData }} results </p>
            <div class="right-nav">
                <router-link :to="{ name: 'usertable' }">UserTable</router-link>
                <router-link type="button" class="md-raised" to="map">MAP</router-link>
                <md-button type="button" class="md-raised" v-on:click="updateData">UPDATE</md-button>
                <logout></logout>
            </div>
        </header>
        <div class="table-block">
            <table>
                <thead>
                <tr>
                    <th v-for="col in userCols" :key="col">{{ col }}</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(user, index) in users" :key="user.id">
                    <td>{{ user.id }}</td>
                    <td>
                        <img class="avatar" :src="user.user_img" alt="">
                    </td>
                    <td>{{ user.username }}</td>
                    <td>{{ user.text }}</td>
                    <!--<td>{{ user.hashtags}}</td>-->
                    <td>{{ user.created_post.replace('/\+0000+&?', ' ') }}</td>
                    <td>
                        <md-button type="button" class="md-raised md-primary" @click="showModal(index)">EDIT</md-button>
                    </td>
                    <td>
                        <md-button class="md-raised md-accent" v-on:click="del(index)">DELETE</md-button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <pagination-control
                :current-page="page"
                :max-pages="totalPages"
                @change="test"
        >
        </pagination-control>
        <modal v-show="isModalVisible" :editText="this.editingData" :id="this.editingId" @close="closeModal"
               @save="updatePage"/>
    </div>
</template>

<script>
    import Vue from 'vue'
    import pagination from './PaginationControll'
    import {MdButton} from 'vue-material/dist/components'
    import modal from './EditModal'
    import logout from './LogOut'
    import axios from 'axios';
    import VueAxios from 'vue-axios';

    Vue.use(MdButton);

    export default {
        name: "user-table",
        template: '#user-table',
        components: {'pagination-control': pagination, modal, logout},
        data() {
            return {
                page: 1,
                perPage: 10,
                totalPages: 1, //ddddd 0000
                users: [],
                userCols: ['id', 'Image', 'Name', 'Text', 'Created'],
                totalData: 0,
                isModalVisible: false,
                editingData: "",
                editingId: ''
            };
        },
        computed: {
            resultIndexBeg() {
                return this.users.length > 0 ? this.users[0].id : 0;
            },
            resultIndexEnd() {
                return this.users.length > 0 ? this.users[this.users.length - 1].id : 0;
            },
        },
        methods: {
            getData() {
                if (this.page == 1) {
                    axios.get('/twitsDB').then(respond => {
                        this.totalPages = Math.ceil(respond.data / this.perPage);
                        this.totalData = respond.data;
                        if (respond.data !== 0) {
                            this.totalPages = Math.ceil(respond.data / this.perPage);
                            this.totalData = respond.data;
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
            del(index) {
                var item = this.users[index].id;
                console.log(item);
                axios.post('/delete', {item: item}).then(respond => {
                    if (respond.data > 0) {
                        this.totalPages = Math.ceil(respond.data / this.perPage);
                        // this.getData();
                        this.updatePage()
                    }
                })
            },
            updatePage() {
                axios.post('/gettweets', {
                    page: this.page,
                    perPage: this.perPage,
                    totalData: this.totalData
                }).then(respond => {
                    console.log(respond);
                    this.users = respond.data.reverse();
                })
            },
            showModal(index) {
                this.isModalVisible = true;
                this.editingData = this.users[index].text;
                this.editingId = this.users[index].id;
                console.log(this.editingData);
            },
            closeModal() {
                this.isModalVisible = false;
                // this.updatePage();
            },
            updateData() {
                axios.post('/updadmin').then(respond => {
                    console.log(respond);
                    this.getData();
                    // this.updatePage();
                })
            },
            checkedRoot() {
                axios.get('/auth/user').then(respond => {
                    if(respond.data.admin===0){
                        this.$router.push('usertable')
                    }
                });
            }
        },
        watch: {
            page: {
                immediate: true,
                handler() {
                    this.getData();
                },
            },
        },
        mounted() {
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

    body {
        background-color: #e8f5f7;
    }

    li {
        display: inline-block;
        margin-left: -1px;
        border: 1px solid #D5D5D5;
        box-sizing: border-box;
    }

    a {
        display: block;
        color: blue;
        background: darkgreen;
        margin: .25rem;
        padding: .25rem .5rem;
        border-radius: 4px;
        text-decoration: none;
        position: relative;
        vertical-align: center;
        text-align: center;
        padding-top: 12px;
    }

    .table-info {
        display: flex;
        justify-content: space-between;
        width: 100%;

    }

    .avatar {
        width: 64px;
    }

    table {
        border-collapse: collapse;
        /*display: block;*/
        table-layout: auto;
    }

    th, td {
        padding: .5rem;
        border-top: 1px solid #dee2e6;

    }

    .md-accent {
        background-color: #941513;
    }

    .right-nav {
        display: flex;
        justify-content: space-between;
    }
</style>