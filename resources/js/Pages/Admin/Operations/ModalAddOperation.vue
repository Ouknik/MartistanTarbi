<template>
    <div class="modal">
        <h2>Ajouter une opération pour le {{ selectedDate }}</h2>
        <label>
            Date de l'opération:
            <input type="date" v-model="operation.dateOperation" />
        </label>
        <label>
            Prix de l'opération:
            <input type="number" v-model="operation.prixOperation" />
        </label>
        <label>
            Montant validé de l'opération:
            <input type="number" v-model="operation.MontantValideeOperation" />
        </label>
        <label>
            Montant restant de l'opération:
            <input type="number" v-model="operation.MontantRestantOperation" />
        </label>
        <label>
            Nom de l'opération:
            <input type="text" v-model="operation.nomOperation" />
        </label>
        <label>
            Description de l'opération:
            <input type="text" v-model="operation.descriptionOperation" />
        </label>
        <label>
            Clinique:
            <input type="text" v-model="operation.clinique" />
        </label>
        <label>
            État de l'opération:
            <input type="text" v-model="operation.etatOperation" />
        </label>
        <button @click="$emit('closeModal')">Fermer</button>
    </div>
</template>

<script setup>
import { ref, reactive } from 'vue'

const props = defineProps(['selectedDate'])
const operation = reactive({
    dateOperation: null,
    prixOperation: null,
    MontantValideeOperation: null,
    MontantRestantOperation: null,
    nomOperation: '',
    descriptionOperation: '',
    clinique: '',
    etatOperation: ''
})
</script>
