import { mapGetters } from 'vuex'

export default {
    data() {
        return {
            BaseUrl: window.location.origin,
            BaseUrlPublic: window.location.origin+'/public/',
            AdminBaseUrl: window.location.origin+'/api/',
            AssetsBaseUrl:window.location.origin+'/uploads/',
            imgSrc:'',
            datatable:null,
            custom_notice:{
                showNotice:false,
                notice_message:'',
                notice_type:'',
                isCancelAble:false,
            },
            custom_nofications:[],
            usernotifications:[],

        }
    },
    created() {

    },
    methods: {
        formattedDate(date){
            var date = new Date(date)
            return date.getDate() + '/' + date.getMonth() + '/' + date.getFullYear()
        },
        formattedDateDDMMYY(date){
            var datearray = date.split("-");
            return datearray[2]+'/'+datearray[1]+'/'+datearray[0];
        },
        async callApi(method, url, dataObj) {
            try {
                var res = await axios({
                    method: method,
                    url: url,
                    data: dataObj
                });
                if(res){

                    if(method == 'post'){
                        // this.getUserNotifications()
                    }
                    return res;
                }


            } catch (e) {
                console.log(e.response)
                return e.response
            }
        },
        isPermitted(section){
            return this.checkUserPermission(section)
        },
        checkUserPermission(key) {
            let permitted = false;
            for (let d of this.userStatePermissions) {
                if (key == d.permission.name) {
                    permitted = true
                }
            }
            return permitted
        },
        isSuperAdmin() {
            if(this.$store.state.user.role == 'super-administrator'){
                return true;
            }
            return false;
        },
        isAdminUser() {
            if(this.$store.state.user.role == 'admin-user'){
                return true;
            }
            return false;
        },
        assetPath(file){
            return this.AssetsBaseUrl + file;
        },
        
        convertToArray(value){
            var main_items = [];
            var items = value.split("\n");
            $.each(items, function(k,v){
                var item = v.split(":");
                var obj = {
                    label : $.trim(item[1]),
                    value : $.trim(item[0])
                };
                main_items.push(obj)
            });
            return main_items;
        },
        initSelect2Fields(placeholder) {
            $('.select2').select2({
                placeholder: placeholder
            });
        },

        async getUserPermissions(){

            const res = await this.callApi('get',this.AdminBaseUrl + 'settings/permission/getUserPermissions');
            if(res.status == 200){
                this.$store.dispatch('permissions/setUserPermissions',res.data)
                // this.$store.dispatch('setUserPermissions', res.data)
            }
        },
        async getUserNotifications(){
            const res = await this.callApi('get',this.AdminBaseUrl + 'general/get_notices');
            if(res.status == 200){
                //console.log(res.data.data)
                if(this.$store.state.user_custom_notice.length <= 0 ){
                    this.$store.dispatch('setUserNotifications', res.data.data)
                }else{
                    this.$store.dispatch('updateUserNotification', res.data.data)
                }
            }
        },
        async getUserInformations(){

            const res = await this.callApi('get',this.AdminBaseUrl + 'user/getUserInformations');
            if(res.status == 200){
                console.log(res.data.extraData)
                console.log(res.data.extraData.notifications.notifications)
                this.usernotifications = res.data.extraData.notifications.notifications
            }
        },
        format_date(timestamp){
            var date = new Date(timestamp);
            var month = date.getMonth()+1;
            var new_date = date.getDate() + '-' + month + '-' + date.getFullYear() + ' ' +date.getHours() + ':' + date.getMinutes();
            return new_date;
        },
        configPagination(data) {
            this.pagination.lastPage = data.last_page;
            this.pagination.currentPage = data.current_page;
            this.pagination.total = data.total;
            this.pagination.lastPageUrl = data.last_page_url;
            this.pagination.nextPageUrl = data.next_page_url;
            this.pagination.prevPageUrl = data.prev_page_url;
            this.pagination.from = data.from;
            this.pagination.to = data.to;
            this.pagination.links = data.links;
        },
        getIndex(array, key, value) {
            return array.findIndex(i => i[key] == value)
        },
        getBase64(file) {
            return new Promise((resolve, reject) => {
                const reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = () => resolve(reader.result);
                reader.onerror = error => reject(error);
            });
         },
         download_table_as_csv(table_id, separator = ',',exclude_colums=[]) {
            // Select rows from table_id
            var rows = document.querySelectorAll('table#' + table_id + ' tr');
            // Construct csv
            var csv = [];
            for (var i = 0; i < rows.length; i++) {
                var row = [], cols = rows[i].querySelectorAll('td, th');
                for (var j = 0; j < cols.length; j++) {
                    if(!exclude_colums.includes(j)){
                        var data = cols[j].innerText.replace(/(\r\n|\n|\r)/gm, '').replace(/(\s\s)/gm, ' ')
                        data = data.replace(/"/g, '""');
                        // Push escaped string
                        row.push('"' + data + '"');
                    }
                }
                csv.push(row.join(separator));
            }
            var csv_string = csv.join('\n');
            // Download it
            var filename = 'export_' + table_id + '_' + new Date().toLocaleDateString() + '.ods';
            var link = document.createElement('a');
            link.style.display = 'none';
            link.setAttribute('target', '_blank');
            link.setAttribute('href', 'data:text/ods;charset=utf-8,' + encodeURIComponent(csv_string));
            link.setAttribute('download', filename);
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        },
        round2Fixed(value) {
            value = +value;
            
            if (isNaN(value))
                return NaN;
            
            // Shift
            value = value.toString().split('e');
            value = Math.round(+(value[0] + 'e' + (value[1] ? (+value[1] + 2) : 2)));
            
            // Shift back
            value = value.toString().split('e');
            return "£"+ (+(value[0] + 'e' + (value[1] ? (+value[1] - 2) : -2))).toFixed(2);
        },
        formatePostal(mystring){
            mystring = mystring.replace(/\s/g, '');
            mystring = mystring.split("").reverse().join("")
            mystring = mystring.substr(0,3) + " " + mystring.substr(3)
            return mystring.split("").reverse().join("").toUpperCase()
        },
        capitalize(s){
            return s[0].toUpperCase() + s.slice(1);
        }

    },

    computed: mapGetters({
        userStatePermissions: 'permissions/userPermissions'
    }),

}