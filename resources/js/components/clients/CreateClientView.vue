<script setup>
import { useClientStore } from "../../stores/client";
import { ref, reactive, computed, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";

const route = useRoute();
const router = useRouter();
const clientStore = useClientStore();
const client = reactive({
    name: '',
    email: '',
    phone: '',
    company: '',
    source: '',
    status: '',
});
const createClient = () => {
    clientStore.createClient(client);
}

</script>

<template>
    <div>
        <h3>Создание клиента</h3>
        <input v-model="client.name" placeholder="name"></input
        ><br />
        <input v-model="client.email" placeholder="email"></input
        ><br />
        <input v-model="client.phone" placeholder="phone"></input
        ><br />
        <input v-model="client.company" placeholder="company"></input
        ><br />
        <input v-model="client.source" placeholder="advertising,call,site"></input
        ><br />
        <input v-model="client.status" placeholder="new,active,archived"></input
        ><br />
        <button @click="createClient">Отправить</button>
    </div>
</template>

