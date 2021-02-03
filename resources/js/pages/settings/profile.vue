<template>
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Profile</h2>
                </div>
            </div>
        </div>
        
    </div>
    <div class="content-body">
        <!-- Description -->
        <section id="description" class="card">
            <div class="card-content">
                <div class="card-body">
                    <form @submit.prevent="update" @keydown="form.onKeydown($event)">
                        <alert-success :form="form" :message="$t('info_updated')" />

                        <!-- Name -->
                        <div class="form-group row">
                          <label class="col-md-3 col-form-label text-md-right">{{ $t('name') }}</label>
                          <div class="col-md-7">
                            <input v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" class="form-control" type="text" name="name">
                            <has-error :form="form" field="name" />
                          </div>
                        </div>

                        <!-- Email -->
                        <div class="form-group row">
                          <label class="col-md-3 col-form-label text-md-right">{{ $t('email') }}</label>
                          <div class="col-md-7">
                            <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" type="email" name="email">
                            <has-error :form="form" field="email" />
                          </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group row">
                          <div class="col-md-9 ml-md-auto">
                            <v-button :loading="form.busy" type="success">
                              {{ $t('update') }}
                            </v-button>
                          </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!--/ Description -->
    </div>
  </div>
  
</template>

<script>
import Form from 'vform'
import { mapGetters } from 'vuex'

export default {
  scrollToTop: false,

  metaInfo () {
    return { title: this.$t('settings') }
  },

  data: () => ({
    form: new Form({
      name: '',
      email: ''
    })
  }),

  computed: mapGetters({
    user: 'auth/user'
  }),

  created () {
    // Fill the form with user data.
    this.form.keys().forEach(key => {
      this.form[key] = this.user[key]
    })
  },

  methods: {
    async update () {
      const { data } = await this.form.patch('/api/settings/profile')

      this.$store.dispatch('auth/updateUser', { user: data })
    }
  }
}
</script>
