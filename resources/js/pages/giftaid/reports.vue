<template>
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-left mb-0">Gift Aids Reports</h2>
          </div>
        </div>
      </div>
     
    </div>
    <div class="content-body">
      <!-- Description -->
        <section id="basic-examples">
          <div class="row mb-2">
            <div class="col-md-12">
              <form @submit.prevent="fetchData">
                <input v-model="search" type="search" class="form-control" placeholder="Search">
              </form>
            </div>
          </div>
          <div class="row match-height">
              
              <div class="col-xl-4 col-md-6 col-sm-12" v-for="(item,index) in donations" :key="index">
                  <div class="card">
                      <div class="card-content">
                          <div class="card-body">
                              
                              <h5 class="mt-1">{{ item.title }}</h5>
                              <p class="card-text">{{ item.note }}</p>
                              <hr class="my-1">
                              <div class="d-flex justify-content-between mt-2">
                                  
                                  <div class="">
                                      <p class="font-medium-2 mb-0">{{ formattedDate(item.created_at) }}</p>
                                      <router-link :to="{ name:'gift_aids_reports_details',params:{id:item.id} }" class="btn btn-primary mt-1">View Donations</router-link>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="card p-3" v-if="donations.length <= 0 ">
                  <h3 class="text-center">No Record Found</h3>
              </div>
             
          </div>
          <!--begin::Pagination-->
          <div class="d-flex justify-content-between align-items-center flex-wrap">
            <pagination v-if="pagination.last_page > 1" :pagination="pagination" :offset="5" @paginate="fetchData()"></pagination>
          </div>
          <!--end::Pagination-->
      </section>
    
    </div>
  </div>
</template>

<script>

import pagination from './pagination.vue'
export default {
  components: { pagination: pagination },
  middleware: "auth",

  metaInfo() {
    return { title: 'Claimed' };
  },
  data() {
    return {
      donations:[],
      pagination:{},
      search:'',
      total_records:0,
    }
  },
  methods: {
    fetchData(){
      axios
        .post('/api/reports?page=' + this.pagination.current_page || 1,{'search':this.search })
        .then((res) => {
          this.donations = res.data.data.data
          this.pagination = res.data.pagination
          this.total_records = res.data.pagination.total
        })
        .catch((errors) => {
          console.log(errors);
        });
    },
  },
  created() {
    this.fetchData();
  },
};
</script>
