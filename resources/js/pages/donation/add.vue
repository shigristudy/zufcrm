<template>
 <div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Add Donation</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><router-link :to="{ name:'donations' }">Donations</router-link>
                            </li>
                            <li class="breadcrumb-item"><a href="#">Add</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- Description -->
        <section id="description" class="card">
            <div class="card-content">
                <div class="card-body">
                    <form @submit.prevent="handleSubmit" @keydown="form.onKeydown($event)">
                        <alert-success :form="form" :message="message" />
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Donor Details</h3>
                                <fieldset class="form-group">
                                    <label>Title</label>
                                    <select class="form-control" v-model="form.title">
                                        <option value="Miss">Miss</option>
                                        <option value="Mr">Mr</option>
                                        <option value="Mrs">Mrs</option>
                                        <option value="Ms">Ms</option>
                                        <option value="Dr">Dr</option>
                                    </select>
                                </fieldset>
                                <div class="row">
                                    <div class="col-md-6">
                                        <fieldset class="form-group">
                                            <label for="first_name">First Name</label>
                                            <input v-model="form.first_name" 
                                                    :class="{ 'is-invalid': form.errors.has('first_name') }" 
                                                    type="text" 
                                                    class="form-control" 
                                                    id="first_name" 
                                                    name="first_name" 
                                                    placeholder="First Name">
                                            <has-error :form="form" field="first_name" />
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6">
                                        <fieldset class="form-group">
                                            <label for="last_name">Last Name</label>
                                            <input v-model="form.last_name" 
                                                    :class="{ 'is-invalid': form.errors.has('last_name') }" 
                                                    type="text" 
                                                    class="form-control" 
                                                    id="last_name" 
                                                    name="last_name" 
                                                    placeholder="Last Name">
                                            <has-error :form="form" field="last_name" />
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <fieldset class="form-group">
                                            <label for="addressline1">Address Line 1</label>
                                            <input v-model="form.address_line1" 
                                                    :class="{ 'is-invalid': form.errors.has('address_line1') }" 
                                                    type="text" 
                                                    class="form-control" 
                                                    id="address_line1" 
                                                    name="address_line1" 
                                                    placeholder="Address Line 1">
                                            <has-error :form="form" field="address_line1" />
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6">
                                        <fieldset class="form-group">
                                            <label for="addressline2">Address Line 2</label>
                                            <input v-model="form.address_line2" 
                                                    :class="{ 'is-invalid': form.errors.has('address_line2') }" 
                                                    type="text" 
                                                    class="form-control" 
                                                    id="address_line2" 
                                                    name="address_line2" 
                                                    placeholder="Address Line 2">
                                            <has-error :form="form" field="address_line2" />
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <fieldset class="form-group">
                                            <label for="city">City</label>
                                            <input v-model="form.city" 
                                                    :class="{ 'is-invalid': form.errors.has('city') }" 
                                                    type="text" 
                                                    class="form-control" 
                                                    id="city" 
                                                    name="city" 
                                                    placeholder="City">
                                            <has-error :form="form" field="city" />
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6">
                                        <fieldset class="form-group">
                                            <label for="postal_code">Postcode</label>
                                            <input v-model="form.postal_code" 
                                                    :class="{ 'is-invalid': form.errors.has('postal_code') }" 
                                                    type="text" 
                                                    class="form-control" 
                                                    id="postal_code" 
                                                    name="postal_code" 
                                                    placeholder="Postcode">
                                            <has-error :form="form" field="postal_code" />
                                        </fieldset>
                                    </div>
                                </div>
                                <fieldset class="form-group">
                                    <label for="country">Country</label>
                                    <select class="form-control" v-model="form.country">
                                        <option value="">Please Select a Country</option>
                                        <option value="GB">GB</option>
                                        <option value="US">US</option>
                                        <option value="Others">Others</option>
                                    </select>
                                    <!-- <input v-model="form.country" 
                                            :class="{ 'is-invalid': form.errors.has('country') }" 
                                            type="text" 
                                            class="form-control" 
                                            id="country" 
                                            name="country" 
                                            placeholder="Country (e.g GB, PK)"> -->
                                    <has-error :form="form" field="country" />
                                </fieldset>
                            </div>
                            <div class="col-md-6">
                                <h3>Contact Details</h3>
                                <fieldset class="form-group">
                                    <label for="email">Email</label>
                                    <input v-model="form.email" 
                                            :class="{ 'is-invalid': form.errors.has('email') }" 
                                            type="text" 
                                            class="form-control" 
                                            id="email" 
                                            name="email" 
                                            placeholder="Email">
                                    <has-error :form="form" field="email" />
                                </fieldset>
                                <fieldset class="form-group">
                                    <label for="contact">Telephone</label>
                                    <input v-model="form.contact" 
                                            :class="{ 'is-invalid': form.errors.has('contact') }" 
                                            type="text" 
                                            class="form-control" 
                                            id="contact" 
                                            name="contact" 
                                            placeholder="Telephone">
                                    <has-error :form="form" field="contact" />
                                </fieldset>
                                <h3>Donation Details</h3>
                                <fieldset class="form-group">
                                    <label for="date_of_donation">Date of Donation</label>
                                    <input v-model="form.date_of_donation" 
                                            :class="{ 'is-invalid': form.errors.has('date_of_donation') }" 
                                            type="date" 
                                            class="form-control" 
                                            id="date_of_donation" 
                                            name="date_of_donation" 
                                            placeholder="Date Of Donation">
                                    <has-error :form="form" field="date_of_donation" />
                                </fieldset> 
                                <fieldset class="form-group">
                                    <label for="basicInput">Payment Type</label>
                                    <select class="form-control" v-model="form.payment_type">
                                        <option value="">Please Select a Payment Type</option>
                                        <option value="Bank">Bank Transfer</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Cheque">Cheque</option>
                                    </select>
                                </fieldset>
                            
                            
                                <fieldset class="form-group">
                                    <label>Gift Aid</label>
                                    <select class="form-control" v-model="form.gift_aid">
                                        <option value="">Please Select Gift Aid</option>
                                        <option value="no">No</option>
                                        <!-- <option value="verbal">Verbal</option> -->
                                        <option value="written">Written</option>
                                        <!-- <option value="online">Online</option> -->
                                    </select>
                                </fieldset>
                                    
                            </div>
                        </div>  

                            
                            <table class="table table-bordered">
                                <thead style="background: #ebe8e8;">
                                    <tr>
                                        <th>S#</th>
                                        <th>Project</th>
                                        <th>Donation Type</th>
                                        <th>Amount</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(donation,index) in form.donationsArray" :key="index">
                                        <td>
                                            <fieldset class="form-group">
                                                <label>{{ index+1 }}</label>
                                            </fieldset>
                                        </td>
                                        <td>
                                            <fieldset class="form-group">
                                                <select :class="{ 'is-invalid': form.errors.has(`donationsArray.${index}.project`) }" class="form-control" v-model="form.donationsArray[index].project">
                                                    <option value="">
                                                        <strong>Select Project</strong>
                                                    </option>
                                                    <option v-for="p in format_and_sorted_products" :key="'woo_project'+p.product_id" 
                                                            :value="p.product_id">
                                                        <strong>{{ p.display_name }}</strong>
                                                    </option>
                                                </select>
                                                <has-error :form="form" :field="`donationsArray.${index}.project`"/>
                                            </fieldset>
                                        </td>
                                        <td >
                                            <fieldset class="form-group">
                                                <select
                                                    :class="{ 'is-invalid': form.errors.has(`donationsArray.${index}.donation_type`) }" 
                                                    class="form-control" v-model="form.donationsArray[index].donation_type">
                                                    <option value="">
                                                        <strong>Select Type</strong>
                                                    </option>
                                                    <option v-for="(d_type,d_index) in donation_type_arr" :key="'d_type'+d_index" :value="d_type.trim()">{{ capitalize(d_type) }}</option>
                                                </select>
                                                <has-error :form="form" :field="`donationsArray.${index}.donation_type`"/>
                                            </fieldset>
                                        </td>
                                        <td>
                                            <div class="form-label-group position-relative has-icon-left">
                                                <input @change="calculateTotal()" :class="{ 'is-invalid': form.errors.has(`donationsArray.${index}.amount`) }" type="number" class="form-control" placeholder="Amount" v-model="form.donationsArray[index].amount">
                                                <div class="form-control-position">
                                                    <i class="fa fa-gbp"></i>
                                                </div>
                                                 <has-error :form="form" :field="`donationsArray.${index}.amount`"/>
                                            </div>
                                           
                                        </td>
                                        <td class="text-center">
                                            <fieldset class="form-group">
                                                <i class="fa fa-plus" v-if="form.donationsArray.length == index+1" @click="addNewRow()"></i>
                                                <i class="fa fa-remove" v-if="index != 0 || form.donationsArray.length > 1" @click="deleteRow(index)"></i>
                                            </fieldset>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" colspan="4"><strong>Total Amount: <i class="fa fa-gbp"></i>{{ form.total_amount }}</strong></td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-between">
                                <button type="button" @click="clearForm" class="btn btn-secondary mr-1 mb-1 waves-effect waves-light">Clear</button>
                                <v-button :loading="form.busy" type="primary">Submit</v-button>
                            </div>
                    </form>
                </div>
            </div>
        </section>
        <!--/ Description -->
    </div>
  </div>
