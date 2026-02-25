<script setup>
import { useAuthStore } from '../../stores/auth';
import { ref, reactive } from 'vue';

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
