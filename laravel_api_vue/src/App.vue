<script setup>
import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
  <header>
    <nav>
      <RouterLink class="nav-link" to="/">Home</RouterLink>
    </nav>
  </header>

  <RouterView />
</template>

<style scoped></style>
