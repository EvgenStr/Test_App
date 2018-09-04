<template>
    <div>
        <header></header>
        <admin-table ></admin-table>
        <!--:user="user" :fields="fields"-->
        <footer></footer>
    </div>
</template>

<script>
    import axios from 'axios';
    import VueRouter from 'vue-router';
    import AdminTable from './AdminTable'
    import pagination from './PaginationControll'
    import modal from './EditModal'


    export default {
        name: "AdminViewComponent",
        components: {AdminTable, pagination,modal},
        data() {
            return {
                page: 0,
                count: 0,
                totalPages: 0,
                perPage: 10
            };

        },
        data () {
            return {
                isModalVisible: false,
            };
        },
        methods: {
            showModal() {
                this.isModalVisible = true;
            },
            closeModal() {
                this.isModalVisible = false;
            }
        },
    };





</script>

<style scoped>

</style>