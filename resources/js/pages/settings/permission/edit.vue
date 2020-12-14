<template>
 <div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Add Persmission</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><router-link :to="{ name:'settings.permissions' }">Permissions</router-link>
                            </li>
                            <li class="breadcrumb-item"><a href="#">Add</a>
                            </li>
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
                                        placeholder="name in lower case should be unique">
                                <has-error :form="form" field="name" />
                            </fieldset>     
                           
                            <fieldset class="form-group">
                                <label>Display Name</label>
                                <input v-model="form.display_name" 
                                        :class="{ 'is-invalid': form.errors.has('display_name') }" 
                                        type="text" 
                                        class="form-control" 
                                        id="display_name" 
                                        name="display_name" 
                                        placeholder="Display Name">
                                <has-error :form="form" field="display_name" />
                            </fieldset>

                            <fieldset class="form-group">
                                <label>Description</label>
                                <input v-model="form.description" 
                                        :class="{ 'is-invalid': form.errors.has('description') }" 
                                        type="text" 
                                        class="form-control" 
                                        id="description" 
                                        name="description" 
                                        placeholder="Address Line 3">
                                <has-error :form="form" field="description" />
                            </fieldset>

                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-secondary mr-1 mb-1 waves-effect waves-light">Back</button>
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
    return { title: 'Permission Add' };
  },
  data(){
      return {
          message:'',
          form: new Form({
            name : '',
            display_name : '',
            description : '',
        })
      }
  },
  methods:{ 
    async handleSubmit () {
      const response = await this.form.post('/api/settings/permission/update')
      this.message = response.data.message
      this.form.reset()
    }
  },
};
</script>
