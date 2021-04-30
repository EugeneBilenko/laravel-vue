<template>
    <div class="container main-content">
        <edit-modal
            v-if="showModal"
            :itemEdit="itemEdit"
            @edited="itemEdited"
            @close="closeModal"
        />
        <div class="row">
            <div class="col-md-8">
                <h1>Contacts</h1>
            </div>
            <div class="col-md-4 text-right">
                <button
                    v-if="showDeleteButton"
                    type="button"
                    class="btn btn-danger"
                    @click="deleteSelectedContacts">
                 Delete Contacts</button>
                <button
                    type="button"
                    class="btn btn-primary"
                    @click="addItem">
                    <i class="fas fa-plus"></i>
                    Add Contact
                </button>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col"> <input type="checkbox" v-model="allSelected"></th>
                        <th scope="col"></th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Address</th>
                        <th scope="col">Created</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(item, i) in items" :key="item.id">
                        <th scope="row"><input type="checkbox" v-model="item.selected"></th>
                        <th scope="row">img</th>
                        <th scope="row">{{item.name}}</th>
                        <th scope="row">{{item.email}}</th>
                        <th scope="row">{{item.address}}</th>
                        <th scope="row">{{item.created_at | dateFromNow}}</th>
                        <th scope="row">
                            <table-actions
                                :item-id="item.id"
                                @editItem="editItem(item, i)"
                                @deleteItem="deleteContacts([item.id])"
                            />
                        </th>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-backdrop fade show"  v-if="showModal"></div>
    </div>
</template>

<script>
    import TableActions from "./TableActions";
    import EditModal from "./EditModal";
    export default {
        components: {EditModal, TableActions},
        data() {
            return {
                items: [],
                allSelected: false,
                showModal: false,
                itemEdit: {},
                itemPosition: null,
            }
        },
        computed: {
            showDeleteButton() {
                return this.selectedIds.length > 0;
            },
            selectedIds() {
                return this.items.filter(item => !!item.selected).map(item => item.id);
            }
        },
        methods: {
            fetchData() {
                axios.get('api/contacts')
                    .then(response => this.items = response.data)
                    .catch(err => console.error(err))
            },
            deleteSelectedContacts() {
               this.deleteContacts(this.selectedIds);
            },
            deleteContacts(ids) {
                let data = {
                    params: {
                        ids: ids,
                    }
                }
                axios.delete('api/contacts', data)
                    .then(response => {
                        this.fetchData();
                    })
                    .catch(err => console.error(err))
            },
            addItem() {
                this.showModal = true;
            },
            editItem(item, i) {
                this.itemEdit = item;
                this.itemPosition = i;
                this.showModal = true;
            },
            closeModal() {
                this.itemEdit = {};
                this.itemPosition = null;
                this.showModal = false;
            },
            itemEdited(newItem) {
                if (Number.isInteger(this.itemPosition)) {
                    this.items[this.itemPosition] = Object.assign( this.items[this.itemPosition], newItem);
                } else {
                    this.items.unshift(newItem);
                }
                this.closeModal();
            }
        },
        watch: {
            allSelected(value) {
                for (let i in this.items) {
                    this.items[i].selected = value;
                }
            }
        },
        filters: {
            dateFromNow: function (value) {
                return moment(value).fromNow();
            }
        },
        mounted() {
            this.fetchData();
        }
    }
</script>

<style scoped>
.main-content {
    margin-top: 20px;
    padding-top: 30px;
    border: black solid 2px;
}
</style>
