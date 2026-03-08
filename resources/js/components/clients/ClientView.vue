<script setup>
import { useClientStore } from "../../stores/client";
import { ref, reactive, computed, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";

const route = useRoute();
const router = useRouter();
const clientStore = useClientStore();
const client = computed(() => clientStore.client);
const clientId = route.params.id;

onMounted(async () => {
    await clientStore.byIdClient(clientId);
});
</script>

<template>
    <div
        v-if="clientStore.client"
        style="border: 1px solid black; cursor: pointer; margin-bottom: 10px"
        @click="goToclient(client.id)"
    >
        <span>{{ client.name }}</span
        ><br />
        <span>{{ client.email }}</span
        ><br />
        <span>{{ client.phone }}</span
        ><br />
        <span>{{ client.company }}</span
        ><br />
        <span>{{ client.source }}</span
        ><br />
        <span>{{ client.status }}</span
        ><br />
        <!-- Когда будут коменты -->
        <button>Комментарии</button>
    </div>
</template>

const createClient = (data) => { } const byEmailClient = (data) => { } const
updateClient = (id, data) => { } const deleteClient = (id) => { } const
fDeleteClient = (id) => { } const changeManager = (clientId, managerId) => { }
