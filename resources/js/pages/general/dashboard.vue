<template>
 <div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Dashboard</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- Description -->
        <section id="dashboard-analytics">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card bg-analytics text-white">
                        <div class="card-content">
                            <div class="card-body text-center">
                                <img :src="BaseUrlPublic+'/app-assets/images/elements/decore-left.png'" class="img-left" alt="card-img-left">
                                <img :src="BaseUrlPublic+'/app-assets/images/elements/decore-right.png'" class="img-right" alt="card-img-right">
                                <div class="avatar avatar-xl bg-primary shadow mt-0">
                                    <div class="avatar-content">
                                        <i class="feather icon-award white font-large-1"></i>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <h1 class="mb-2 text-white">Welcome, {{ user.name }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </section>
        <section id="statistics-card" v-if="dashboard">
            <div class="row">
                <div class="col-xl-2 col-md-4 col-sm-6">
                    <div class="card text-center">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="avatar bg-rgba-info p-50 m-0 mb-1">
                                    <div class="avatar-content">
                                        <i class="feather icon-users text-info font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="text-bold-700">{{ dashboard.hafiz_students }}</h2>
                                <p class="mb-0 line-ellipsis">Hifz Students</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4 col-sm-6">
                    <div class="card text-center">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="avatar bg-rgba-warning p-50 m-0 mb-1">
                                    <div class="avatar-content">
                                        <i class="feather icon-users text-info font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="text-bold-700">{{ dashboard.scholar_students }}</h2>
                                <p class="mb-0 line-ellipsis">Scholar Students</p>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-xl-2 col-md-4 col-sm-6">
                    <div class="card text-center">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="avatar bg-rgba-danger p-50 m-0 mb-1">
                                    <div class="avatar-content">
                                        <i class="feather icon-x-circle text-info font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="text-bold-700">{{ dashboard.not_claimed_count }}</h2>
                                <p class="mb-0 line-ellipsis">Unclaimed GiftAids</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4 col-sm-6">
                    <div class="card text-center">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="avatar bg-rgba-primary p-50 m-0 mb-1">
                                    <div class="avatar-content">
                                        <i class="feather icon-heart text-primary font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="text-bold-700">{{ dashboard.claimed_count }}</h2>
                                <p class="mb-0 line-ellipsis">Total Claimed</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4 col-sm-6">
                    <div class="card text-center">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="avatar bg-rgba-success p-50 m-0 mb-1">
                                    <div class="avatar-content">
                                        <i class="feather icon-award text-success font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="text-bold-700">{{ dashboard.submitted_count }}</h2>
                                <p class="mb-0 line-ellipsis">Generated</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4 col-sm-6">
                    <div class="card text-center">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="avatar bg-rgba-danger p-50 m-0 mb-1">
                                    <div class="avatar-content">
                                        <i class="feather icon-award text-info font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="text-bold-700">{{ dashboard.reports_count }}</h2>
                                <p class="mb-0 line-ellipsis">Claimed Reports</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 col-sm-6">
                    <div class="card text-center">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="avatar bg-rgba-danger p-50 m-0 mb-1">
                                    <div class="avatar-content">
                                        <i class="feather icon-award text-info font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="text-bold-700">{{ dashboard.no_of_unallocated_spons }}</h2>
                                <p class="mb-0 line-ellipsis">Unallocated Sponsorships</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 col-sm-6">
                    <div class="card text-center">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="avatar bg-rgba-danger p-50 m-0 mb-1">
                                    <div class="avatar-content">
                                        <i class="fa fa-gbp text-info font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="text-bold-700">{{ round2Fixed(dashboard.total_income_raised) }}</h2>
                                <p class="mb-0 line-ellipsis">Total Income Raised</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4 col-sm-6">
                    <div class="card text-center">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="avatar bg-rgba-danger p-50 m-0 mb-1">
                                    <div class="avatar-content">
                                        <i class="fa fa-gbp text-info font-medium-5"></i>
                                    </div>
                                </div>
                                <h2 class="text-bold-700">{{ round2Fixed(dashboard.total_income_raised_this_year) }}</h2>
                                <p class="mb-0 line-ellipsis">Total Income Raised This Year</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>     
        </section>
        <div class="row">
            <div class="col-lg-4 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Top Projects</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <ul class="activity-timeline timeline-left list-unstyled">
                                <li v-for="top_project in dashboard.top_projects" :key="top_project.product.id">
                                    <div class="timeline-icon bg-success">
                                        <i class="feather icon-check font-medium-2 align-middle"></i>
                                    </div>
                                    <div class="timeline-info">
                                        <p class="font-weight-bold mb-0">{{ project_name_computed(top_project.product) }}</p>
                                        <span class="font-small-3">has Completed <strong>{{ top_project.total_donations }}</strong> Donations and raised <strong>{{ round2Fixed(top_project.total_amount) }}</strong></span>
                                    </div>    
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
  middleware: "auth",
  data(){
      return {
          dashboard:{}
      }
  },
  metaInfo() {
    return { title: 'Dashboard' };
  },
  methods:{
      project_name_computed(p){
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
    fetchData(){
      axios
        .post('/api/dashboard')
        .then((res) => {
          this.dashboard = res.data
        })
        .catch((errors) => {
          console.log(errors);
        });
    },
  },
  created() {
    this.fetchData();
  },
  computed: mapGetters({
    user: 'auth/user'
  }),
};
</script>
<style scoped>
/*========================================================
        DARK LAYOUT
=========================================================*/
#dashboard-analytics .img-left {
  width : 200px;
  position : absolute;
  top : 0;
  left : 0;
}

#dashboard-analytics .img-right {
  width : 175px;
  position : absolute;
  top : 0;
  right : 0;
}

#dashboard-analytics .bg-analytics {
  background : -webkit-linear-gradient(332deg, #4d8135, rgb(77 129 53));
  background :         linear-gradient(118deg, #4d8135, rgb(77 129 53));
}
#dashboard-analytics .bg-analytics .avatar {
  margin-bottom : 2rem;
}

#dashboard-analytics table tr th:first-child, #dashboard-analytics table tr td:first-child {
  padding-left : 2rem;
}

#dashboard-analytics table tr th:last-child, #dashboard-analytics table tr td:last-child {
  padding-right : 2rem;
}

#dashboard-analytics table td {
  padding : 0.75rem;
}

@media only screen and (max-width: 576px) {
  #dashboard-analytics .img-left, #dashboard-analytics .img-right {
    width : 140px;
  }
}
</style>