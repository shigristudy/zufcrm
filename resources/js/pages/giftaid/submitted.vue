<template>
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-left mb-0">Make A Claim</h2>
          </div>
        </div>
      </div>
      
    </div>
    <div class="content-body">
      <!-- Description -->
      <section id="description" class="card">
        <div class="card-content">
          <div class="card-body">
            <alert-success :form="order" :message="message" />
            <success-alert :successful="is_added_successfully" :message="successMessage"></success-alert>

            <div class="row">
              <div class="col-md-6">
                  <button class="btn btn-primary" @click="exportCSV()">Export</button>
                  <button v-if="form.selectedrows.length>0" class="btn btn-success" @click="markSelectedAsRenew()">Remove From This Claim</button>
              </div>
              <div class="col-md-6">
                <button class="btn btn-primary float-right" @click="openReportSubmitModal()">Complete Claim</button>
              </div>

            </div>
            <div class="row dataTables_wrapper mb-1">
              <div class="col-sm-12 col-md-6">
                <div class="dataTables_length">
                  <label>Show <select
                      class="custom-select custom-select-sm form-control form-control-sm"
                      v-model="tableData.length"
                      @change="getData()">
                      <option
                        v-for="(records, index) in perPage"
                        :key="'datatable_'+index"
                        :value="records">
                        {{ records }}
                      </option>
                    </select> entries
                  </label>
                </div>
              </div>
              <div class="col-sm-12 col-md-6">
                <div class="dataTables_filter">
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
                :id="datatableID"
                class="table-striped"
                :columns="columns"
                :sortKey="sortKey"
                :sortOrders="sortOrders"
                @sort="sortBy">
                <tbody>
                    <tr v-for="item in donations" :key="'donations'+item.id">
                      <td>
                        <fieldset>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" v-model="form.selectedrows" :value="item.id" :id="'customCheck'+item.id">
                                <label class="custom-control-label" :for="'customCheck'+item.id"></label>
                            </div>
                        </fieldset>
                      </td>
                      
                      <td>{{ item.title }}</td>
                      <td>{{ item.first_name  }}</td>
                      <td>{{ item.last_name }}</td>
                      <td>{{ item.address_1 }}</td>
                      <td>{{ formatePostal(item.postcode) }}</td>
                      <td></td>
                      <td></td>
                      <td>{{ formattedDateDDMMYY(item.donation_date) }}</td>
                      <td>{{ round2Fixed(item.order_total) }}</td>
                      
                      <td><i class="fa fa-pencil-square-o" @click="editOrder(item)"></i></td>
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
      <!-- Report Create Modal -->
      <div class="modal fade text-left show" id="modal_generate_report" tabindex="-1" role="dialog" aria-labelledby="modal_generate_report" aria-modal="true">
          <div class="modal-dialog modal-dialog-scrollable" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title">Generate Report</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <form @submit.prevent="markSelectedAsClaimed" @keydown="report.onKeydown($event)">           
                            <fieldset class="form-group">
                                <label for="report_title">Title</label>
                                <input v-model="report.title" 
                                        :class="{ 'is-invalid': report.errors.has('title') }" 
                                        type="text" 
                                        class="form-control" 
                                        id="report_tite" 
                                        name="title" 
                                        placeholder="Report title">
                                <has-error :form="report" field="title" />
                            </fieldset>
                            <fieldset class="form-group">
                                <label for="note">Note</label>
                                <textarea v-model="report.note" 
                                        :class="{ 'is-invalid': report.errors.has('note') }" 
                                        class="form-control" 
                                        id="note" 
                                        name="note" 
                                        placeholder="Note"></textarea>
                               
                                <has-error :form="report" field="note" />
                            </fieldset>

                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary mr-1 mb-1 waves-effect waves-light" data-dismiss="modal">Cancel</button>
                                <v-button :loading="report.busy" type="primary">Submit</v-button>
                            </div>
                    </form>
                  </div>
              </div>
          </div>
      </div>
      <!-- Edit Order Modal -->
      <div class="modal fade text-left show" id="modal_edit_order" tabindex="-1" role="dialog" aria-labelledby="modal_edit_order" aria-modal="true">
          <div class="modal-dialog modal-dialog-scrollable" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title">Edit Donar</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <form @submit.prevent="handleSubmit" @keydown="order.onKeydown($event)">
                        
                            <fieldset class="form-group">
                                <label for="basicInput">Title</label>
                                <select class="form-control" v-model="order.title">
                                    <option value="Mr">Mr</option>
                                    <option value="Ms">Ms</option>
                                </select>
                            </fieldset>

                            <div class="row">
                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input v-model="order.first_name" 
                                                :class="{ 'is-invalid': order.errors.has('first_name') }" 
                                                type="text" 
                                                class="form-control" 
                                                id="first_name" 
                                                name="first_name" 
                                                placeholder="First Name">
                                        <has-error :form="order" field="first_name" />
                                    </fieldset>
                                </div>
                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input v-model="order.last_name" 
                                                :class="{ 'is-invalid': order.errors.has('last_name') }" 
                                                type="text" 
                                                class="form-control" 
                                                id="last_name" 
                                                name="last_name" 
                                                placeholder="Last Name">
                                        <has-error :form="order" field="last_name" />
                                    </fieldset>
                                </div>
                                
                            </div>           
                            <fieldset class="form-group">
                                <label for="addressline1">Address Line 1</label>
                                <input v-model="order.address_1" 
                                        :class="{ 'is-invalid': order.errors.has('address_1') }" 
                                        type="text" 
                                        class="form-control" 
                                        id="address_1" 
                                        name="address_1" 
                                        placeholder="Address Line 1">
                                <has-error :form="order" field="address_1" />
                            </fieldset>
                            <fieldset class="form-group">
                                <label for="address_2">Address Line 2</label>
                                <input v-model="order.address_2" 
                                        :class="{ 'is-invalid': order.errors.has('address_2') }" 
                                        type="text" 
                                        class="form-control" 
                                        id="address_2" 
                                        name="address_2" 
                                        placeholder="Address Line 2">
                                <has-error :form="order" field="address_2" />
                            </fieldset>

                            <div class="row">
                              <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="postcode">Post code</label>
                                        <input v-model="order.postcode" 
                                                :class="{ 'is-invalid': order.errors.has('postcode') }" 
                                                type="text" 
                                                class="form-control" 
                                                id="postcode" 
                                                name="postcode" 
                                                placeholder="Postal Code">
                                        <has-error :form="order" field="postcode" />
                                    </fieldset>
                                </div>
                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="donation_date">Donation Date</label>
                                        <input v-model="order.donation_date" 
                                                :class="{ 'is-invalid': order.errors.has('donation_date') }" 
                                                type="text" 
                                                class="form-control" 
                                                id="donation_date" 
                                                name="donation_date" 
                                                placeholder="Donation date">
                                        <has-error :form="order" field="donation_date" />
                                    </fieldset>
                                </div>
                                
                            </div>
                            <fieldset class="form-group">
                                <label for="order_total">Amount</label>
                                <input v-model="order.order_total" 
                                        :class="{ 'is-invalid': order.errors.has('order_total') }" 
                                        type="text" 
                                        class="form-control" 
                                        id="order_total" 
                                        name="order_total" 
                                        placeholder="Amount">
                                <has-error :form="order" field="order_total" />
                            </fieldset>

                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary mr-1 mb-1 waves-effect waves-light" data-dismiss="modal">Cancel</button>
                                <v-button :loading="order.busy" type="primary">Submit</v-button>
                            </div>
                    </form>
                  </div>
              </div>
          </div>
      </div>
    </div>
  </div>
