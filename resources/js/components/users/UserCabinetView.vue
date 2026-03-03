<script setup>
import { ref, reactive, computed, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";

const route = useRoute();
const router = useRouter();
const userAuthJson = localStorage.getItem("user");
const userAuth = userAuthJson ? JSON.parse(userAuthJson) : null;
const changePassord = async () => {
    await userStore.changePassword(passwordData);
};
const id = userAuth.id;
const deleteUser = async (id) => {
    await userStore.deleteUser(id);
};
const clientsByUser = async () => {};
const tasksByUser = async () => {};
const commentsByUser = async () => {};
const dealsByUser = async () => {};
const disableUser = async (email) => {
    await userStore.disableUser(email);
};
const passwordData = reactive({
    current_password: "",
    new_password: "",
});
</script>

<template>
    <div v-if="userAuth">
        <button @click="router.push({ name: 'update-user' })">
            Обновить данные
        </button>
        <form @submit.prevent="changePassord()">
            <input
                v-model="passwordData.current_password"
                placeholder="Текущий пароль"
                type="password"
            />
            <input
                v-model="passwordData.new_password"
                placeholder="Новый пароль"
                type="password"
            />
            <button type="submit">Сменить пароль</button>
        </form>
        <button @click="deleteUser(id)">Удалить аккаунт</button>
        <label for="name">Имя</label>
        <textarea id="name">{{ userAuth.name }}</textarea>
        <label for="email">Почта</label>
        <textarea id="email">{{ userAuth.email }}</textarea>
        <label for="role">Роль</label>
        <textarea id="role">{{ userAuth.role }}</textarea>
        <!-- <button>Клиенты</button> нижележащие кнопки делать после реализации их модулей -->
        <button>Задачи</button>
        <button>Комментарии</button>
        <button>Сделки</button>
    </div>
</template>
