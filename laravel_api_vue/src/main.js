import './assets/main.css'

import { createApp, markRaw } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import './assets/main.css'
import router from './router'

const app = createApp(App)
//pinia içinde router kullanabilmek için
const pinia = createPinia()

pinia.use(({ store }) => {
  /* markraw ile router objesini pinia state e atarken koruyoruz */
  store.router = markRaw(router)
})
app.use(pinia)
//app.use(createPinia())
app.use(router)

app.mount('#app')