</template>

<script>
import Form from 'vform'
export default {
  middleware: "auth",

  metaInfo() {
    return { title: 'Add Donation' };
  },
  data(){
      return {
          message:'',
          wooProducts:[],
          form: new Form({
            payment_type : '',
            total_amount : 0.00,
            date_of_donation : '',
            last_name : '',
            first_name : '',
            title : 'Mr',
            gift_aid : '',
            city : '',
            country : '',
            postal_code : '',
            contact : '',
            email : '',
            address_line1 : '',
            address_line2 : '',
            donationsArray:[{
                project:"",
                donation_type:'',
                amount:0.00
            }],
        }),
        donation_type_arr:[],
        format_and_sorted_products:[]
      }
  },
  created(){
    this.donation_type_arr = window.config.options.find(x => x.key === 'donation_types').value.split(',').sort(function(a, b){
                if(a < b) { return -1; }
                if(a > b) { return 1; }
                return 0;
            })
    this.getProjects() 
  },
  methods:{
    project_name_computed(p){
        var name = '';
        var type = '';
        if(p.type == 'simple'){
            type = '[One-Off]';
        }else{
            type = '[Monthly]';
        }
        if(p.project_page != null && p.project_page != ''){
            name = p.project_page + ' - ' + p.name + ' - ' + type
        }else{
            name = p.name + ' - ' + type
        }
        return name;
    },
    calculateTotal(){
        var instance = this
        var total = 0;
        this.form.donationsArray.forEach(function(value,index){
            instance.form.donationsArray[index].amount = parseFloat(value.amount).toFixed(2)
            console.log(instance.form.donationsArray[index].value ,parseFloat(value.amount).toFixed(2) )
            total += parseFloat(parseFloat(value.amount).toFixed(2));
        })
        this.form.total_amount = parseFloat(total).toFixed(2)
    },
    async getProjects(){
        var instance = this
        axios.get('/api/getProjects')
        .then((response) => {
            this.wooProducts = response.data;
            this.wooProducts.forEach(function(val,index){
                var display_name = instance.project_name_computed(val)
                instance.format_and_sorted_products.push({
                    id: val.id,
                    name: val.name,
                    display_name:display_name,
                    price: val.price,
                    product_id: val.product_id,
                    project_page: val.project_page,
                    type: val.type,
                })
            })
            instance.format_and_sorted_products.sort(function(a, b){
                if(a.display_name < b.display_name) { return -1; }
                if(a.display_name > b.display_name) { return 1; }
                return 0;
            })

        }).catch((errors) => {
            console.log(errors);
        });
    },
    addNewRow(){
        this.form.donationsArray.push({
            project:"",
            donation_type:'',
            amount:0.00
        })
        this.calculateTotal()
    },
    deleteRow(index){
        this.form.donationsArray.splice(index, 1);
        this.calculateTotal()
    },
    async handleSubmit () {
      const response = await this.form.post('/api/donation/store')
      
      this.message = response.data.message
      this.form.reset()

      this.$router.push({
        name: 'one_off_donations.customers', 
        params: { message: this.message }
      });
    },
    clearForm(){
        this.form.reset()
    }
  },
};
</script>
<style scoped>
h3, .h3 {
    color: #636363;
}
</style>