</template>

<script>
import Datatable from "~/components/datatable/Datatable.vue";
import Pagination from "~/components/datatable/Pagination.vue";
import Form from 'vform'
import SuccessAlert from '~/components/alert/SuccessAlert.vue'
export default {
  components: { datatable: Datatable, pagination: Pagination ,'success-alert':SuccessAlert},
  middleware: "auth",

  metaInfo() {
    return { title: 'Make A Claim' };
  },
  data() {
    let sortOrders = {};
    let columns = [
      { label : 'Action',name : 'id'},
      { label : 'Title',name : 'title'},
      { label : 'First Name',name : 'first_name'},
      { label : 'Last Name',name : 'last_name'},
      { label : 'House name or number',name : 'address_1'},
      { label : 'Postcode',name : 'postcode'},
      { label : 'Aggregated donations',name : 'aggregated_donation'},
      { label : 'Sponsored event',name : 'event'},
      { label : 'Donation Date',name : 'donation_date',sortable:true},
      { label : 'Amount',name : 'order_total',sortable:true},
      { label : 'Edit',name : 'edit'},
    ];
    columns.forEach((column) => {
      sortOrders[column.name] = -1;
    });
    return {
      is_added_successfully:false,
      successMessage:'',
      message:'',
      datatableID:'submitted_gift_aid_table',
      form: new Form({
        selectedrows:[]
      }),
      order: new Form({
        order_id:'',
        title:'',
        first_name:'',
        last_name:'',
        address_1:'',
        address_2:'',
        postcode:'',
        donation_date:'',
        order_total:'',
      }),
      report: new Form({
        title:'',
        note:''
      }),
      donations: [],
      columns: columns,
      sortKey: "donation_date",
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
    openReportSubmitModal(){
      $('#modal_generate_report').modal('show');
    },
    async handleSubmit() {
      const response = await this.order.post("/api/editOrderDetails");
      this.order.reset();
      $('#modal_edit_order').modal('hide');
      this.message = response.data.message
      this.getData()
    },
    editOrder(item){
    
      this.order.order_id        = item.id
      this.order.title           = item.title
      this.order.first_name      = item.first_name
      this.order.last_name       = item.last_name
      this.order.address_1       = item.address_1
      this.order.address_2       = item.address_2
      this.order.postcode        = item.postcode
      this.order.donation_date   = this.formattedDateDDMMYY(item.donation_date)
      this.order.order_total     = item.order_total
      $('#modal_edit_order').modal('show');
    },
    exportCSV(){
      this.download_table_as_csv(this.datatableID,',',[0,10])
    },
    markSelectedAsRenew(){
      this.form
        .post('/api/markAllSelectedasNew')
        .then((response) => {
          this.getData()
          this.is_added_successfully = true
          this.successMessage = response.data.message
        })
        .catch((errors) => {
          console.log(errors);
        });
    },
    markSelectedAsClaimed(){
      this.$swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Mark As Claimed/Closed!'
      }).then((result) => {
        if (result.isConfirmed) {
          this.report
          .post('/api/markAllSelectedasClaimed')
          .then((response) => {
            this.getData()
            this.$swal.fire(
              'Claimed!',
              response.data.message,
              'success'
            )
            $('#modal_generate_report').modal('hide');
          })
          .catch((errors) => {
            console.log(errors);
          });
          
        }
      })
    },
    getData(url = "/api/submittedGiftAidsList") {
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