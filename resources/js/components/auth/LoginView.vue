<script setup>
import { useAuthStore } from "../../stores/auth";
import { ref, reactive, onMounted } from "vue";
import { useRouter } from "vue-router";

const router = useRouter();
const userAuthJson = localStorage.getItem("user");
const userAuth = userAuthJson ? JSON.parse(userAuthJson) : null;
const credentials = reactive({
    email: "",
    password: "",
});
const authStore = useAuthStore();

const login = async () => {
    await authStore.login(credentials);
};
</script>

<template>
    <div>
        <div v-if="userAuth?.name">
            <button v-if="userAuth.role === 'admin'" @click="router.push({name: 'admin-cabinet'})">Кабинет админа</button>
            <button v-if="userAuth.role !== 'admin'" @click="router.push({name: 'user-cabinet'})">Кабинет</button>
        </div>
        <form @submit.prevent="login">
            <label for="login">Введите email</label>
            <input id="login" type="email" v-model="credentials.email" />
            <label for="password">Введите пароль</label>
            <input
                id="password"
                type="password"
                v-model="credentials.password"
            />
            <button type="submit">Отправить</button>
        </form>
    </div>
</template>
