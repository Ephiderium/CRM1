<script setup>
import { useUserStore } from '../../stores/user';
import { useRouter } from 'vue-router'
import { ref, reactive, computed, onMounted } from 'vue';

const router = useRouter()
const userStore = useUserStore();
const user = userStore.user;
const newUser = reactive({
    name: user.name,
    email: user.email,
    is_active: user.is_active,
})
const updateUser = async () => {
    await userStore.updateUser(user.id, newUser);
}

onMounted(async () => {

});

</script>

<template>
    <h3>Обновление пользователя</h3><br/>
    <div>
        <form @submit.prevent="updateUser">
            <input v-model="newUser.name" placeholder="name">
            <input v-model="newUser.email" placeholder="email">
            <input v-model="newUser.is_active" placeholder="is_active 1,0">
            <button type="submit">Отправить</button>
        </form>
    </div>
</template>

