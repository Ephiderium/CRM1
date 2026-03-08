<script setup>
import { useClientStore } from "../../stores/client";
import { ref, reactive, computed, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";

const route = useRoute();
const router = useRouter();
const clientStore = useClientStore();
const goToClient = (id) => {
    router.push("/client/" + id);
};
const client = computed(() => clientStore.client);
const clients = computed(() => clientStore.clients);
const email = ref('');

onMounted(async () => {
    await clientStore.allClients();
});
</script>

<template>
    <div>
        <form @submit.prevent="findByEmail">
            <input v-model="email" type="text" placeholder="Поиск по email" />
            <button type="submit">Поиск</button>
        </form>
        <button @click="router.push({ name: 'create-client' })">
            Создать клиента
        </button>
        <div v-if="client">
            <div
                style="
                    border: 1px solid black;
                    cursor: pointer;
                    margin-bottom: 10px;
                "
                @click="goToClient(client.id)"
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
        </div>
        <div v-if="clients" v-for="client in clients" :key="client.id">
            <div
                style="
                    border: 1px solid black;
                    cursor: pointer;
                    margin-bottom: 10px;
                "
                @click="goToClient(client.id)"
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
        </div>
    </div>
</template>

