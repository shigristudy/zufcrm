<template>
 <div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Add User</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><router-link :to="{ name:'users' }">Users</router-link>
                            </li>
                            <li class="breadcrumb-item"><a href="#">Add</a> </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- Description -->
        <section id="description" class="card">
            <div class="card-content">
                <div class="card-body">
                    <form @submit.prevent="handleSubmit" @keydown="form.onKeydown($event)">
                        <alert-success :form="form" :message="message" />
                            <fieldset class="form-group">
                                <label for="name">Name</label>
                                <input v-model="form.name" 
                                        :class="{ 'is-invalid': form.errors.has('name') }" 
                                        type="text" 
                                        class="form-control" 
                                        id="name" 
                                        name="name" 
                                        placeholder="Name">
                                <has-error :form="form" field="name" />
                            </fieldset>     
                            <fieldset class="form-group">
                                <label for="email">Email</label>
                                <input v-model="form.email" 
                                        :class="{ 'is-invalid': form.errors.has('email') }" 
                                        type="email" 
                                        class="form-control" 
                                        id="email" 
                                        name="email" 
                                        placeholder="Email">
                                <has-error :form="form" field="name" />
                            </fieldset>     
                            <fieldset class="form-group">
                                <label for="role">Role</label>
                                <select v-model="form.role" class="form-control" name="role" >
                                    <option v-for="role in roles" :key="role.id">{{ role.name }}</option>
                                </select>
                            </fieldset>     
                            <fieldset class="form-group">
                                <label for="password">Password</label>
                                <input v-model="form.password" 
                                        :class="{ 'is-invalid': form.errors.has('password') }" 
                                        type="password" 
                                        class="form-control" 
                                        id="password" 
                                        name="password" 
                                        placeholder="password">
                                <has-error :form="form" field="name" />
                            </fieldset>     
                           
                            
                            <div class="d-flex justify-content-between">
                                <router-link class="btn btn-secondary mr-1 mb-1 waves-effect waves-light" :to="{ name:'users' }">Back</router-link>
                                <v-button :loading="form.busy" type="primary">Submit</v-button>
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
export default {
  middleware: "auth",

  metaInfo() {
    return { title: 'User Add' };
  },
  data(){
      return {
          roles:[],
          message:'',
          form: new Form({
            name : '',
            email : '',
            password : '',
            role:'administrator'
        })
      }
  },
  created(){
      this.getAllRoles()
  },
  methods:{ 
    async handleSubmit () {
      const response = await this.form.post('/api/settings/user/store')
      this.message = response.data.message
      this.form.reset()
    },
     getAllRoles(){
        axios.get(this.AdminBaseUrl+'settings/role/getAllRoles')
        .then((res) => {
            this.roles = res.data.data
        })
    },

  },
};
</script>
