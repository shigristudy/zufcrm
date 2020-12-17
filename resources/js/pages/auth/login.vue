<template>
  <section class="row flexbox-container">
      <div class="col-xl-12 col-12 d-flex justify-content-center">
          <div class="card bg-authentication rounded-0 mb-0">
              <div class="row m-0 mb-3">
                  <div class="col-lg-6 d-lg-block d-none text-center align-self-center px-1 py-0">
                      <img :src="BaseUrlPublic+'/app-assets/images/pages/login.png'" alt="branding logo">
                  </div>
                  <div class="col-lg-6 col-12 p-0">
                      <div class="card rounded-0 mb-0 px-2">
                          <div class="card-header pb-1">
                              <div class="card-title">
                                  <h4 class="mb-0">Login</h4>
                              </div>
                          </div>
                          <p class="px-2">Welcome back, please login to your account.</p>
                          <div class="card-content">
                              <div class="card-body pt-1">
                                  <form @submit.prevent="login" @keydown="form.onKeydown($event)">
                                      <fieldset class="form-label-group form-group position-relative has-icon-left">
                                          <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" type="email" name="email">
                                          <div class="form-control-position">
                                              <i class="feather icon-user"></i>
                                          </div>
                                          <label for="user-name">{{ $t('email') }}</label>
                                          <has-error :form="form" field="email" />
                                      </fieldset>

                                      <fieldset class="form-label-group position-relative has-icon-left">
                                          <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" class="form-control" type="password" name="password">
                                          <div class="form-control-position">
                                              <i class="feather icon-lock"></i>
                                          </div>
                                          <label for="user-password">Password</label>
                                          <has-error :form="form" field="password" />
                                      </fieldset>
                                      <div class="form-group d-flex justify-content-between align-items-center">
                                          <div class="text-left">
                                              <fieldset class="checkbox">
                                                  <div class="vs-checkbox-con vs-checkbox-primary">
                                                      <input type="checkbox">
                                                      <span class="vs-checkbox">
                                                          <span class="vs-checkbox--check">
                                                              <i class="vs-icon feather icon-check"></i>
                                                          </span>
                                                      </span>
                                                      <span class="">Remember me</span>
                                                  </div>
                                              </fieldset>
                                          </div>
                                          <div class="text-right">
                                            <router-link :to="{ name: 'password.request' }" class="card-link">
                                              {{ $t('forgot_password') }}
                                            </router-link>
                                          </div>
                                      </div>
                                      <a href="auth-register.html" class="btn btn-outline-primary float-left btn-inline waves-effect waves-light">Register</a>
                                      <button type="submit" class="btn btn-primary float-right btn-inline waves-effect waves-light">Login</button>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
</template>

<script>
import Form from 'vform'
import Cookies from 'js-cookie'

export default {
  components: {
  },

  middleware: 'guest',

  metaInfo () {
    return { title: this.$t('login') }
  },

  data: () => ({
    form: new Form({
      email: '',
      password: ''
    }),
    remember: false
  }),

  methods: {
    async login () {
      // Submit the form.
      const { data } = await this.form.post('/api/login')

      // Save the token.
      this.$store.dispatch('auth/saveToken', {
        token: data.token,
        remember: this.remember
      })

      // Fetch the user.
      await this.$store.dispatch('auth/fetchUser')
      // // Fetch Woocommerce Project
      // await this.$store.dispatch('projects/fetchProjects')

      await this.$store.dispatch('permissions/fetchUserPermissions')
      // await this.$store.dispatch('projects/fetchProjects')

      // Redirect home.
      this.redirect()
    },

    redirect () {
      const intendedUrl = Cookies.get('intended_url')

      if (intendedUrl) {
        Cookies.remove('intended_url')
        this.$router.push({ path: intendedUrl })
      } else {
        this.$router.push({ name: 'dashboard' })
      }
    }
  }
}
</script>
<style scoped>
.app-content.content{
  margin-left: unset !important;
  position: absolute;
  top: 100px;
  left: 0;
  right: 0;
  bottom: 0;
}
</style>