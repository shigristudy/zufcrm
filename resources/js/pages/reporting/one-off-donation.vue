<template>
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-left mb-0">One-Off Donations</h2>
           
          </div>
        </div>
      </div>
      
    </div>
    <div class="content-body">
      <div class="row dataTables_wrapper mb-1">
        <div class="col-md-12">
            <success-alert :successful="is_added_successfully" :message="successMessage"></success-alert>
        </div>
      </div>
      <div id="accordionWrapa50" class="card" role="tablist" aria-multiselectable="true">
        <div class="accordion collapse-icon" id="accordionExample0" data-toggle-hover="true">
          <div class="collapse-border-item collapse-header card collapse-bordered">
              <div class="card-header collapsed" id="heading200" data-toggle="collapse" role="button" data-target="#collapse200" aria-expanded="false" aria-controls="collapse200">
                  <span class="lead collapse-title">
                      Advanced Filter
                  </span>
              </div>

              <div id="collapse200" class="collapse" aria-labelledby="heading200" data-parent="#accordionExample0" style="">
                  <div class="card-body">
                      <form @submit.prevent="handleSubmit" @keydown="tableData.form.onKeydown($event)">
                        <div class="row">
                          <div class="col-md-3">
                            <fieldset class="form-group">
                                <label for="basicInput">Project</label>
                                
                                <multiselect v-model="tableData.form.product_id" 
                                            deselect-label="Can't remove this value" 
                                            track-by="id" label="name" 
                                            placeholder="Select one" 
                                            :options="wooProducts" 
                                            :searchable="true"
                                            :multiple="true" 
                                            :close-on-select="false"
                                            :custom-label="customLabel"
                                            :allow-empty="false">
                                  <template slot="singleLabel" slot-scope="{ option }"><strong>{{ option.display_name }}</strong></template>
                                </multiselect>
                                <!-- <select class="form-control" v-model="tableData.form.product_id">
                                    <option value="">
                                        <strong>All</strong>
                                    </option>
                                    <option v-for="p in wooProducts" :key="'woo_project'+p.product_id" 
                                            :value="p.product_id">
                                        <strong>{{ project_name_computed(p) }}</strong>
                                    </option>
                                </select> -->
                            </fieldset>
                          </div>
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
                                <label for="basicInput">Donation Type</label>
                                <select class="form-control" v-model="tableData.form.donation_type">
                                    <option value="">
                                        <strong>All</strong>
                                    </option>
                                    <option v-for="d_type in donation_type_arr" :key="'d_type'+d_type" 
                                            :value="d_type.trim()">
                                        <strong>{{ d_type }}</strong>
                                    </option>
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
      <!-- Description -->
      <section id="description" class="card">
        <div class="card-content">
          <div class="card-body">
             <div class="row">
              <div class="col-md-6">
                  <button class="btn btn-primary" @click="exportCSV()">Export</button>
                  <button v-if="form2.selectedrows.length>0" class="btn btn-success" @click="includeInSponsorships()">Include in Sponsorships</button>
              </div>
            </div>
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
                :id="datatableID"
                class="table-striped"
                :columns="columns"
                :sortKey="sortKey"
                :sortOrders="sortOrders"
                @sort="sortBy"
                >
                <tbody>
                    <tr v-for="item in items" :key="item.id">
                      <!-- <td>{{ item.product.type }}</td> -->
                      <td>{{ item.product.name }}</td>
                      <td>{{ item.donation_type }}</td>
                      <td>{{ item.order.first_name + " " + item.order.last_name }}</td>
                      <td>{{ item.order.email }}</td>
                      <td>{{ item.order.phone }}</td>
                      <td>{{ item.order.city }}</td>
                      <td>{{ formatePostal(item.order.postcode) }}</td>
                      <td>{{ formattedDateDDMMYY(item.order.donation_date) }}</td>
                      <td>{{ round2Fixed(item.total) }}</td>
                      <td>
                        <div v-if="item.allocated_at == null" class="badge badge-pill  badge-danger mr-1 mb-1">Not Allocated</div>
                        <div v-else class="badge badge-pill  badge-success mr-1 mb-1">Allocated</div>
                      </td>
                       <td>
                        <div v-if="item.is_sponsor == 1" class="badge badge-pill  badge-success mr-1 mb-1">Included</div>
                        <div v-else class="badge badge-pill  badge-info mr-1 mb-1">Not Included</div>
                      </td>
                      <td class="text-center">
                        <div>
                          <fieldset>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" v-model="form2.selectedrows" :value="item.id" :id="'customCheck'+item.id">
                                <label class="custom-control-label" :for="'customCheck'+item.id"></label>
                            </div>
                        </fieldset>
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

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<script>
import Datatable from "~/components/datatable/Datatable.vue";
import Pagination from "~/components/datatable/Pagination.vue";
import Form from 'vform'
import SuccessAlert from '~/components/alert/SuccessAlert.vue'
export default {
  components: { datatable: Datatable, pagination: Pagination,'success-alert':SuccessAlert },
  middleware: "auth",

  metaInfo() {
    return { title: 'One-Off Donations' };
  },
  data() {
    let sortOrders = {};
    let columns = [
        // { label: "Type", name:'type' }, 
        { label: "Name", name:'name' }, 
        { label: "Donation Type", name:'donation_type' }, 
        { label: "Donor", name:'first_name' }, 
        { label: "Email", name:'email' }, 
        { label: "Phone", name:'phone' }, 
        { label: "City", name:'city' }, 
        { label: "Postcode", name:'postcode' }, 
        { label: "Donation Date", name:'donation_date' }, 
        { label: "Total", name:'total',sortable:true }, 
        { label: "Sponsorship?", name:'allocated' }, 
        { label: "Included?", name:'already_included' }, 
        { label: "Include in sponsorship?", name:'include' }, 
    ];
    columns.forEach((column) => {
      sortOrders[column.name] = -1;
    });
    return {
      datatableID:'one_off_donations_table',
      is_added_successfully:false,
      successMessage:'',
      donation_type_arr:[],
      wooProducts:[],
      items: [],
      columns: columns,
      sortKey: "name",
      sortOrders: sortOrders,
      perPage: ["10", "20", "30"],
      tableData: {
        draw: 0,
        length: 10,
        search: "",
        column: 0,
        dir: "desc",
        filtering:false,
        form:new Form({
          product_id:[],
          date_from:'',
          date_to:'',
          donation_type:'',
        }),
      },
      form2:new Form({
        selectedrows:[]
      }), 
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
    exportCSV(){
      this.download_table_as_csv(this.datatableID,',',[0,10],'.csv')
    },
    async includeInSponsorships(){
      const response = await this.form2.post('/api/includeProductInSponsorhips')
      this.is_added_successfully = true; 
      this.successMessage = response.data.message 
      this.form2.reset()
      this.getData()
    },
    customLabel( obj ){
      var name = '';
      
      if(obj.project_page != null && obj.project_page != ''){
          name = obj.project_page + ' - ' + obj.name
      }else{
          name = obj.name
      }
      return name;
    },
    clearFilters(){
      this.tableData.form.reset()
      this.tableData.filtering = false;
    },
    async handleSubmit () {
      this.tableData.filtering = true;
      this.getData()
    },
    async getProjects(){
      var instance = this
      var format_and_sorted_products = []
        axios.get('/api/getProjects',{ params:{type:'simple'} })
        .then((response) => {
            this.wooProducts = response.data;
            this.wooProducts.forEach(function(val,index){
                var display_name = instance.project_name_computed(val)
                format_and_sorted_products.push({
                    id: val.id,
                    name: val.name,
                    display_name:display_name,
                    price: val.price,
                    product_id: val.product_id,
                    project_page: val.project_page,
                    type: val.type,
                })
            })
            format_and_sorted_products.sort(function(a, b){
                if(a.display_name < b.display_name) { return -1; }
                if(a.display_name > b.display_name) { return 1; }
                return 0;
            })

            this.wooProducts = format_and_sorted_products
        }).catch((errors) => {
            console.log(errors);
        });
    },
    project_name_computed(p){
        
        var name = '';
        
        if(p.project_page != null && p.project_page != ''){
            name = p.project_page + ' - ' + p.name
        }else{
            name = p.name
        }
        return name;
    },
    getData(url = "/api/one_off_donations") {
      this.tableData.draw++;
      axios
        .get(url, { params: this.tableData })
        .then((response) => {
          let data = response.data;
          if (this.tableData.draw == data.draw) {
            this.items = data.data.data;
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
    
    this.getProjects()
    this.getData();
    if(this.$route.params.message){
      this.is_added_successfully = true
      this.successMessage = this.$route.params.message
    }
    this.donation_type_arr = window.config.options.find(x => x.key === 'donation_types').value.split(',').sort(function(a, b){
                if(a < b) { return -1; }
                if(a > b) { return 1; }
                return 0;
            })
  },
  
};
</script>
<style scoped>
.dropdown .dropdown-menu .dropdown-item, .dropup .dropdown-menu .dropdown-item, .dropright .dropdown-menu .dropdown-item, .dropleft .dropdown-menu .dropdown-item{
    padding: 5px 10px;
}
</style>