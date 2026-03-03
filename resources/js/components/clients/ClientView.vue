<script setup>
import { useClientStore } from "../../stores/client";
import { ref, reactive, computed, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";

const route = useRoute();
const router = useRouter();
const clientStore = useClientStore();
clientId = route.params.id;

onMounted(async () => {
    await userStore.byIdClient(userId);
});
</script>

<template>
    <div>

    </div>
</template>



const createClient = (data) => {

}

const byEmailClient = (data) => {

}

const updateClient = (id, data) => {

}

const deleteClient = (id) => {

}

const fDeleteClient = (id) => {

}

const changeManager = (clientId, managerId) => {

}
