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
          <div class="row match-height">
              
              <div class="col-xl-4 col-md-6 col-sm-12">
                  <div class="card" style="/* height: 420.828px; */">
                      <div class="card-content">
                          <div class="card-body">
                              
                              <h5 class="mt-1">Vuexy Admin</h5>
                              <p class="card-text">By Pixinvent Creative Studio</p>
                              <hr class="my-1">
                              <div class="d-flex justify-content-between mt-2">
                                  
                                  <div class="">
                                      <p class="font-medium-2 mb-0">12 June 2019</p>
                                      <p class="">Delivery Date</p>
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
import Datatable from "~/components/datatable/Datatable.vue";
import Pagination from "~/components/datatable/Pagination.vue";
export default {
  components: { datatable: Datatable, pagination: Pagination },
  middleware: "auth",

  metaInfo() {
    return { title: 'Claimed' };
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
      perPage: ["10", "20", "30",'All'],
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
    getData(url = "/api/getAllClaimedDonations") {
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