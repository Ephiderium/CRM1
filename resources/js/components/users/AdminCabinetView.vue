<script setup>
import { useUserStore } from "../../stores/user";
import { useRouter } from "vue-router";
import { ref, reactive, computed, onMounted } from "vue";

const router = useRouter();
const userStore = useUserStore();
const users = computed(() => userStore.users);
const goToUser = (id) => {
    router.push({ path: "/user/" + id });
};
const user = computed(() => userStore.user);
const email = ref("");
const findByEmail = async () => {
    await userStore.byEmail({ email: email.value });
};

onMounted(async () => {
    await userStore.allUser();
});
</script>

<template>
    <div>
        <form @submit.prevent="findByEmail">
            <input v-model="email" type="text" placeholder="Поиск по email" />
            <button type="submit">Поиск</button>
        </form>
        <button @click="router.push({ name: 'create-user' })">
            Создать пользователя
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
