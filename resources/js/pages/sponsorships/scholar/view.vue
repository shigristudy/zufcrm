<template>
 <div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">View Student</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><router-link :to="{ name:'sponsorships.scholar' }">Scholar Students</router-link></li>
                            <li class="breadcrumb-item"><a href="#">View</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <div class="content-body">
        <section class="page-users-view">
            <div class="row">
                <!-- account start -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="users-view-image">
                                    <!-- profile_picture -->
                                    <img style="width:150px;" :src="BaseUrlPublic+'uploads/project/'+student.profile_picture" class="users-avatar-shadow rounded mb-2 pr-2 ml-1" alt="avatar">
                                </div>
                                <div class="col-12 col-sm-9 col-md-6 col-lg-5">
                                    <table>
                                        
                                        <tbody>
                                            <tr>
                                                <td class="font-weight-bold">Full Name</td>
                                                <td>{{ student.full_name }}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Father Name</td>
                                                <td>{{ student.father_name }}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Gender</td>
                                                <td>{{ student.gender }}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Teacher Name</td>
                                                <td>{{ student.teacher_name }}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Date Of Birth</td>
                                                <td>{{ student.dob }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>


                                <div class="col-12 col-md-12 col-lg-5">
                                    <table class="ml-0 ml-sm-0 ml-lg-0">
                                        <tbody><tr>
                                            <td class="font-weight-bold">Status</td>
                                            <td>{{ student.status }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">City</td>
                                            <td>{{ student.city }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Class Name</td>
                                            <td>{{ student.class_name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Student ID</td>
                                            <td>{{ student.student_id }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Sponsored?</td>
                                            <td v-if="student.submitted == 1"><div class="badge badge-pill  badge-success mr-1 mb-1">Sponsored</div></td>
                                            <td v-else><div class="badge badge-pill  badge-success mr-1 mb-1">Not Sponsored</div></td>
                                        </tr>
                                    </tbody></table>
                                </div>
                                <div class="col-12">
                                    <router-link :to="{ name:'sponsorships.scholar.edit',params:{id:student.id} }" class="btn btn-primary mr-1 waves-effect waves-light"><i class="feather icon-edit-1"></i> Edit</router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <section id="description" class="card">
            <div class="card-header">
                <h4 class="card-title">Personal Statement</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="card-text">
                        <p>{{ student.personal_statement }}</p>
                    </div>
                </div>
            </div>
        </section>
        <section id="description" class="card" v-if="student.donations && student.donations.length>0">
            <div class="card-header">
                <h4 class="card-title">Sponsorships</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="row dataTables_wrapper mb-1">
                        <div class="col-md-12">
                            <success-alert :successful="is_added_successfully" :message="successMessage"></success-alert>
                        </div>
                        <div class="col-md-12 text-right">
                            <div class="spinner-border" v-if="sending" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered">
                        <tr v-for="donation in student.donations" :key="donation.id">
                            <th>
                                Sponsored By: {{ donation.order.first_name + " " + donation.order.last_name + ' , Through Project ' + format_type(donation.item.product) }}
                            </th>
                            <td>
                                {{ round2Fixed(donation.item.total) }}
                            </td>
                            <td> 
                                <div class="dropdown">
                                    <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle waves-effect waves-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(263px, 36px, 0px); top: 0px; left: 0px; will-change: transform;">
                                        <a class="dropdown-item" target="_blank" :href="'/view_reports/' + donation.id">View Report</a>
                                        <a class="dropdown-item" @click="sendReport(donation.id)">Send Report</a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span v-if="donation.date_end != null">{{ 'Donation will Expire on ' + donation.date_end }}</span>
                                <span v-else>Recurring Donation</span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>

        <section id="description" class="card">
            <div class="card-header">
                <h4 class="card-title">Status</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="col-md-12">
                        <success-alert :successful="is_status_added_successfully" :message="successMessage"></success-alert>
                    </div>
                    <form class="form form-horizontal" @submit.prevent="handleSubmit" @keydown="form.onKeydown($event)">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>Date</span>
                                        </div>
                                        <div class="col-md-8">
                                            <input v-model="form.date" 
                                                    :class="{ 'is-invalid': form.errors.has('date') }" 
                                                    type="date" 
                                                    class="form-control" 
                                                    id="date" 
                                                    name="date" 
                                                    placeholder="Date">
                                            <has-error :form="form" field="date" />
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <span>notes</span>
                                        </div>
                                        <div class="col-md-8">
                                            <textarea v-model="form.notes" 
                                                    :class="{ 'is-invalid': form.errors.has('notes') }" 
                                                    type="notes" 
                                                    class="form-control" 
                                                    id="notes" 
                                                    name="notes" 
                                                    placeholder="notes"></textarea>
                                            <has-error :form="form" field="notes" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8 offset-md-4">
                                    <v-button :loading="form.busy" type="primary">Submit</v-button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <br>
                    <hr>
                    <div class="row" v-if="student.statuses && student.statuses.length > 0">
                        <div class="col-12 col-md-12" v-for="(status,index) in student.statuses" :key="index">
                            <div class="media-list media-bordered">
                                <div class="media">
                                    <div class="media-body">
                                        <h4 class="media-heading">{{ status.date }}</h4>
                                        {{ status.notes }}
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>
    </div>
  </div>
</template>

<script>
import SuccessAlert from '~/components/alert/SuccessAlert.vue'
import Form from 'vform'
export default {
    components:{'success-alert':SuccessAlert },
  middleware: "auth",

  metaInfo() {
    return { title: 'View Scholar Student' };
  },

  data() {
      return {
        student:{},
        total:0,
        is_added_successfully:false,
        is_status_added_successfully:false,
        successMessage:'',
        sending:false,
        form: new Form({
            date : '',
            notes : '',
            student_id:this.$route.params.id
        }),
      }
  },
  
  created(){
      this.getData("/api/student/getSingleStudent/"+this.$route.params.id)
  },

  methods:{
      format_type(p){
        var name = '';
        var type = '';
        if(p.type == 'simple'){
            type = '[One-Off]';
        }else{
            type = '[Monthly]';
        }
        if(p.project_page != null && p.project_page != ''){
            name = p.project_page + ' - ' + p.name + ' - ' + type
        }else{
            name = p.name + ' - ' + type
        }
        return name;
      },
      getData(url) {
        axios
            .get(url)
            .then((response) => {
                this.student = response.data;
                console.log(this.student.statuses)
            })
            .catch((errors) => {
                console.log(errors);
            });
    },
    async handleSubmit () {
      const response = await this.form.post('/api/student_status/store')
      
      this.message = response.data.message

      this.student.statuses.push({
          'date':this.form.date,
          'notes':this.form.notes,
      })
       this.is_status_added_successfully = true; 
       this.successMessage = response.data.message     
      this.form.reset()
    },
    async sendReport(id){
        this.sending = true
        axios.post('/api/send_report_to_donor',{id:id})
        .then((response) => {
            console.log(response.data)
            this.is_added_successfully = true; 
            this.successMessage = response.data.message 
            this.sending = false
        }).catch((errors) => {
            console.log(errors);
        });
    },
    
  },
  

};
</script>


