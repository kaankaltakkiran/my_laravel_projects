import { defineStore } from 'pinia'
import { useAuthStore } from './auth'

export const usePostsStore = defineStore('postsStore', {
  state: () => ({
    errors: {},
  }),
  actions: {
    /******************* Get all posts *******************/
    async getAllPosts() {
      const res = await fetch('/api/posts')
      const data = await res.json()

      return data
      //console.log(data)
    },
    /******************* Get a post *******************/
    /*  post idsine göre post bilgilerini alır */
    async getPost(post) {
      const res = await fetch(`/api/posts/${post}`)
      const data = await res.json()

      return data.post
      //console.log(data)
    },

    /************* Create a post ***************/

    //async ile asekron istek atar ve post oluşturur
    async createPost(formData) {
      const res = await fetch('/api/posts', {
        method: 'post',
        headers: {
          Authorization: `Bearer ${localStorage.getItem('token')}`,
        },
        /*  stringify json formatına çevirir  */
        body: JSON.stringify(formData),
      })

      const data = await res.json()
      //hata varsa
      if (data.errors) {
        this.errors = data.errors
      } else {
        this.router.push({ name: 'home' })
        this.errors = {}
      }
    },
    /******************* Delete a post *******************/
    async deletePost(post) {
      const authStore = useAuthStore()
      /* giriş yapmış kullanıcı ile post id eşleşiyorsa */
      if (authStore.user.id === post.user_id) {
        const res = await fetch(`/api/posts/${post.id}`, {
          method: 'delete',
          headers: {
            Authorization: `Bearer ${localStorage.getItem('token')}`,
          },
        })

        const data = await res.json()
        //silme başarılıysa anasayfaya yönlendirir
        if (res.ok) {
          this.router.push({ name: 'home' })
        }
        //console.log(data)
      }
    },
    /******************* Update a post *******************/
    async updatePost(post, formData) {
      const authStore = useAuthStore()
      /* giriş yapan kullanıcı ile post id eşleşiyorsa */
      if (authStore.user.id === post.user_id) {
        const res = await fetch(`/api/posts/${post.id}`, {
          method: 'PUT',
          headers: {
            Authorization: `Bearer ${localStorage.getItem('token')}`,
          },
          body: JSON.stringify(formData),
        })

        const data = await res.json()
        if (data.errors) {
          this.errors = data.errors
        } else {
          this.router.push({ name: 'home' })
          this.errors = {}
        }
      }
    },
  },
})
