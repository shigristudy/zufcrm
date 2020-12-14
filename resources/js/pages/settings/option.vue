<template>
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-left mb-0">Option</h2>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrum-right">
            <button type="button" data-toggle="modal" data-target="#createOptionModal" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">Add Option</button>
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
                      <td>{{ item.key }}</td>
                      <td>{{ item.value }}</td>
                      <td class="text-center">
                           <div class="dropdown">
                                <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle waves-effect waves-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(263px, 36px, 0px); top: 0px; left: 0px; will-change: transform;">
                                    <a class="dropdown-item" @click="edit(item.id)">Edit</a>
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
    <div class="modal fade" id="createOptionModal" tabindex="-1" role="dialog" aria-labelledby="createOptionModalTitle" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
              <form @submit.prevent="handleSubmit" @keydown="form.onKeydown($event)">
                  <div class="modal-header">
                      <h5 class="modal-title" id="createOptionModalTitle">Option</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                      </button>
                  </div>
                  <div class="modal-body"> 
                    <alert-success :form="form" :message="message" />
                    <fieldset class="form-group">
                        <label for="key">Key</label>
                        <input v-model="form.key" 
                                :class="{ 'is-invalid': form.errors.has('key') }" 
                                type="text" 
                                class="form-control" 
                                id="key" 
                                name="key" 
                                placeholder="key in lower case and no space allowed">
                        <has-error :form="form" field="key" />
                    </fieldset>     
                    
                    <fieldset class="form-group">
                          <label for="Value">Value</label>
                          <textarea name="value" v-model="form.value" 
                                  :class="{ 'is-invalid': form.errors.has('value') }" 
                                  class="form-control"></textarea>
                          <has-error :form="form" field="value" />
                      </fieldset>

                  </div>
                  <div class="modal-footer d-flex justify-content-between">
                    <button type="submit" class="btn btn-secondary mr-1 mb-1 waves-effect waves-light">Back</button>
                    <v-button :loading="form.busy" type="primary">Submit</v-button>
                  </div>
                </form>
            </div>
        </div>
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
      { label : 'Key',name : 'key'},
      { label : 'Value',name : 'value'},
      { label : 'Action',name : 'action'},
    ];
    columns.forEach((column) => {
      sortOrders[column.name] = -1;
    });
    return {
      message:'',
      form: new Form({
          key:'',
          value:''
      }),
      donations: [],
      columns: columns,
      sortKey: "key",
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
    async handleSubmit () {
      const response = await this.form.post('/api/settings/option/store')
      this.message = response.data.message
      this.getData()
      this.form.reset()
    },
    edit(id){
      axios
        .post('/api/settings/option/edit', { id:id })
        .then((response) => {
          this.getData()
        })
        .catch((errors) => {
          console.log(errors);
        });
    },
    getData(url = "/api/settings/options") {
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