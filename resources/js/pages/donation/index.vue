<template>
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-left mb-0">Reports</h2>
          </div>
        </div>
      </div>
      <div
        class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none"
      >
        <div class="form-group breadcrum-right">
            <router-link :to="{ name:'donation.add' }"  class="btn btn-primary mr-1 mb-1 waves-effect waves-light">Add Donation</router-link>
        </div>
      </div>
    </div>
    <div class="content-body">
      <!-- Description -->
      <div id="accordionWrapa50" class="card" role="tablist" aria-multiselectable="true">
        <div class="accordion" id="accordionExample0" data-toggle-hover="true">
          <div class="collapse-border-item collapse-header card collapse-bordered">
              <div class="card-header collapsed" id="heading200" data-toggle="collapse" role="button" data-target="#collapse200" aria-expanded="false" aria-controls="collapse200">
                  <span class="lead collapse-title">
                      Advance Filter
                  </span>
              </div>

              <div id="collapse200" class="collapse" aria-labelledby="heading200" data-parent="#accordionExample0" style="">
                  <div class="card-body">
                      <form @submit.prevent="handleSubmit" @keydown="tableData.form.onKeydown($event)">
                        <div class="row">
                          <div class="col-md-3">
                            <fieldset class="form-group">
                                <label for="basicInput">GIFT AID</label>
                                <select class="form-control" v-model="tableData.form.gift_aid">
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                    <option value="written">Written</option>
                                    <option value="online">Online</option>
                                    <option value="Verbal">Verbal</option>
                                </select>
                            </fieldset>
                          </div>
                          <div class="col-md-3">
                            <fieldset class="form-group">
                                <label for="basicInput">Project</label>
                                <select class="form-control" v-model="tableData.form.project">
                                    <option value="Bank">Bank</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Cheque">Cheque</option>
                                </select>
                            </fieldset>
                          </div>
                          <div class="col-md-3">
                            <fieldset class="form-group">
                                <label for="basicInput">Donation Type</label>
                                <select class="form-control" v-model="tableData.form.donation_type">
                                    <option value="online">On-line</option>
                                    <option value="offline">Off-Line</option>
                                </select>
                            </fieldset>
                          </div>
                          <div class="col-md-3">
                            <fieldset class="form-group">
                                <label for="basicInput">Payment Method</label>
                                <select class="form-control" v-model="tableData.form.payment_method">
                                    <option value="Bank">Bank</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Cheque">Cheque</option>
                                    <option value="stripe">Stripe</option>
                                    <option value="ppec_paypal">Paypal</option>
                                    <option value="Eazy Collect">Eazy Collect</option>
                                </select>
                            </fieldset>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3">
                            <fieldset class="form-group">
                                <label for="basicInput">Date From</label>
                                <input type="date" class="form-control" v-model="tableData.form.date_from">
                            </fieldset>
                          </div>
                          <div class="col-md-3">
                            <fieldset class="form-group">
                                <label for="basicInput">Date To</label>
                                <input type="date" class="form-control" v-model="tableData.form.date_to">
                            </fieldset>
                          </div>
                          
                          <div class="col-md-3">
                            <fieldset class="form-group">
                                <label for="basicInput">Has Sponsored?</label>
                                <select class="form-control" v-model="tableData.form.has_sponsored">
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </fieldset>
                          </div>
                        </div>
                        <div class="d-flex justify-content-between">
                          <button type="submit" class="btn btn-secondary mr-1 mb-1 waves-effect waves-light" @click="clearFilters()">Clear</button>
                          <v-button :loading="tableData.form.busy" type="primary">Filter</v-button>
                        </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
    </div>
      <section id="description" class="card">
        <div class="card-content">
          <div class="card-body">
            <div class="row dataTables_wrapper mb-1">
              <div class="col-sm-12 col-md-6">
                <div class="dataTables_length">
                  <label
                    >Show <select
                      class="custom-select custom-select-sm form-control form-control-sm"
                      v-model="tableData.length"
                      @change="getData()"
                    >
                      <option
                        v-for="(records, index) in perPage"
                        :key="index"
                        :value="records"
                      >
                        {{ records }}
                      </option>
                    </select> entries
                  </label>
                </div>
              </div>
              <div class="col-sm-12 col-md-6">
                <div class="dataTables_filter">
                  <label
                    >Search:<input
                                class="form-control form-control-sm"
                                type="search"
                                v-model="tableData.search"
                                placeholder="Search Table"
                                @input="getData()"
                            />
                    </label>
                </div>
              </div>
            </div>
            <div class="table-responsive">
                <datatable
                class="table-striped"
                :columns="columns"
                :sortKey="sortKey"
                :sortOrders="sortOrders"
                @sort="sortBy"
                >
                <tbody>
                    <tr v-for="item in donations" :key="item.id">
                      <td>
                        <div class="mr-1 mb-1 d-inline" v-for="product in item.items" :key="'product_id'+product.id">{{ product.product.name }}</div>
                      </td>
                      <td>{{ item.first_name + " " + item.last_name }}</td>
                      <td><div class="badge badge-pill badge-glow badge-success mr-1 mb-1">{{ item.gift_aid }}</div></td>
                      <td>{{ formattedDateDDMMYY(item.donation_date) }}</td>
                      <td>{{ (item.payment_method == 'ppec_paypal') ? 'Paypal' : capitalize(item.payment_method ) }}</td>
                      <td>{{ round2Fixed(item.order_total) }}</td>
                     
                      
                      <td class="text-center">
                        <div class="dropdown">
                              <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle waves-effect waves-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                              </button>
                              <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(263px, 36px, 0px); top: 0px; left: 0px; will-change: transform;">
                                <router-link class="dropdown-item" :to="{ name:'donation.view',params:{ id:item.id } }">View</router-link>
                                <router-link class="dropdown-item" :to="{ name:'donation.edit',params:{ id:item.id } }">Edit</router-link>
                              </div>
                          </div>
                      </td>
                    </tr>
                </tbody>
                </datatable>
            </div>
            <pagination
              :pagination="pagination"
              @getpageData="getData"
              @prev="getData(pagination.prevPageUrl)"
              @next="getData(pagination.nextPageUrl)"
            >
            </pagination>
          </div>
        </div>
      </section>
      <!--/ Description -->
    </div>
  </div>
