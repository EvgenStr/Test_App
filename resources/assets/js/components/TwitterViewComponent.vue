<template>
    <div>
        <user-table></user-table>
        <!--<button v-on:click="get">GET TWEETS</button>-->


    </div>
</template>

<script>
    import axios from 'axios';
    import VueRouter from 'vue-router';
    import userTable from './UserTable'
    import pagination from './PaginationControll'

    export default {
        name: "TwitterViewComponent",
        components: {userTable, pagination},
        data() {
            return {
                page: 0,
                count: 0,
                totalPages: 0,
                perPage: 10
            };
        },
        methods: {
            get() {
                // axios.get('/twitsDB').then(respond => {
                //     console.log(respond);
                //     if (respond.data != 0) {
                //         this.count = respond.data;
                //         this.totalPages = Math.ceil(this.count / 10);
                //         var skip = this.page * this.perPage;
                //         // console.log(this.page*this.perPage);
                //         console.log(this.page);
                //         axios.post('/api/gettweets', {page: this.page, perPage: this.perPage}).then(respond => {
                //             console.log(respond);
                //         });
                //
                //     }
                // });
            }
        }
    }


    function tweetOfDb() {
    }

</script>

<style scoped>

</style>