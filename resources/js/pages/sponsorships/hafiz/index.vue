<template>
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-left mb-0">Hifz Students</h2>
          </div>
        </div>
      </div>
      <div
        class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none"
      >
        <div class="form-group breadcrum-right">
            <router-link :to="{ name:'sponsorships.hafiz.add' }"  class="btn btn-primary mr-1 mb-1 waves-effect waves-light">Add Hifz Student</router-link>
        </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row mb-1">
        <div class="col-md-12">
            <success-alert :successful="is_added_successfully" :message="successMessage"></success-alert>
        </div>
      </div>
      <!-- Description -->
      <section id="description" class="card">
        <div class="card-content">
          <div class="card-body">
            <div class="row dataTables_wrapper mb-1">
              <div class="col-sm-12 col-md-6">
                <div class="dataTables_length" id="DataTables_Table_0_length">
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
                <div id="DataTables_Table_0_filter" class="dataTables_filter">
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
                    <tr v-for="item in students" :key="item.id">
                      <td>{{ item.full_name }}</td>
                      <td>{{ item.father_name }}</td>
                      <td>{{ item.gender }}</td>
                      <td>{{ item.teacher_name }}</td>
                      <td>{{ item.class_name }}</td>
                      <td>{{ item.student_id }}</td>
                      <td v-if="item.sponsored == 0"><div class="badge badge-pill  badge-primary mr-1 mb-1">Not Sponsored</div></td>
                      <td v-else><div class="badge badge-pill  badge-success mr-1 mb-1">Sponsored</div></td>
                    
                      <td class="text-center">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle waves-effect waves-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Action
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(263px, 36px, 0px); top: 0px; left: 0px; will-change: transform;">
                              <router-link class="dropdown-item" :to="{ name:'sponsorships.hafiz.view',params:{id:item.id} }">View</router-link>
                              <router-link class="dropdown-item" :to="{ name:'sponsorships.sponsorships.sponsor',params:{id:item.id} }">Sponsor One-Off</router-link>
                              <router-link class="dropdown-item" :to="{ name:'sponsorships.sponsorships.sponsor_montly',params:{id:item.id} }">Sponsor Montly</router-link>
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
import SuccessAlert from '~/components/alert/SuccessAlert.vue'

export default {
  components: { datatable: Datatable, pagination: Pagination , 'success-alert':SuccessAlert},
  middleware: "auth",

  metaInfo() {
    return { title: 'Hifz Students' };
  },
  data() {
    let sortOrders = {};
    let columns = [
      { label: "Full Name",name : 'full_name'},
      { label: "Father Name",name : 'father_name'},
      { label: "Gender",name : 'gender'},
      { label: "Teacher Name",name : 'teacher_name'},
      { label: "Class Name",name : 'class_name'},
      { label: "Student ID",name : 'student_id'},
      { label: "Sponsored",name : 'sponsored'},
      { label: "Action", name: "action",clasess:'text-center' },
    ];
    columns.forEach((column) => {
      sortOrders[column.name] = -1;
    });
    return {
      is_added_successfully:false,
      successMessage:'',
      students: [],
      columns: columns,
      sortKey: "full_name",
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
    getData(url = "/api/student/getHafizStudents") {
      this.tableData.draw++;
      axios
        .get(url, { params: this.tableData })
        .then((response) => {
          let data = response.data;
          if (this.tableData.draw == data.draw) {
            this.students = data.data.data;
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
    if(this.$route.params.message){
      this.is_added_successfully = true
      this.successMessage = this.$route.params.message
    }
  },
};
</script>
<style scoped>
.dropdown .dropdown-menu .dropdown-item, .dropup .dropdown-menu .dropdown-item, .dropright .dropdown-menu .dropdown-item, .dropleft .dropdown-menu .dropdown-item{
    padding: 5px 10px;
}
</style>