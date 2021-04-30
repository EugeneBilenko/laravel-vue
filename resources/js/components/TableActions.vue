<template>
    <div class="dropdown" v-bind:class="{ show: isActive }" >
        <span class="show-items" @click="isActive = !isActive">
            <i class="fas fa-ellipsis-v"></i>
        </span>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"  v-bind:class="{ show: isActive }">
            <a class="dropdown-item" @click="editItem()">Edit</a>
            <a class="dropdown-item" @click="deleteItem()">Delete</a>
        </div>
    </div>
</template>

<script>
export default {
    name: "TableActions",
    data() {
        return {
            isActive: false,
        }
    },
    methods: {
        editItem() {
            this.$emit('editItem');
            this.isActive = false;
        },
        deleteItem() {
            this.$emit('deleteItem');
            this.isActive = false;
        }
    }
}
</script>

<style scoped>
.show-items {
    cursor: pointer;
    padding-right: 10px;
    padding-left: 10px;
}
.dropdown-menu {
    cursor: pointer;
}
</style>
