<template>
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-left mb-0">Customer</h2>
           
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <section id="description" class="card">
        <div class="card-content">
          <div class="card-body">
            <div class="row dataTables_wrapper mb-1">
              <div class="col-sm-12 col-md-6">
                <div class="dataTables_length" id="DataTables_Table_0_length">
                  <label>Show <select
                      class="custom-select custom-select-sm form-control form-control-sm"
                      v-model="tableData.length"
                      @change="getData()"
                    >
                      <option
                        v-for="(records, index) in perPage"
                        :key="index"
                        :value="records">
                        {{ records }}
                      </option>
                    </select> entries
                  </label>
                </div>
              </div>
              <div class="col-sm-12 col-md-6">
                <div id="DataTables_Table_0_filter" class="dataTables_filter">
                  <label>Search:<input
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
                      <td>{{ item.order_id }}</td>
                      <td>
                        <div v-if="item.action == 'failed'" class="badge badge-pill badge-glow badge-danger mr-1 mb-1">Failed</div>
                        <div v-else class="badge badge-pill badge-glow badge-success mr-1 mb-1">Paid Out</div>
                      </td>
                      <td>{{ JSON.parse(item.payload).details.description }}</td>
                      
                    </tr>
                </tbody>
                </datatable>
            </div>
            <pagination
              :pagination="pagination"
              @paginate="getData(page)"
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
    return { title: 'Customers' };
  },
  data() {
    let sortOrders = {};
    let columns = [
      { label: "Order ID", name: "order_id" },
      { label: "Action", name: "action" },
      { label: "Description", name: "description" },
    ];
    columns.forEach((column) => {
      sortOrders[column.name] = -1;
    });
    return {
      items: [],
      columns: columns,
      sortKey: "order_id",
      sortOrders: sortOrders,
      perPage: ["10", "20", "30"],
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
      },
    };
  },
  methods: {
    getData(url = "/api/gocardlessCustomer") {
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
    // this.tableData.webhook_type = this.getSearchParameters().type
    this.getData();
  },
};
</script>
