import { defineStore } from 'pinia'

export const useAuthStore = defineStore('authStore', {
  //state değişkenleri tutulur
  state: () => {
    return {
      user: null,
      errors: {},
    }
  },
  //getters hesaplanacak işlemleri yapar
  getters: {},
  //actions yapılabilecek işlemleri yapar
  actions: {
    /****** Get authenticated user *******/
    /*  veritabanından giriş yapan kullanıcının bilgilerini alır */
    async getUser() {
      if (localStorage.getItem('token')) {
        const res = await fetch('/api/user', {
          headers: {
            authorization: `Bearer ${localStorage.getItem('token')}`,
          },
        })
        const data = await res.json()
        if (res.ok) {
          this.user = data
        }
      }
    },

    /******* Login or Register user *************/
    //async ile asekron istek atar
    async authenticate(apiRoute, formData) {
      // /api/register demek
      const res = await fetch(`/api/${apiRoute}`, {
        //api istek ayarları
        method: 'POST',
        //stringify ile json formatına çevirir
        body: JSON.stringify(formData),
      })
      //dataları alır
      const data = await res.json()
      if (data.errors) {
        this.errors = data.errors
      } else {
        this.errors = {}
        localStorage.setItem('token', data.token)
        this.user = data.user
        //console.log(data)
        //redirct
        this.router.push({ name: 'home' })
      }
    },
    /******************* Logout user *******************/
    async logout() {
      const res = await fetch('/api/logout', {
        method: 'post',
        headers: {
          authorization: `Bearer ${localStorage.getItem('token')}`,
        },
      })

      const data = await res.json()
      //console.log(data)
      //çıkış yapıldığında token silinir ve user null olur
      if (res.ok) {
        this.user = null
        this.errors = {}
        localStorage.removeItem('token')
        this.router.push({ name: 'home' })
      }
    },
  },
})
