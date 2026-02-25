<script setup>
import { useAuthStore } from './stores/auth';

const authStore = useAuthStore();
</script>

<template>
    <div>
        <button @click="authStore.logout">Выход</button>
    </div>
    <router-view />
</template>
