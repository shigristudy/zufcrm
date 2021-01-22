<template>
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-left mb-0">One Off Donations</h2>
           
          </div>
        </div>
      </div>
      
    </div>
    <div class="content-body">
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
                                <label for="basicInput">Project</label>
                                <select class="form-control" v-model="tableData.form.product_id">
                                    <option value="">
                                        <strong>Select Project</strong>
                                    </option>
                                    <option v-for="p in wooProducts" :key="'woo_project'+p.product_id" 
                                            :value="p.product_id">
                                        <strong>{{ p.name }}</strong>
                                    </option>
                                </select>
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
                                <input type="text" class="form-control" v-model="tableData.form.donation_type">
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
                    <tr v-for="item in items" :key="item.id">
                      <!-- <td>{{ item.product.type }}</td> -->
                      <td>{{ item.product.name }}</td>
                      <td>{{ item.donation_type }}</td>
                      <td>{{ item.order.first_name + " " + item.order.last_name }}</td>
                      <td>{{ item.order.email }}</td>
                      <td>{{ item.order.phone }}</td>
                      <td>{{ item.order.city }}</td>
                      <td>{{ item.order.postcode }}</td>
                      <td>{{ formattedDateDDMMYY(item.order.donation_date) }}</td>
                      <td>{{ round2Fixed(item.total) }}</td>
                      <td>
                        <div v-if="item.allocated_at == null" class="badge badge-pill badge-glow badge-danger mr-1 mb-1">No Allocated</div>
                        <div v-else class="badge badge-pill badge-glow badge-success mr-1 mb-1">Allocated</div>
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
    return { title: 'Permissions' };
  },
  data() {
    let sortOrders = {};
    let columns = [
        // { label: "Type", name:'type' }, 
        { label: "Name", name:'name' }, 
        { label: "Donation_type", name:'donation_type' }, 
        { label: "Donar", name:'first_name' }, 
        { label: "Email", name:'email' }, 
        { label: "Phone", name:'phone' }, 
        { label: "City", name:'city' }, 
        { label: "Postcode", name:'postcode' }, 
        { label: "Donation Date", name:'donation_date' }, 
        { label: "Total", name:'total' }, 
        { label: "Allocated", name:'allocated' }, 
    ];
    columns.forEach((column) => {
      sortOrders[column.name] = -1;
    });
    return {
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
          product_id:'',
          date_from:'',
          date_to:'',
          donation_type:'',
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
      this.tableData.form.reset()
      this.tableData.filtering = false;
    },
    async handleSubmit () {
      this.tableData.filtering = true;
      this.getData()
    },
    async getProjects(){
        axios.get('/api/getProjects')
        .then((response) => {
            this.wooProducts = response.data
        }).catch((errors) => {
            console.log(errors);
        });
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
  },
};
</script>
<style scoped>
.dropdown .dropdown-menu .dropdown-item, .dropup .dropdown-menu .dropdown-item, .dropright .dropdown-menu .dropdown-item, .dropleft .dropdown-menu .dropdown-item{
    padding: 5px 10px;
}
</style>