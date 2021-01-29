<template>
 <div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">View Donation</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><router-link :to="{ name:'donations' }">Donations</router-link>
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
        <!-- Description -->
        <section id="description" class="card" v-if="donation">
            <div class="card-content">
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-6 col-md-6">
                            <h3 class="ml-2">Donor Details</h3>
                            <div class="mt-1 px-2">
                                <strong class="mb-0 d-inline">Title:</strong>
                                <p class="d-inline">{{ donation.title }}</p>
                            </div>
                            <div class="mt-1 px-2">
                                <h6 class="mb-0 d-inline">Name:</h6>
                                <p class="d-inline">{{ donation.first_name + " " +donation.last_name }}</p>
                            </div>
                            <div class="mt-1 px-2">
                                <h6 class="mb-0 d-inline">City:</h6>
                                <p class="d-inline">{{ donation.city }}</p>
                            </div>
                            <div class="mt-1 px-2">
                                <h6 class="mb-0 d-inline">Postcode:</h6>
                                <p class="d-inline">{{ donation.postcode }}</p>
                            </div>
                            <div class="mt-1 px-2">
                                <h6 class="mb-0 d-inline">Country:</h6>
                                <p class="d-inline">{{ donation.country }}</p>
                            </div>
                            <div class="mt-1 px-2">
                                <h6 class="mb-0">Address:</h6>
                                <p class="mb-0">{{ donation.address_1 }}</p>
                                <p class="mb-0">{{ donation.address_2 }} </p>
                            </div>
                            <div class="mt-1 px-2">
                                <h6 class="mb-1 d-inline">Gift Aid Claimed?:</h6>
                                <div v-if="donation.claimed == null" class="d-inline badge badge-pill badge-glow badge-primary mr-1 mb-1">Not Claimed</div>
                                <div v-else class="d-inline badge badge-pill badge-glow badge-success mr-1 mb-1">Claimed</div>
                            </div>
                            
                        </div>
                        <div class="col-6 col-md-6">
                            <h3 class="ml-2">Contact Details</h3>
                            <div class="mt-1 px-2">
                                <h6 class="mb-0 d-inline">Email:</h6>
                                <p class="d-inline">{{ donation.email }}</p>
                            </div>
                            <div class="mt-1 px-2">
                                <h6 class="mb-0 d-inline">Phone:</h6>
                                <p class="d-inline">{{ donation.phone }}</p>
                            </div>
                            
                            <h3 class="ml-2">Donation Details</h3>
                            <div class="mt-1 px-2">
                                <h6 class="mb-1 d-inline">Date of Donation:</h6>
                                <p class="d-inline">{{ donation.donation_date }}</p>
                            </div>
                            <div class="mt-1 px-2">
                                <h6 class="mb-1 d-inline">Payment Type:</h6>
                                <p class="d-inline">{{ donation.payment_method }}</p>
                            </div>
                            <div class="mt-1 px-2">
                                <h6 class="mb-1 d-inline">Gift Aid?:</h6>
                                <div  class="d-inline badge badge-pill badge-glow badge-info mr-1 mb-1">{{ donation.gift_aid }}</div>
                            </div>
                            
                        </div>
                    </div>
                    <hr>
                    <div id="invoice-items-details" class="pt-1 invoice-items-table">
                        <div class="row">
                            <div class="table-responsive col-12">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <!-- <th>S#</th> -->
                                            <th>Project</th>
                                            <th>Donation Type</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="line in donation.items" :key="line.id">
                                            <!-- <td>{{ line.id }}</td> -->
                                            <td>{{ line.product.name }}</td>
                                            <td>{{ line.donation_type }}</td>
                                            <td>{{ round2Fixed(line.total) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div id="invoice-total-details" class="invoice-total-table">
                        <div class="row">
                            <div class="col-7 offset-5">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <tbody>
                                            <tr>
                                                <th>TOTAL</th>
                                                <td class="text-center">{{ round2Fixed(totalAmount) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--/ Description -->
    </div>
  </div>
</template>

<script>
export default {
  middleware: "auth",

  metaInfo() {
    return { title: 'View Donation' };
  },

  data() {
      return {
        donation:{},
        total:0
      }
  },
  
  created(){
      this.getData("/api/donation/getSingleDonation/"+this.$route.params.id)
  },

  methods:{
      getData(url) {
        axios
            .get(url, { params: this.tableData })
            .then((response) => {
                this.donation = response.data;
            })
            .catch((errors) => {
                console.log(errors);
            });
    },
  },
  computed: {
        totalAmount: function () {
            if( this.donation.items && this.donation.items.length >0 ){

                var sum = 0;
                this.donation.items.forEach(e => {
                    sum += parseFloat(e.total);
                });
                return sum;
            }else{
                return 0;
            }
        }
    }

};
</script>

<style scoped>
    table thead{
        background:rgba(34, 41, 47, 0.05);
    }
</style>
