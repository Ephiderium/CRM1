<script setup>
import { useUserStore } from "../../stores/user";
import { ref, reactive, computed, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";

const route = useRoute();
const router = useRouter();
const userStore = useUserStore();
const changePassord = async () => {
    await userStore.changePassword(passwordData);
};
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
const role = ref("");
const changeRole = async () => {
    const roleData = {
        email: userStore.user.email,
        role: role.value,
    };
    await userStore.changeRole(roleData);
};
let userId = route.params.id;
const user = localStorage.getItem("user");
const passwordData = reactive({
    current_password: "",
    new_password: "",
});
const userAuthJson = localStorage.getItem("user");
const userAuth = userAuthJson ? JSON.parse(userAuthJson) : null;

onMounted(async () => {
    await userStore.findUser(userId);
    userId = userStore.user.id
});
</script>

<template>
    <div v-if="userStore.user">
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
        <button @click="deleteUser(userId)">Удалить аккаунт</button>
        <label for="name">Имя</label>
        <textarea id="name">{{ userStore.user.name }}</textarea>
        <label for="email">Почта</label>
        <textarea id="email">{{ userStore.user.email }}</textarea>
        <label for="role">Роль</label>
        <textarea id="role">{{ userStore.user.role }}</textarea>
        <!-- <button>Клиенты</button> нижележащие кнопки делать после реализации их модулей -->
        <button>Задачи</button>
        <button>Комментарии</button>
        <button>Сделки</button>
        <div v-if="userAuth.role === 'admin'">
            <button @click="disableUser({ 'email': userStore.user.email })">
                Отключить пользователя
            </button>
            <form @submit.prevent="changeRole(roleData)">
                <input
                    type="text"
                    v-model="role"
                    placeholder="Введите новую роль"
                />
                <button>Изменить роль</button>
            </form>
        </div>
    </div>
</template>
