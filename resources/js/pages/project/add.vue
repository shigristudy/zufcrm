<template>
 <div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Add Project</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><router-link :to="{ name:'customprojects' }">Custom Projects</router-link>
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
                    
                   <fieldset class="form-group">
                        <label for="projectname">Project Name</label>
                        <input type="text" class="form-control" id="projectname" placeholder="Project Name">
                    </fieldset>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-secondary mr-1 mb-1 waves-effect waves-light">Back</button>
                        <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">Submit</button>
                    </div>
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
    return { title: this.$t("home") };
  },
  data(){
      return {
          form: new Form({
            payment_type : '',
            data_of_donation : '',
            full_name : '',
            gift_aid : '',
            city : '',
            postal_code : '',
            contact : '',
            email : '',
            address_line1 : '',
            address_line2 : '',
            status : '',
            
        })
      }
  },
  methods:{
      
  }
};
</script>
