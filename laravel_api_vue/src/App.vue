<script setup>
import { RouterLink, RouterView } from 'vue-router'
import { useAuthStore } from '@/stores/auth'

const authStore = useAuthStore()
</script>

<template>
  <header>
    <nav>
      <!--    :to ile router dosyasındaki name ile bağladık -->
      <RouterLink class="nav-link" :to="{ name: 'home' }">Home</RouterLink>
      <div v-if="authStore.user" class="flex items-center space-x-6">
        <p class="text-sm text-slate-300">Welcome back {{ authStore.user.name }}</p>
        <RouterLink :to="{ name: 'create' }" class="nav-link"> New Post </RouterLink>

        <form @submit.prevent="authStore.logout">
          <button class="nav-link">Logout</button>
        </form>
      </div>
      <div v-else class="space-x-6">
        <RouterLink class="nav-link" :to="{ name: 'register' }">Register</RouterLink>
        <RouterLink class="nav-link" :to="{ name: 'login' }">Login</RouterLink>
      </div>
    </nav>
  </header>

  <RouterView />
</template>

<style scoped></style>
