<template>
    <transition name="modal-fade">
        <div class="modal-backdrop">
            <div class="modal"
                 role="dialog"
                 aria-labelledby="modalTitle"
                 aria-describedby="modalDescription"
            >
                <header class="modal-header"
                        id="modalTitle">
                    <slot name="header">
                        Edit this tweet!
                        <button
                                type="button"
                                class="btn-close"
                                @click="close"
                                aria-label="Close modal"
                        > x
                        </button>
                    </slot>
                </header>
                <section class="modal-body" id="modalDescription">
                    <slot name="body">
                        <textarea v-model="editText" cols="25" rows="5">{{editText}}</textarea>

                    </slot>
                </section>
                <footer class="modal-footer">
                    <slot name="footer">
                        JSN ©
                        <button
                                type="button"
                                class="btn-green"
                                @click="save"
                                aria-label="Close modal"
                        >
                            Save & Close
                        </button>
                    </slot>
                </footer>
            </div>
        </div>
    </transition>
</template>

<script>
    import adminTable from './AdminTable'

    export default {
        name: "modal",
        props: {
            editText: {
                default: "",
                required: true,
            }, id: {
                default: ""
            },
        },
        // data() {
        //     return {
        //         reditText: this.editText
        //     };
    // },
        computed:{
            edit:function () {
                return this.editText
            }
        },
    methods: {
        close()
        {
            this.$emit('close');
        }
    ,
        save()
        {
            axios.post('/update', {id: this.id, editText: this.editText}).then(respond => {
                console.log(respond.data)
            });
            this.close();
            this.$emit('save');
        }
    ,
    }
    ,
    }

</script>

<style>
    .modal-backdrop {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: rgba(0, 0, 0, 0.3);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .modal {
        position: relative;
        background: #FFFFFF;
        box-shadow: 2px 2px 20px 1px;
        overflow-x: auto;
        display: flex;
        flex-direction: column;
    }

    .modal-header,
    .modal-footer {
        padding: 15px;
        display: flex;
    }

    .modal-header {
        border-bottom: 1px solid #eeeeee;
        color: #4AAE9B;
        justify-content: space-between;
    }

    .modal-footer {
        border-top: 1px solid #eeeeee;
        justify-content: flex-end;
    }

    .modal-body {
        position: relative;
        padding: 20px 10px;
    }

    .btn-close {
        border: none;
        font-size: 20px;
        /*padding: 20px;*/
        cursor: pointer;
        font-weight: bold;
        color: #4AAE9B;
        background: transparent;
    }

    .btn-green {
        color: white;
        background: #4AAE9B;
        border: 1px solid #4AAE9B;
        border-radius: 2px;
    }
</style>