</template>

<script>
import Datatable from "~/components/datatable/Datatable.vue";
import Pagination from "~/components/datatable/Pagination.vue";
import Form from 'vform'
export default {
  components: { datatable: Datatable, pagination: Pagination },
  middleware: "auth",

  metaInfo() {
    return { title: 'Donations' };
  },
  data() {
    let sortOrders = {};
    let columns = [
      { label : 'Projects',name : 'name'},
      { label : 'Sponsor By',name : 'first_name'},
      { label : 'Giftaid',name : 'gift_aid'},
      { label : 'Donation Date',name : 'donation_date'},
      { label : 'Payment Method',name : 'payment_method'},
      { label : 'Total',name : 'order_total',sortable:true},
      { label : 'Action',name : 'action'},
    ];
    columns.forEach((column) => {
      sortOrders[column.name] = -1;
    });
    return {
      wooProducts:[],
      donations: [],
      columns: columns,
      sortKey: "first_name",
      sortOrders: sortOrders,
      perPage: ["10", "20", "30"],
      tableData: {
        draw: 0,
        length: 10,
        search: "",
        column: 0,
        dir: "desc",
        filtering:false,
        form: new Form({
            gift_aid : '',
            project : '',
            donation_type : "",
            payment_method : "",
            date_from : "",
            date_to : "",
            has_sponsored : "",
        })
      },
      pagination: {
        lastPage: "",
        currentPage: "",
        total: "",
        lastPageUrl: "",
        nextPageUrl: "",
        prevPageUrl: "",
        from: "",
        to: "",
        links:[]
      },
      
    };
  },
  methods: {
    clearFilters(){
      this.form.reset()
      this.tableData.filtering = false;
    },
    async handleSubmit () {
      this.tableData.filtering = true;
      this.getData()
    },
    // async getProjects(){
    //     // // Fetch Woocommerce Project
    //     //   await this.$store.dispatch('projects/fetchProjects')

    //     let instance = this
    //     axios.get('https://www.ziaulummahfoundation.org.uk/wp-json/wc/v3/products?per_page=100',{
    //         auth: {
    //             username :'ck_4202435a3ffa2878c84d3064e2e5463f7a234589', 
    //             password :'cs_91b6f3fd2894b1a818f8c38e912ca56756b88ba6'
    //         }
    //     }).then(function (response) {
    //         response.data.map(p => {
    //             let project = {
    //                 id : p.id,
    //                 name : p.name,
    //                 type : p.type,
    //                 price : p.price,
    //             };
    //             if(p.type != 'grouped'){
    //                 instance.wooProducts.push(project)
    //             }
    //         })
            
    //     })
    // },
    getData(url = "/api/donation/getDonations") {
      // this.datatable_debounce()
      this.tableData.draw++;
      axios
        .get(url, { params: this.tableData })
        .then((response) => {
          let data = response.data;
          if (this.tableData.draw == data.draw) {
            this.donations = data.data.data;
            this.configPagination(data.data);
          }
        })
        .catch((errors) => {
          console.log(errors);
        });
    },
    sortBy(key) {
      this.sortKey = key;
      this.sortOrders[key] = this.sortOrders[key] * -1;
      this.tableData.column = this.getIndex(this.columns, "name", key);
      this.tableData.dir = this.sortOrders[key] === 1 ? "asc" : "desc";
      this.getData();
    },
  },
  created() {
    this.getData();
  },
};
</script>
<style scoped>
.dropdown .dropdown-menu .dropdown-item, .dropup .dropdown-menu .dropdown-item, .dropright .dropdown-menu .dropdown-item, .dropleft .dropdown-menu .dropdown-item{
    padding: 5px 10px;
}
.btn.btn-sm.btn-icon {
    padding: 10px;
    font-size: 15px;
}
</style>