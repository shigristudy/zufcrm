<template>
 <div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Sponsor Student</h2>
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
                               <label for="donations">Donations</label>
                               <multiselect v-model="form.selectedDonations" 
                                            deselect-label="Can't remove this value" 
                                            track-by="id" :custom-label="customLabel"
                                            placeholder="Select Donations to Fund" 
                                            :options="options" 
                                            :searchable="true"
                                            :multiple="false" 
                                            :close-on-select="false" 
                                            :clear-on-select="false" 
                                            :allow-empty="true">
                                            <template slot="option" slot-scope="props">
                                                <div class="option__desc">
                                                    <span class="option__title">{{ props.option.order.first_name + ' ' + props.option.order.last_name + ' - ' + props.option.name }} ( {{ props.option.total }} )</span>
                                                   
                                                </div>
                                            </template>
                                </multiselect>
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

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<script>
import Form from 'vform'
export default {
  middleware: "auth",

  metaInfo() {
    return { title: 'Fund Student' };
  },
  data(){
      return { 
        options: [],
        message:'',
        form: new Form({
            selectedDonations : [],
            student_id: this.$route.params.id
        })
      }
  },
  created(){
      this.getDonations()
  },
  methods:{ 
    customLabel( {name,order,total} ){
        
        return `${name} — ${order.first_name} - ${order.last_name} - ${total}`
    },
    getDonations(){
        
        axios.get('/api/getAllUnAllocatedDonationsOneOff')
        .then((response) => {
          let data = response.data;
          this.options = data;
        }).catch((errors) => {
          console.log(errors);
        });
    },
    async handleSubmit () {
      const response = await this.form.post('/api/fund_students_montly')
      this.message = response.data.message
      this.getDonations()
      this.form.reset()
    }
  },
};
</script>
