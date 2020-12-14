<template>
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-left mb-0">Roles</h2>
          </div>
        </div>
      </div>
      <div
        class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none"
      >
        <div class="form-group breadcrum-right">
            <router-link :to="{ name:'settings.role.add' }"  class="btn btn-primary mr-1 mb-1 waves-effect waves-light">Add Role</router-link>
        </div>
      </div>
    </div>
    <div class="content-body">
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
                    <tr v-for="item in donations" :key="item.id">
                      <td>{{ item.name }}</td>
                      <td>{{ item.display_name }}</td>
                      <td>{{ item.description }}</td>
                      <td class="text-center">
                           <div class="dropdown">
                                <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle waves-effect waves-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(263px, 36px, 0px); top: 0px; left: 0px; will-change: transform;">
                                    <router-link class="dropdown-item" :to="{ name:'settings.permission.assign',params:{ record_id:item.id } }">Assign Permissions</router-link>
                                    <router-link class="dropdown-item" :to="{ name:'settings.role.edit',params:{ id:item.id } }">Edit</router-link>
                                    <a class="dropdown-item" @click="deleteRole(item.id)">Delete</a>
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

export default {
  components: { datatable: Datatable, pagination: Pagination },
  middleware: "auth",

  metaInfo() {
    return { title: 'Roles' };
  },
  data() {
    let sortOrders = {};
    let columns = [
      { label : 'Name',name : 'name'},
      { label : 'Display Name',name : 'Display Name'},
      { label : 'Description',name : 'description'},
      { label : 'Action',name : 'action'},
    ];
    columns.forEach((column) => {
      sortOrders[column.name] = -1;
    });
    return {
      donations: [],
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
    deleteRole(id){
      axios
        .post('/api/settings/role/destroy', { id:id })
        .then((response) => {
          this.getData()
        })
        .catch((errors) => {
          console.log(errors);
        });
    },
    getData(url = "/api/settings/roles") {
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