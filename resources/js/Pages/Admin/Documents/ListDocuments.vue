<template>
    <div class="tab-pane fade show" id="pills-documents-fill" role="tabpanel" aria-labelledby="pills-documents-tab-fill">
        <div class="text-right"></div>
        <div class="text-right">
            <div class="dropdown">
                <button class="btn btn-outline-primary " type="button" id="dropdownMenuButton" data-toggle="modal"
                    data-target="#AddDocument" aria-haspopup="true" aria-expanded="false">
                    Ajouter un Document
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="iq-card">
                    <div class="iq-card-body">
                        <div id="table" class="table-editable" v-if="documents.length > 0">
                            <table class="table table-bordered table-responsive-md table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>N°</th>
                                        <th>Nom Document</th>
                                        <th>Date</th>
                                        <th>Aperçu</th>
                                        <th>Supprimer</th>
                                        <th>Visualiser</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="document in paginatedDocuments" v-bind:key="document.id">
                                        <td contenteditable="false">
                                            {{ document.id }}
                                        </td>
                                        <td contenteditable="false">
                                            {{ document.nomDocument }}
                                        </td>
                                        <td contenteditable="false">
                                            {{ formatDate(document.created_at) }}
                                        </td>
                                        <td>
                                            <template v-if="isImage(document.pathDocument)">
                                                <img :src="'/' + document.pathDocument" class="object-cover h-40 w-80"
                                                    width="200" height="200" @click="showImage(document)" />
                                            </template>
                                            <template v-else>
                                                <object :data="'/' + document.pathDocument" type="application/pdf"
                                                    width="200" height="200">
                                                </object>
                                            </template>
                                        </td>
                                        <td>
                                            <button @click="deleteDocument(document)" type="button"
                                                class="btn btn-outline-danger  mb-1 mt-3"><i
                                                    class="ri-delete-bin-6-line"></i></button>
                                        </td>
                                        <td>
                                            <template v-if="isImage(document.pathDocument)">
                                                <a :href="'/' + document.pathDocument" target="_blank">Visualiser</a>
                                            </template>
                                            <template v-else>
                                                <a :href="'/' + document.pathDocument" target="_blank">Visualiser</a>
                                            </template>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                    <nav aria-label="Documents pagination" v-if="documents.length > perPage">
                                        <ul class="pagination">
                                            <li class="page-item" :class="{ 'disabled': currentPage === 1 }">
                                                <button class="page-link" @click="currentPage = 1"
                                                    :disabled="currentPage === 1" aria-label="First">
                                                    <span aria-hidden="true">&laquo;</span>
                                                    <span class="sr-only">First</span>
                                                </button>
                                            </li>
                                            <li class="page-item" :class="{ 'disabled': currentPage === 1 }">
                                                <button class="page-link" @click="currentPage -= 1"
                                                    :disabled="currentPage === 1" aria-label="Previous">
                                                    <span aria-hidden="true">&lsaquo;</span>
                                                    <span class="sr-only">Previous</span>
                                                </button>
                                            </li>
                                            <li class="page-item" v-for="page in totalPages" :key="page"
                                                :class="{ 'active': currentPage === page }">
                                                <button class="page-link" @click="currentPage = page"
                                                    :disabled="currentPage === page">{{ page }}</button>
                                            </li>
                                            <li class="page-item" :class="{ 'disabled': currentPage === totalPages }">
                                                <button class="page-link" @click="currentPage += 1"
                                                    :disabled="currentPage === totalPages" aria-label="Next">
                                                    <span aria-hidden="true">&rsaquo;</span>
                                                    <span class="sr-only">Next</span>
                                                </button>
                                            </li>
                                            <li class="page-item" :class="{ 'disabled': currentPage === totalPages }">
                                                <button class="page-link" @click="currentPage = totalPages"
                                                    :disabled="currentPage === totalPages" aria-label="Last">
                                                    <span aria-hidden="true">&raquo;</span>
                                                    <span class="sr-only">Last</span>
                                                </button>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Apercu Image -->
    <div class="modal fade" ref="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered large-modal">
            <div class="modal-content" ref="modalContent">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Aperçu de l'image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img :src="selectedImage" class="img-fluid" alt="Image preview" />
                </div>
            </div>
        </div>
    </div>
    <!-- End Moadl Apercu Image -->
</template>

<script setup>
import { ref, computed, toRefs } from 'vue';
import { router } from '@inertiajs/vue3';
import Pagination from 'vue-pagination-2';
// Import Edit Component Echographie
import { useToast } from 'vue-toast-notification';
const props = defineProps({
    documents: Object,
    patient: Object,

});

</script>
<script>
export default {
    components: {},
    props: ["data", "errors"],
    data() {
        return {
            selectedImage: '',
            perPage: 4,
            currentPage: 1,
        };
    },
    computed: {
        paginatedDocuments() {
            const start = (this.currentPage - 1) * this.perPage;
            const end = start + this.perPage;
            return this.documents.slice(start, end);
        },
        totalPages() {
            return Math.ceil(this.documents.length / this.perPage);
        },
    },
    methods: {
        isImage(path) {
            return path.toLowerCase().endsWith('.jpg') ||
                path.toLowerCase().endsWith('.jpeg') ||
                path.toLowerCase().endsWith('.png') ||
                path.toLowerCase().endsWith('.gif') ||
                path.toLowerCase().endsWith('.svg');
        },

        getDocuments() {
            router.get("/documents", data.documents, {
                preserveState: true,
                preserveScroll: true,
            });
        },
        formatDate(timestamp) {
            return new Date(timestamp).toLocaleDateString("en-GB");
        },
        async showImage(document) {
            this.selectedImage = '/' + document.pathDocument;

            const img = new Image();
            img.src = this.selectedImage;

            await new Promise((resolve) => {
                img.onload = () => resolve();
            });

            this.$refs.modalContent.style.width = `${img.width}px`;

            const imageModal = new bootstrap.Modal(this.$refs.imageModal);
            imageModal.show();
        },
        // Function Delete Document
        deleteDocument(document) {
            router.delete(`/documents/${document.id}`, {
                preserveState: true,
                preserveScroll: true,
                onSuccess: (page) => {
                    useToast().success("Bien Supprimer", {
                        position: "bottom-right",
                        duration: 3000,
                    });
                },
            });
        },


    },
};
</script>
