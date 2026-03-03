<script setup>
import { useClientStore } from "../../stores/client";
import { ref, reactive, computed, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";

const route = useRoute();
const router = useRouter();
const clientStore = useClientStore();
const goToClient = () => {
    router.push('/client/' + clientStore.client.id)
}
const client = computed(() => clientStore.client);
const clients = computed(() => clientStore.clients);

onMounted(async () => {
    await clientStore.allClients();
});
</script>

<template>
    <form @submit.prevent="findByEmail">
            <input v-model="email" type="text" placeholder="Поиск по email" />
            <button type="submit">Поиск</button>
        </form>
        <button @click="router.push({ name: 'create-client' })">
            Создать клиента
        </button>
        <div v-if="user">
            <div
                style="
                    border: 1px solid black;
                    cursor: pointer;
                    margin-bottom: 10px;
                "
                @click="goToUser(user.id)"
            >
                <span>{{ user.name }}</span
                ><br />
                <span>{{ user.email }}</span>
            </div>
        </div>
        <div v-if="users" v-for="user in users" :key="user.id">
            <div
                style="
                    border: 1px solid black;
                    cursor: pointer;
                    margin-bottom: 10px;
                "
                @click="goToUser(user.id)"
            >
                <span>{{ user.name }}</span
                ><br />
                <span>{{ user.email }}</span>
            </div>
        </div>
    </div>
</template>
'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'company' => $this->company,
            'source' => $this->source,
            'status' => $this->status,
            'comments' => CommentResource::collection($this->comments),
