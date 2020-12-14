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
                                    <fieldset class="form-group">
                                        <label for="basicInput">Payment Type</label>
                                        <select class="form-control" v-model="form.payment_type">
                                            <option value="Bank">Bank</option>
                                            <option value="Cash">Cash</option>
                                            <option value="Cheque">Cheque</option>
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-md-6">
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
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 ">
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
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <fieldset class="form-group">
                                                <label>Title</label>
                                                <select class="form-control" v-model="form.title">
                                                    <option value="Mr">Mr</option>
                                                    <option value="Ms">Ms</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6">
                                            <fieldset class="form-group">
                                                <label>Gift Aid</label>
                                                <select class="form-control" v-model="form.gift_aid">
                                                    <option value="no">No</option>
                                                    <option value="verbal">Verbal</option>
                                                    <option value="written">Written</option>
                                                    <option value="online">Online</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>           
                            
                            <div class="row">
                                <div class="col-md-6">
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
                                                <label for="country">Country</label>
                                                <input v-model="form.country" 
                                                        :class="{ 'is-invalid': form.errors.has('country') }" 
                                                        type="text" 
                                                        class="form-control" 
                                                        id="country" 
                                                        name="country" 
                                                        placeholder="Country( e.g GB,PK)">
                                                <has-error :form="form" field="country" />
                                            </fieldset>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="postal_code">Post code</label>
                                        <input v-model="form.postal_code" 
                                                :class="{ 'is-invalid': form.errors.has('postal_code') }" 
                                                type="text" 
                                                class="form-control" 
                                                id="postal_code" 
                                                name="postal_code" 
                                                placeholder="Postal Code">
                                        <has-error :form="form" field="postal_code" />
                                    </fieldset>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                        <fieldset class="form-group">
                                            <label for="contact">Contact</label>
                                            <input v-model="form.contact" 
                                                    :class="{ 'is-invalid': form.errors.has('contact') }" 
                                                    type="text" 
                                                    class="form-control" 
                                                    id="contact" 
                                                    name="contact" 
                                                    placeholder="Contact">
                                            <has-error :form="form" field="contact" />
                                        </fieldset>
                                    </div>
                                <div class="col-md-6">
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
                                </div>
                            </div>

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
                            <fieldset class="form-group">
                                <label for="addressline2">Address Line 2</label>
                                <input v-model="form.address_line2" 
                                        :class="{ 'is-invalid': form.errors.has('address_line2') }" 
                                        type="text" 
                                        class="form-control" 
                                        id="address_line2" 
                                        name="address_line2" 
                                        placeholder="Address Line 3">
                                <has-error :form="form" field="address_line2" />
                            </fieldset>


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
                                                    <option v-for="p in wooProducts" :key="'woo_project'+p.product_id" 
                                                            :value="p.product_id">
                                                        <strong>{{ p.name }}</strong>
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
                                                    <option value="Sadaqahh">Sadaqahh</option>
                                                    <option value="Zakat">Zakat</option>
                                                    <option value="Fitrana">Fitrana</option>
                                                </select>
                                                <has-error :form="form" :field="`donationsArray.${index}.donation_type`"/>
                                            </fieldset>
                                        </td>
                                        <td>
                                            <fieldset class="form-group">
                                                <input @change="calculateTotal()" :class="{ 'is-invalid': form.errors.has(`donationsArray.${index}.amount`) }" type="number" class="form-control" placeholder="Amount" v-model="form.donationsArray[index].amount">
                                                <has-error :form="form" :field="`donationsArray.${index}.amount`"/>
                                            </fieldset>
                                        </td>
                                        <td class="text-center">
                                            <fieldset class="form-group">
                                                <i class="fa fa-plus" v-if="form.donationsArray.length == index+1" @click="addNewRow()"></i>
                                                <i class="fa fa-remove" v-if="index != 0 || form.donationsArray.length > 1" @click="deleteRow(index)"></i>
                                            </fieldset>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" colspan="4"><strong>Total Amount: </strong>{{ form.total_amount }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-secondary mr-1 mb-1 waves-effect waves-light">Back</button>
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
                amount:0
            }],
        })
      }
  },
  created(){
    this.getProjects() 
  },
  methods:{
    calculateTotal(){
        var instance = this
        var total = 0;
        this.form.donationsArray.forEach(function(value,index){
            total += parseFloat(value.amount);
        })
        this.form.total_amount = total
    },
    async getProjects(){
        axios.get('/api/getProjects')
        .then((response) => {
            this.wooProducts = response.data
        }).catch((errors) => {
            console.log(errors);
        });
        // Fetch Woocommerce Project
        // await this.$store.dispatch('projects/fetchProjects')

        // let instance = this
        // axios.get('https://www.ziaulummahfoundation.org.uk/wp-json/wc/v3/products?per_page=100',{
        //     auth: {
        //         username :'ck_4202435a3ffa2878c84d3064e2e5463f7a234589', 
        //         password :'cs_91b6f3fd2894b1a818f8c38e912ca56756b88ba6'
        //     }
        // }).then(function (response) {
        //     response.data.map(p => {
        //         let project = {
        //             id : p.id,
        //             name : p.name,
        //             type : p.type,
        //             price : p.price,
        //         };
        //         if(p.type != 'grouped'){
        //             instance.wooProducts.push(project)
        //         }
        //     })
            
        // })
    },
    addNewRow(){
        this.form.donationsArray.push({
            project:"",
            donation_type:'',
            amount:0
        })
    },
    deleteRow(index){
        this.form.donationsArray.splice(index, 1);
    },
    async handleSubmit () {
      const response = await this.form.post('/api/donation/store')
      console.log(response)
      this.message = response.data.message
      this.form.reset()
    }
  },
};
</script>
