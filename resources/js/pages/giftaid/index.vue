<template>
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-left mb-0">Gift Aids</h2>
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
      <section id="description" class="card">
        <div class="card-content">
          <div class="card-body">
           <div class="row">
             <div class="col-md-12">
               <button v-if="donations.length>0" class="btn btn-success" @click="markAllAsSubmitted">Mark as Generated</button>
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
                class="table-striped"
                :columns="columns"
                :sortKey="sortKey"
                :sortOrders="sortOrders"
                @sort="sortBy"
                >
                <tbody>
                    <tr v-for="item in donations" :key="item.id">
                      <td>
                        <div class="badge badge-pill badge-glow badge-success mr-1 mb-1" v-for="product in item.items" :key="'product_id'+product.id">{{ product.name }}</div>
                      </td>
                      <td>{{ item.first_name + " " + item.last_name }}</td>
                      <td>{{ round2Fixed(item.order_total) }}</td>
                      <td>{{ item.payment_method }}</td>
                      <td v-if="item.submitted"><div class="badge badge-pill badge-glow badge-success mr-1 mb-1">Submitted</div></td>
                      <td v-else><div class="badge badge-pill badge-glow badge-primary mr-1 mb-1">Not Submitted</div></td>
                      
                      <td v-if="item.claimed"><div class="badge badge-pill badge-glow badge-success mr-1 mb-1">Claimed</div></td>
                      <td v-else><div class="badge badge-pill badge-glow badge-primary mr-1 mb-1">Not Claimed</div></td>
                    
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
export default {
  components: { datatable: Datatable, pagination: Pagination },
  middleware: "auth",

  metaInfo() {
    return { title: this.$t("home") };
  },
  data() {
    let sortOrders = {};
    let columns = [
      { label : 'Projects',name : 'name'},
      { label : 'Sponsor By',name : 'first_name'},
      { label : 'Total',name : 'order_total'},
      { label : 'Payment Method',name : 'payment_method'},
      { label : 'Submitted',name : 'submitted'},
      { label : 'Claimed',name : 'claimed'},
    ];
    columns.forEach((column) => {
      sortOrders[column.name] = -1;
    });
    return {
      donations: [],
      columns: columns,
      sortKey: "full_name",
      sortOrders: sortOrders,
      perPage: ["10", "20", "30","all"],
      tableData: {
        draw: 0,
        length: 10,
        search: "",
        column: 0,
        dir: "desc",
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
    markAllAsSubmitted(){
      this.$swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, mark as Generated!'
      }).then((result) => {
        if (result.isConfirmed) {
          axios
          .post('/api/markAllDonationsAsGiftAid')
          .then((response) => {
            this.getData()
            this.$swal.fire(
              'Submitted!',
              response.data.message,
              'success'
            )
          })
          .catch((errors) => {
            console.log(errors);
          });
          
        }
      })

      
    },
    getData(url = "/api/getAllDonationsWithGiftaid") {
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
</style>