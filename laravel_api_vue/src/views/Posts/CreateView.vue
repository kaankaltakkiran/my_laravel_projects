<script setup>
import { reactive } from 'vue'
import { usePostsStore } from '@/stores/posts'
import { storeToRefs } from 'pinia'

//pinia store createPost fonksiyonunu kullanıyoruz
const { createPost } = usePostsStore()
//storedaki hataları alıyoruz
const { errors } = storeToRefs(usePostsStore())

//form verilerini tutar
const formData = reactive({
  title: '',
  body: '',
})
</script>

<template>
  <main>
    <h1 class="title">Create a new Post</h1>
    <form class="w-1/2 mx-auto space-y-6" @submit.prevent="createPost(formData)">
      <div>
        <input type="text" placeholder="Post Title" v-model="formData.title" />
        <p v-if="errors.title" class="error">{{ errors.title[0] }}</p>
      </div>
      <div>
        <textarea rows="6" placeholder="Post Content" v-model="formData.body"></textarea>
        <p v-if="errors.body" class="error">{{ errors.body[0] }}</p>
        <button class="primary-btn">Create Post</button>
      </div>
    </form>
  </main>
</template>
