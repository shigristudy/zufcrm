(window.webpackJsonp=window.webpackJsonp||[]).push([[9],{122:function(t,a,e){"use strict";e(81)},123:function(t,a,e){(t.exports=e(5)(!1)).push([t.i,".pagination{justify-content:flex-end!important}.pagination .page-stats{align-items:center;margin-right:5px}.pagination i{color:#3273dc!important}",""])},137:function(t,a,e){"use strict";e(89)},138:function(t,a,e){(t.exports=e(5)(!1)).push([t.i,".dropdown .dropdown-menu .dropdown-item[data-v-3c67ddca],.dropleft .dropdown-menu .dropdown-item[data-v-3c67ddca],.dropright .dropdown-menu .dropdown-item[data-v-3c67ddca],.dropup .dropdown-menu .dropdown-item[data-v-3c67ddca]{padding:5px 10px}",""])},3:function(t,a,e){"use strict";var n={props:["columns","sortKey","sortOrders"],data:function(){return{select_all:!1}}},s=e(0),i=Object(s.a)(n,(function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("table",{staticClass:"table dataTable"},[e("thead",[e("tr",t._l(t.columns,(function(a){return e("th",{key:a.name,class:t.sortKey===a.name?t.sortOrders[a.name]>0?"sorting_asc":"sorting_desc":"sorting "+a.clasess},[a.checkable?e("span",[e("div",{staticClass:"custom-control custom-checkbox"},[e("input",{directives:[{name:"model",rawName:"v-model",value:t.select_all,expression:"select_all"}],staticClass:"custom-control-input",attrs:{type:"checkbox",id:"select_all_checkbox"},domProps:{checked:Array.isArray(t.select_all)?t._i(t.select_all,null)>-1:t.select_all},on:{click:function(a){return t.$emit("selectall",t.select_all)},change:function(a){var e=t.select_all,n=a.target,s=!!n.checked;if(Array.isArray(e)){var i=t._i(e,null);n.checked?i<0&&(t.select_all=e.concat([null])):i>-1&&(t.select_all=e.slice(0,i).concat(e.slice(i+1)))}else t.select_all=s}}}),t._v(" "),e("label",{staticClass:"custom-control-label",attrs:{for:"select_all_checkbox"}})])]):a.sortable?e("span",{on:{click:function(e){return t.$emit("sort",a.name)}}},[e("i",{staticClass:"feather icon-chevrons-down",class:1==t.sortOrders[a.name]?"icon-chevrons-down":"icon-chevrons-up"}),t._v("\n                    "+t._s(a.label)+"\n                ")]):e("span",[t._v("\n                    "+t._s(a.label)+"\n                ")])])})),0)]),t._v(" "),t._t("default")],2)}),[],!1,null,null,null);a.a=i.exports},4:function(t,a,e){"use strict";var n={props:["pagination","filtered"],created:function(){},methods:{isCurrentPage:function(t){return this.pagination.currentPage===t},changePage:function(t){t>this.pagination.lastPage&&(t=this.pagination.lastPage),this.pagination.currentPage=t,this.$emit("getpageData",t)}},computed:{}},s=(e(122),e(0)),i=Object(s.a)(n,(function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("nav",{attrs:{"aria-label":"Page navigation example"}},[e("ul",{staticClass:"pagination justify-content-center mt-2"},t._l(t.pagination.links,(function(a,n){return e("li",{key:n,staticClass:"page-item",class:t.isCurrentPage(a.label)?"active":"",on:{click:function(e){return e.preventDefault(),t.changePage(a.url)}}},[e("a",{staticClass:"page-link",domProps:{innerHTML:t._s(a.label)}})])})),0)])}),[],!1,null,null,null);a.a=i.exports},48:function(t,a,e){"use strict";e.r(a);var n=e(3),s=e(4),i={components:{datatable:n.a,pagination:s.a},middleware:"auth",metaInfo:function(){return{title:"Claimed"}},data:function(){var t={},a=[{label:"Projects",name:"name"},{label:"Sponsor By",name:"first_name"},{label:"Total",name:"order_total"},{label:"Payment Method",name:"payment_method"},{label:"Submitted",name:"submitted"},{label:"Claimed",name:"claimed"}];return a.forEach((function(a){t[a.name]=-1})),{donations:[],columns:a,sortKey:"full_name",sortOrders:t,perPage:["10","20","30","All"],tableData:{draw:0,length:10,search:"",column:0,dir:"desc"},pagination:{lastPage:"",currentPage:"",total:"",lastPageUrl:"",nextPageUrl:"",prevPageUrl:"",from:"",to:"",links:[]}}},methods:{getData:function(){var t=this,a=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"/api/getAllClaimedDonations";this.tableData.draw++,axios.get(a,{params:this.tableData}).then((function(a){var e=a.data;t.tableData.draw==e.draw&&(t.donations=e.data.data,t.configPagination(e.data))})).catch((function(t){console.log(t)}))},sortBy:function(t){this.sortKey=t,this.sortOrders[t]=-1*this.sortOrders[t],this.tableData.column=this.getIndex(this.columns,"name",t),this.tableData.dir=1===this.sortOrders[t]?"asc":"desc",this.getData()}},created:function(){this.getData()}},l=(e(137),e(0)),o=Object(l.a)(i,(function(){var t=this.$createElement;this._self._c;return this._m(0)}),[function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("div",{staticClass:"content-wrapper"},[e("div",{staticClass:"content-header row"},[e("div",{staticClass:"content-header-left col-md-9 col-12 mb-2"},[e("div",{staticClass:"row breadcrumbs-top"},[e("div",{staticClass:"col-12"},[e("h2",{staticClass:"content-header-title float-left mb-0"},[t._v("Gift Aids Reports")])])])])]),t._v(" "),e("div",{staticClass:"content-body"},[e("section",{attrs:{id:"basic-examples"}},[e("div",{staticClass:"row match-height"},[e("div",{staticClass:"col-xl-4 col-md-6 col-sm-12"},[e("div",{staticClass:"card",staticStyle:{"/* height":"420.828px"}},[e("div",{staticClass:"card-content"},[e("div",{staticClass:"card-body"},[e("h5",{staticClass:"mt-1"},[t._v("Vuexy Admin")]),t._v(" "),e("p",{staticClass:"card-text"},[t._v("By Pixinvent Creative Studio")]),t._v(" "),e("hr",{staticClass:"my-1"}),t._v(" "),e("div",{staticClass:"d-flex justify-content-between mt-2"},[e("div",{},[e("p",{staticClass:"font-medium-2 mb-0"},[t._v("12 June 2019")]),t._v(" "),e("p",{},[t._v("Delivery Date")])])])])])])])])])])])}],!1,null,"3c67ddca",null);a.default=o.exports},81:function(t,a,e){var n=e(123);"string"==typeof n&&(n=[[t.i,n,""]]);var s={hmr:!0,transform:void 0,insertInto:void 0};e(6)(n,s);n.locals&&(t.exports=n.locals)},89:function(t,a,e){var n=e(138);"string"==typeof n&&(n=[[t.i,n,""]]);var s={hmr:!0,transform:void 0,insertInto:void 0};e(6)(n,s);n.locals&&(t.exports=n.locals)}}]);