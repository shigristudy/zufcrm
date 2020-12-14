<template>
    <div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Assign Permissions</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><router-link :to="{ name:'settings.permissions' }">Permissions</router-link>
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
                    <form class="form" @submit.prevent="handleSubmit" id="permission_form">
                            <input type="hidden" v-model="role_id" name="role_id">
                            <div class="card-body">
                                <div class="card card-custom gutter-b mb-0" v-for="(permission,index) in allPermissions" :key="index" >
                                    <div class="card-header pt-0">
                                        <div class="form-group row" style="width:100% !important;">
                                            <label class="col-8 col-form-label">{{ permission.display_name }}</label>
                                            <div class="col-4">
                                                <span class="switch switch-icon">
                                                    <label>
                                                        <input type="checkbox" :checked="alreadyGiven(permission.id)" :name="'permissions[main][' + index + ']'" :value="permission.id"/>
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary"><router-link :to="{ name: 'roles' }">Back</router-link></button>
                                <button type="submit" class="btn btn-primary mr-2 float-right">Submit</button>
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
export default {
    data (){
        return{
            submitted: false,
            allPermissions:[],
            role_id:0,
            extraParams : null,
            rolesPermissions:[],
            role:null
        }
    },
    created(){
        this.role_id = this.$route.params.record_id;
        // this.extraParams = this.$route.params.extraParams;
        this.getAllPermissionsWithGroup()
    },
    methods:{
        getAllPermissionsWithGroup(){
            axios.post(this.AdminBaseUrl+'settings/permission/getAllPermissionsWithGroup', {role_id:this.role_id})
            .then((res) => {
                this.role = res.data.role_data
                this.allPermissions = res.data.data
                this.rolesPermissions = res.data.rolesPermissions
            })
            // const res = await this.callApi('get',this.AdminBaseUrl + 'settings/permission/getAllPermissionsWithGroup',{role_id:this.role_id});
            // if(res.status == 200){
            //     this.role = res.data.role_data
            //     this.allPermissions = res.data.data
            //     this.rolesPermissions = res.data.rolesPermissions
            // }
        },
        async handleSubmit() {
            this.submitted = true
            var form_data = $('#permission_form').serialize();
            axios.post('/api/settings/permission/assignPermission', form_data)
            .then((response) => {
                
            })
            .catch((errors) => {
            console.log(errors);
            });
           await this.$store.dispatch('permissions/fetchUserPermissions')
        },
        alreadyGiven (permission){
            
            let permitted = false;
            for (let d of this.rolesPermissions) {
                if (permission == d.permission.id) {
                    permitted = true
                }
            }
            return permitted
        
        }
    }
}
</script>