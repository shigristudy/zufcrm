<template>
 <div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Edit Donation</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><router-link :to="{ name:'donations' }">Donations</router-link>
                            </li>
                            <li class="breadcrumb-item"><a href="#">Edit</a>
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
                    <div class="row">
                        <div class="col-md-6">
                            <fieldset class="form-group">
                                <label for="basicInput">Payment Type</label>
                                <select class="form-control">
                                    <option>Bank</option>
                                    <option>Cash</option>
                                    <option>Cheque</option>
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            <fieldset class="form-group">
                                <label for="basicInput">Date of Donation</label>
                                <input type="date" class="form-control" id="basicInput" placeholder="Enter email">
                            </fieldset>
                        </div>
                    </div>

                     <div class="row">
                         <div class="col-md-6">
                             <fieldset class="form-group">
                                <label for="fullname">Full Name</label>
                                <input type="text" class="form-control" id="fullname" placeholder="Full Name">
                            </fieldset>
                         </div>
                         <div class="col-md-3">
                             <fieldset class="form-group">
                                    <label for="basicInput">Gift Aid claimed?</label>
                                    <ul class="list-unstyled mb-0">
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <div class="vs-radio-con">
                                                    <input type="radio" name="vueradio" checked="" value="false">
                                                    <span class="vs-radio">
                                                        <span class="vs-radio--border"></span>
                                                        <span class="vs-radio--circle"></span>
                                                    </span>
                                                    <span class="">Yes</span>
                                                </div>
                                            </fieldset>
                                        </li>
                                        <li class="d-inline-block mr-2">
                                            <fieldset>
                                                <div class="vs-radio-con">
                                                    <input type="radio" name="vueradio" value="false">
                                                    <span class="vs-radio">
                                                        <span class="vs-radio--border"></span>
                                                        <span class="vs-radio--circle"></span>
                                                    </span>
                                                    <span class="">No</span>
                                                </div>
                                            </fieldset>
                                        </li>
                                    </ul>
                                </fieldset>
                         </div>
                         <div class="col-md-3">
                             <fieldset class="form-group">
                                <label>Gift Aid</label>
                                <select class="form-control">
                                    <option value="no">No</option>
                                    <option value="verbal">Verbal</option>
                                    <option value="written">Written</option>
                                </select>
                            </fieldset>
                         </div>
                    </div>           
                    
                    <div class="row">
                        <div class="col-md-6">
                            <fieldset class="form-group">
                                <label for="city">City</label>
                                <input type="text" class="form-control" id="city" placeholder="City">
                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            <fieldset class="form-group">
                                <label for="postalcode">Post code</label>
                                <input type="text" class="form-control" id="postalcode" placeholder="Post code">
                            </fieldset>
                        </div>
                    </div>
                   <div class="row">
                       <div class="col-md-6">
                            <fieldset class="form-group">
                                <label for="contact">Contact</label>
                                <input type="text" class="form-control" id="contact" placeholder="Contact">
                            </fieldset>
                        </div>
                       <div class="col-md-6">
                            <fieldset class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" placeholder="Email">
                            </fieldset>
                       </div>
                   </div>

                   <fieldset class="form-group">
                        <label for="addressline1">Address Line 1</label>
                        <input type="text" class="form-control" id="addressline1" placeholder="Address Line 1">
                    </fieldset>
                    <fieldset class="form-group">
                        <label for="addressline2">Address Line 2</label>
                        <input type="text" class="form-control" id="addressline2" placeholder="Address Line 2">
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
                            <tr v-for="(donation,index) in donationsArray" :key="index">
                                <td>
                                    <fieldset class="form-group">
                                        <label>{{ index }}</label>
                                    </fieldset>
                                </td>
                                <td>
                                    <fieldset class="form-group">
                                        <select class="form-control">
                                            <option value="no">No</option>
                                            <option value="verbal">Verbal</option>
                                            <option value="written">Written</option>
                                        </select>
                                    </fieldset>
                                </td>
                                <td >
                                    <fieldset class="form-group">
                                        <select class="form-control">
                                            <option value="no">Sadaqahh</option>
                                            <option value="verbal">Zakat</option>
                                            <option value="written">Fitrana</option>
                                        </select>
                                    </fieldset>
                                </td>
                                <td>
                                    <fieldset class="form-group">
                                        <input type="number" class="form-control" placeholder="Amount">
                                    </fieldset>
                                </td>
                                <td class="text-center">
                                    <fieldset class="form-group">
                                        <i class="fa fa-plus" v-if="donationsArray.length == index+1" @click="addNewRow()"></i>
                                        <i class="fa fa-remove" v-if="index != 0 || donationsArray.length > 1" @click="removeRow(index)"></i>
                                    </fieldset>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-right" colspan="4"><strong>Total Amount: </strong>0.00</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </section>
        <!--/ Description -->
    </div>
  </div>
</template>

<script>
export default {
  middleware: "auth",

  metaInfo() {
    return { title: this.$t("home") };
  },
  data(){
      return {
          donationObject:{
              project:0,
              donation_type:'',
              amount:0
          },
          donationsArray:[{
              project:0,
              donation_type:'',
              amount:0
          }]
      }
  },
  methods:{
      addNewRow(){
          this.donationsArray.push(this.donationObject)
      },
      removeRow(index){
          console.log(index)
          this.donationsArray.splice(index,1);
      },
  }
};
</script>
