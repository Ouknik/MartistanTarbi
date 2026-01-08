<script setup>
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
import EasyDataTable from "vue3-easy-data-table";
//import { InertiaModal, ModalSlot } from "@tofandel/inertia-vue-modal";

const props = defineProps({
    users: Object,
});

const searchValue = ref("");
const searchField = ref(["name", "email"]);
const headers = [
    { text: "name", value: "name", sortable: true },
    { text: "Email", value: "email", sortable: true },
    { text: "type", value: "type", sortable: true },
    { text: "Action", value: "operation" },
];
// Modals
const showAddUserModalFlag = ref(false);
const showEditUserModalFlag = ref(false);
const newUser = ref({ name: "", email: "" });
const editedUser = ref({ id: null, name: "", email: "" });

const showAddUserModal = () => {
    // Show the Add User modal
    showAddUserModalFlag.value = true;
};

const showEditUserModal = (user) => {
    // Show the Edit User modal with user data
    editedUser.value = { ...user };
    showEditUserModalFlag.value = true;
};
const modals = () => {
    // Add user data to the database using Laravel API and close modal
    $router.visit;
};

const addUser = () => {
    // Add user data to the database using Laravel API and close modal
    router
        .post("/users", newUser.value)
        .then(() => {
            showAddUserModalFlag.value = false;
            fetchUsers();
        })
        .catch((error) => {
            console.error(error);
        });
};

const updateUser = () => {
    // Update user data in the database using Laravel API and close modal
    router
        .put(`/users/${editedUser.value.id}`, editedUser.value)
        .then(() => {
            showEditUserModalFlag.value = false;
            fetchUsers();
        })
        .catch((error) => {
            console.error(error);
        });
};

const deleteUser = (user) => {
    // Delete user from the database using Laravel API
    if (confirm("Are you sure you want to delete this user?")) {
        router
            .delete(`/users/${user.id}`)
            .then(() => {
                fetchUsers();
            })
            .catch((error) => {
                console.error(error);
            });
    }
};

const resetModal = () => {
    // Reset modal data on close
    newUser.value = { name: "", email: "" };
    editedUser.value = { id: null, name: "", email: "" };
    showAddUserModalFlag.value = false;
    showEditUserModalFlag.value = false;
};
</script>
<template>
    <div class="row">
        <div class="form-group col-md-8 col-lg-4">
            <input
                type="text"
                class="form-control"
                placeholder="Recherche..."
                id="cno"
                v-model="searchValue"
            />
        </div>
        <div class="form-group col-md-2 col-lg-8 text-right">
            <!-- Add User Button -->
            <button
                type="button"
                class="btn btn-primary"
                data-toggle="modal"
                data-target="#addmedicaments"
                @click="showAddUserModal"
            >
                Ajouter
            </button>
            <button @click="modals">Load in modal</button>
        </div>
    </div>
    <slot></slot>

    <div class="row"></div>
    <EasyDataTable
        buttons-pagination
        :items="users"
        :headers="headers"
        :search-value="searchValue"
        :search-field="searchField"
        :rows-per-page="8"
        alternating
    >
        <template #item-operation="item">
            <button @click="showEditUserModal(item)" class="btn btn-info m-2">
                edit
                <i class="ri-eye-line"></i>
            </button>
            <button @click="deleteUser(row)" class="btn btn-info m-2">
                delete
                <i class="ri-eye-line"></i>
            </button>
        </template>
    </EasyDataTable>

    <!-- <div class="modal fade" id="addmedicaments" tabindex="-1" role="dialog" aria-labelledby="addmedicamentsLabel"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addmedicamentsLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">


                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div> -->

</template>
