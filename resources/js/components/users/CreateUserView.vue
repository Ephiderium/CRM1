<script setup>
import { useUserStore } from '../../stores/user';
import { useRouter } from 'vue-router'
import { ref, reactive, computed, onMounted } from 'vue';

const router = useRouter()
const userStore = useUserStore();
const newUser = reactive({
    name: '',
    email: '',
    password: '',
    is_active: true,
    role: '',
})
const createUser = async () => {
    await userStore.createUser(newUser);
}

onMounted(async () => {

});

</script>

<template>
    <h3>Создание пользователя</h3><br/>
    <div>
        <form @submit.prevent="createUser">
            <input v-model="newUser.name" placeholder="name">
            <input v-model="newUser.email" placeholder="email">
            <input type="password" v-model="newUser.password" placeholder="password min:8">
            <input v-model="newUser.role" placeholder="admin,manager,user,viewer">
            <button type="submit">Отправить</button>
        </form>
    </div>
</template>

