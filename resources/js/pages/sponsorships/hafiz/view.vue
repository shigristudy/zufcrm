<template>
 <div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">View Student</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><router-link :to="{ name:'sponsorships.hafiz' }">Hafiz Students</router-link>
                            </li>
                            <li class="breadcrumb-item"><a href="#">View</a>
                            </li>
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
                                     <img style="width:150px;" :src="AssetsBaseUrl+'project/'+student.profile_picture" class="users-avatar-shadow rounded mb-2 pr-2 ml-1" alt="avatar">
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
                                            <td v-if="student.sponsored == 1"><div class="badge badge-pill badge-glow badge-success mr-1 mb-1">Sponsored</div></td>
                                            <td v-else><div class="badge badge-pill badge-glow badge-success mr-1 mb-1">Not Sponsored</div></td>
                                        </tr>
                                    </tbody></table>
                                </div>
                                <div class="col-12">
                                    <router-link :to="{ name:'sponsorships.hafiz.edit',params:{id:student.id} }" class="btn btn-primary mr-1 waves-effect waves-light"><i class="feather icon-edit-1"></i> Edit</router-link>
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
        
        <section id="collapsible">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card collapse-icon accordion-icon-rotate">
                        <div class="card-header">
                            <h4 class="card-title">Sponsorships Details</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body" v-if="student.donations && student.donations.length>0">
                                <div class="default-collapse collapse-bordered">
                                    <div class="card collapse-header" v-for="donation in student.donations" :key="donation.id" >
                                        <div :id="'headingCollapse'+donation.id" class="card-header collapsed" 
                                            data-toggle="collapse" role="button" 
                                            :data-target="'#collapse'+donation.id" 
                                            aria-expanded="false" :aria-controls="'collapse'+donation.id">
                                            <span class="lead collapse-title">
                                                <strong>Sponsored By: </strong> {{ donation.order.first_name + " " + donation.order.last_name }}
                                            </span>
                                        </div>
                                        <div :id="'collapse'+donation.id" role="tabpanel" :aria-labelledby="'headingCollapse'+donation.id" class="collapse" style="">
                                            <div class="card-content">
                                                <div class="card-body">
                                                    
                                                    <div v-if="donation.order.webhooks.length>0">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover-animation mb-0">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">Resource Type</th>
                                                                        <th scope="col">Order ID</th>
                                                                        <th scope="col">Action</th>
                                                                        <th scope="col">Reason/Description</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr v-for="webhook in donation.order.webhooks" :key="'webhook'+webhook.id">
                                                                        <th scope="row">{{webhook.resource_type}}</th>
                                                                        <td>{{ webhook.order_id }}</td>
                                                                        <td>
                                                                            <div v-if="webhook.action == 'failed'" class="badge badge-pill badge-glow badge-danger mr-1 mb-1">Failed</div>
                                                                            <div v-else class="badge badge-pill badge-glow badge-success mr-1 mb-1">Paid Out</div>
                                                                        </td>
                                                                        <td>{{ JSON.parse(webhook.payload).details.description }}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div v-else>
                                                        Nothing to Show
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


    </div>
  </div>
</template>

<script>
export default {
  middleware: "auth",

  metaInfo() {
    return { title: 'View Scholar Student' };
  },

  data() {
      return {
        student:{},
        total:0
      }
  },
  
  created(){
      this.getData("/api/student/getSingleStudent/"+this.$route.params.id)
  },

  methods:{
      getData(url) {
        axios
            .get(url)
            .then((response) => {
                console.log(response)
                this.student = response.data;
            })
            .catch((errors) => {
                console.log(errors);
            });
    },
  },
  

};
</script>


