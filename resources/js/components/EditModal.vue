<template>
    <!-- Modal -->
    <div class="modal fade show">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Contact</h5>
                    <button type="button" class="close" @click="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-9">
                                <form class="form-inline">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control  " v-model="item.name">
                                    </div>

                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control" v-model="item.email">
                                    </div>

                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" class="form-control" v-model="item.address">
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-3">

                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="close">Close</button>
                    <button v-if="item.id" type="button" class="btn btn-primary" @click="saveChanges">Save changes</button>
                    <button v-if="!item.id"  type="button" class="btn btn-primary" @click="createItem">Add Contact</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "EditModal",
    props: ['itemEdit'],
    data() {
        return {
            item: {}
        }
    },
    watch: {
        itemEdit(value) {
            this.item = Object.assign({}, value);
        }
    },
    methods: {
        close() {
            this.$emit('close');
        },
        saveChanges() {
            axios.put('api/contact', this.item)
                .then(response => {
                    this.$emit('edited', response.data);
                })
                .catch(err => console.error(err))

        },
        createItem() {
                axios.post('api/contact', this.item)
                    .then(response => {
                        this.$emit('edited', response.data);
                    })
                    .catch(err => console.error(err))
        },
        itemEdited(item) {
            this.$emit('edited', item);
        }
    },
    mounted() {
        this.item = Object.assign({},this.itemEdit);
    }
}
</script>

<style scoped>
.modal-dialog {
    max-width: 800px;
}
.modal {
    display: block;
}
.form-group {
    padding-top: 10px;
}
.form-group label {
    min-width: 100px;
}
.form-group input {
    width: 250px;
}
</style>
