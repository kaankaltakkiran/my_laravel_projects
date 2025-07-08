import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import RegisterView from '../views/Auth/RegisterView.vue'
import LoginView from '../views/Auth/LoginView.vue'
import { useAuthStore } from '../stores/auth'
import CreateView from '../views/Posts/CreateView.vue'
import ShowView from '../views/Posts/ShowView.vue'
import UpdateView from '../views/Posts/UpdateView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
    },
    {
      path: '/register',
      name: 'register',
      component: RegisterView,
      /* sadece giriş yapmamış kullancılar görebilir sayfayı */
      meta: { guest: true },
    },
    {
      path: '/login',
      name: 'login',
      component: LoginView,
      /* sadece giriş yapmamış kullancılar görebilir sayfayı */
      meta: { guest: true },
    },
    {
      path: '/create',
      name: 'create',
      component: CreateView,
      /* sadece giriş yapmış kullancılar görebilir sayfayı */
      meta: { auth: true },
    },
    {
      path: '/posts/:id',
      name: 'show',
      component: ShowView,
    },
    {
      path: '/posts/update/:id',
      name: 'update',
      component: UpdateView,
      meta: { auth: true },
    },
  ],
})
//giriş yapmamış kullancılar giriş yapmadan sayfaya giremesinsin
router.beforeEach(async (to, from) => {
  const authStore = useAuthStore()
  await authStore.getUser()
  //meta guest varsa ve giriş yapmış kullanıcı varsa
  if (to.meta.guest && authStore.user) {
    return { name: 'home' }
  }

  //meta auth varsa ve giriş yapmamış kullanıcı varsa
  if (!authStore.user && to.meta.auth) {
    return { name: 'login' }
  }
})

export default router
