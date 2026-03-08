<script setup>
import { useClientStore } from "../../stores/client";
import { ref, reactive, computed, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";

const route = useRoute();
const router = useRouter();
const clientStore = useClientStore();
const uClient = reactive({
    name: '',
    email: '',
    phone: '',
    company: '',
    source: '',
    status: '',
});
const client = computed(() => clientStore.client);
const id = route.params.id;

const updateClient = () => {
    clientStore.updateClient(id, uClient);
}
onMounted(async () => {
    await clientStore.byIdClient(id);
    if (client.value) {
    uClient.name    = client.value.name    || '';
    uClient.email   = client.value.email   || '';
    uClient.phone   = client.value.phone   || '';
    uClient.company = client.value.company || '';
    uClient.source  = client.value.source  || '';
    uClient.status  = client.value.status  || '';
    }
});

</script>

<template>
    <div v-if="clientStore.client">
        <h3>Обновление клиента</h3>
        <input v-model="uClient.name" placeholder="name"></input
        ><br />
        <input v-model="uClient.email" placeholder="email"></input
        ><br />
        <input v-model="uClient.phone" placeholder="phone"></input
        ><br />
        <input v-model="uClient.company" placeholder="company"></input
        ><br />
        <input v-model="uClient.source" placeholder="advertising,call,site"></input
        ><br />
        <input v-model="uClient.status" placeholder="new,active,archived"></input
        ><br />
        <button @click="updateClient">Отправить</button>
    </div>
</template>

