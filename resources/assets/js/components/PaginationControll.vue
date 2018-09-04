<template id="pagination">
    <ul class="pagination">
        <li v-for="i in maxPages">
            <a href='#'
               :class="{'active': currentPage === i}"
               @click="$emit('change', i)">
                {{ i}}
            </a>
        </li>
        </ul>
</template>

<script>
    import userTable from './UserTable'

    export default {
        name: 'pagination-control',
        // template: '#pagination',
        data() {
            return {
            };
        },
        props: {
            currentPage: {
                default: 1,
                required: true,
            },
            maxPages: {
                type: Number,
                default: 1, ////00000
                required: true,
            },
        },
    }
</script>

<style scoped>
    .pagination {
        list-style: none;
        margin: 0;
        padding: 0;
        text-align: center;
        display: block;
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
        color: white;
    }
 .active{
        background: #76ad1f;
        color: #aafcc9;
    }
</style>