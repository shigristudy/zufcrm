(window.webpackJsonp=window.webpackJsonp||[]).push([[0],{122:function(t,a,e){"use strict";e(81)},123:function(t,a,e){(t.exports=e(5)(!1)).push([t.i,".pagination{justify-content:flex-end!important}.pagination .page-stats{align-items:center;margin-right:5px}.pagination i{color:#3273dc!important}",""])},131:function(t,a,e){"use strict";e(86)},132:function(t,a,e){(t.exports=e(5)(!1)).push([t.i,".dropdown .dropdown-menu .dropdown-item[data-v-0fa0bd09],.dropleft .dropdown-menu .dropdown-item[data-v-0fa0bd09],.dropright .dropdown-menu .dropdown-item[data-v-0fa0bd09],.dropup .dropdown-menu .dropdown-item[data-v-0fa0bd09]{padding:5px 10px}.btn.btn-sm.btn-icon[data-v-0fa0bd09]{padding:10px;font-size:15px}",""])},16:function(t,a,e){"use strict";e.r(a);var o=e(1),n=e.n(o),r=e(3),s=e(4),i=e(2),l=e.n(i);function c(t,a,e,o,n,r,s){try{var i=t[r](s),l=i.value}catch(t){return void e(t)}i.done?a(l):Promise.resolve(l).then(o,n)}function d(t){return function(){var a=this,e=arguments;return new Promise((function(o,n){var r=t.apply(a,e);function s(t){c(r,o,n,s,i,"next",t)}function i(t){c(r,o,n,s,i,"throw",t)}s(void 0)}))}}var u={components:{datatable:r.a,pagination:s.a},middleware:"auth",metaInfo:function(){return{title:"Reporting"}},data:function(){var t={},a=[{label:"Projects",name:"name"},{label:"Sponsor By",name:"first_name"},{label:"Giftaid",name:"gift_aid"},{label:"Donation Date",name:"donation_date"},{label:"Payment Method",name:"payment_method"},{label:"Total",name:"order_total",sortable:!0},{label:"Action",name:"action"}];return a.forEach((function(a){t[a.name]=-1})),{wooProducts:[],donations:[],columns:a,sortKey:"first_name",sortOrders:t,perPage:["10","20","30"],tableData:{draw:0,length:10,search:"",column:0,dir:"desc",filtering:!1,form:new l.a({gift_aid:"",project:"",donation_type:"",payment_method:"",date_from:"",date_to:"",has_sponsored:""})},pagination:{lastPage:"",currentPage:"",total:"",lastPageUrl:"",nextPageUrl:"",prevPageUrl:"",from:"",to:"",links:[]}}},methods:{clearFilters:function(){this.form.reset(),this.tableData.filtering=!1},handleSubmit:function(){var t=this;return d(n.a.mark((function a(){return n.a.wrap((function(a){for(;;)switch(a.prev=a.next){case 0:t.tableData.filtering=!0,t.getData();case 2:case"end":return a.stop()}}),a)})))()},project_name_computed:function(t){var a="";return a="simple"==t.type?"[One-Off]":"[Monthly]",null!=t.project_page&&""!=t.project_page?t.project_page+" - "+t.name+" - "+a:t.name+" - "+a},getProjects:function(){var t=this;return d(n.a.mark((function a(){return n.a.wrap((function(a){for(;;)switch(a.prev=a.next){case 0:axios.get("/api/getProjects").then((function(a){t.wooProducts=a.data})).catch((function(t){console.log(t)}));case 1:case"end":return a.stop()}}),a)})))()},getData:function(){var t=this,a=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"/api/donation/getDonations";this.tableData.draw++,axios.get(a,{params:this.tableData}).then((function(a){var e=a.data;t.tableData.draw==e.draw&&(t.donations=e.data.data,t.configPagination(e.data))})).catch((function(t){console.log(t)}))},sortBy:function(t){this.sortKey=t,this.sortOrders[t]=-1*this.sortOrders[t],this.tableData.column=this.getIndex(this.columns,"name",t),this.tableData.dir=1===this.sortOrders[t]?"asc":"desc",this.getData()}},created:function(){this.getData(),this.getProjects()}},p=(e(131),e(0)),v=Object(p.a)(u,(function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("div",{staticClass:"content-wrapper"},[e("div",{staticClass:"content-header row"},[t._m(0),t._v(" "),e("div",{staticClass:"content-header-right text-md-right col-md-3 col-12 d-md-block d-none"},[e("div",{staticClass:"form-group breadcrum-right"},[e("router-link",{staticClass:"btn btn-primary mr-1 mb-1 waves-effect waves-light",attrs:{to:{name:"donation.add"}}},[t._v("Add Donation")])],1)])]),t._v(" "),e("div",{staticClass:"content-body"},[e("div",{staticClass:"card",attrs:{id:"accordionWrapa50",role:"tablist","aria-multiselectable":"true"}},[e("div",{staticClass:"accordion collapse-icon",attrs:{id:"accordionExample0","data-toggle-hover":"true"}},[e("div",{staticClass:"collapse-border-item collapse-header card collapse-bordered"},[t._m(1),t._v(" "),e("div",{staticClass:"collapse",attrs:{id:"collapse200","aria-labelledby":"heading200","data-parent":"#accordionExample0"}},[e("div",{staticClass:"card-body"},[e("form",{on:{submit:function(a){return a.preventDefault(),t.handleSubmit(a)},keydown:function(a){return t.tableData.form.onKeydown(a)}}},[e("div",{staticClass:"row"},[e("div",{staticClass:"col-md-3"},[e("fieldset",{staticClass:"form-group"},[e("label",{attrs:{for:"basicInput"}},[t._v("GIFT AID")]),t._v(" "),e("select",{directives:[{name:"model",rawName:"v-model",value:t.tableData.form.gift_aid,expression:"tableData.form.gift_aid"}],staticClass:"form-control",on:{change:function(a){var e=Array.prototype.filter.call(a.target.options,(function(t){return t.selected})).map((function(t){return"_value"in t?t._value:t.value}));t.$set(t.tableData.form,"gift_aid",a.target.multiple?e:e[0])}}},[e("option",{attrs:{value:""}},[t._v("Select Gift Aid")]),t._v(" "),e("option",{attrs:{value:"Yes"}},[t._v("Yes")]),t._v(" "),e("option",{attrs:{value:"No"}},[t._v("No")]),t._v(" "),e("option",{attrs:{value:"written"}},[t._v("Written")]),t._v(" "),e("option",{attrs:{value:"online"}},[t._v("Online")]),t._v(" "),e("option",{attrs:{value:"Verbal"}},[t._v("Verbal")])])])]),t._v(" "),e("div",{staticClass:"col-md-3"},[e("fieldset",{staticClass:"form-group"},[e("label",{attrs:{for:"basicInput"}},[t._v("Project")]),t._v(" "),e("select",{directives:[{name:"model",rawName:"v-model",value:t.tableData.form.project,expression:"tableData.form.project"}],staticClass:"form-control",on:{change:function(a){var e=Array.prototype.filter.call(a.target.options,(function(t){return t.selected})).map((function(t){return"_value"in t?t._value:t.value}));t.$set(t.tableData.form,"project",a.target.multiple?e:e[0])}}},[t._m(2),t._v(" "),t._l(t.wooProducts,(function(a){return e("option",{key:"woo_project"+a.product_id,domProps:{value:a.product_id}},[e("strong",[t._v(t._s(t.project_name_computed(a)))])])}))],2)])]),t._v(" "),e("div",{staticClass:"col-md-3"},[e("fieldset",{staticClass:"form-group"},[e("label",{attrs:{for:"basicInput"}},[t._v("Donation Type")]),t._v(" "),e("select",{directives:[{name:"model",rawName:"v-model",value:t.tableData.form.donation_type,expression:"tableData.form.donation_type"}],staticClass:"form-control",on:{change:function(a){var e=Array.prototype.filter.call(a.target.options,(function(t){return t.selected})).map((function(t){return"_value"in t?t._value:t.value}));t.$set(t.tableData.form,"donation_type",a.target.multiple?e:e[0])}}},[e("option",{attrs:{value:""}},[t._v("Select Donation Type")]),t._v(" "),e("option",{attrs:{value:"online"}},[t._v("On-line")]),t._v(" "),e("option",{attrs:{value:"offline"}},[t._v("Off-Line")])])])]),t._v(" "),e("div",{staticClass:"col-md-3"},[e("fieldset",{staticClass:"form-group"},[e("label",{attrs:{for:"basicInput"}},[t._v("Payment Method")]),t._v(" "),e("select",{directives:[{name:"model",rawName:"v-model",value:t.tableData.form.payment_method,expression:"tableData.form.payment_method"}],staticClass:"form-control",on:{change:function(a){var e=Array.prototype.filter.call(a.target.options,(function(t){return t.selected})).map((function(t){return"_value"in t?t._value:t.value}));t.$set(t.tableData.form,"payment_method",a.target.multiple?e:e[0])}}},[e("option",{attrs:{value:""}},[t._v("Select Payment Method")]),t._v(" "),e("option",{attrs:{value:"Bank"}},[t._v("Bank")]),t._v(" "),e("option",{attrs:{value:"Cash"}},[t._v("Cash")]),t._v(" "),e("option",{attrs:{value:"Cheque"}},[t._v("Cheque")]),t._v(" "),e("option",{attrs:{value:"stripe"}},[t._v("Stripe")]),t._v(" "),e("option",{attrs:{value:"ppec_paypal"}},[t._v("Paypal")]),t._v(" "),e("option",{attrs:{value:"Eazy Collect"}},[t._v("Eazy Collect")])])])])]),t._v(" "),e("div",{staticClass:"row"},[e("div",{staticClass:"col-md-3"},[e("fieldset",{staticClass:"form-group"},[e("label",{attrs:{for:"basicInput"}},[t._v("Date From")]),t._v(" "),e("input",{directives:[{name:"model",rawName:"v-model",value:t.tableData.form.date_from,expression:"tableData.form.date_from"}],staticClass:"form-control",attrs:{type:"date"},domProps:{value:t.tableData.form.date_from},on:{input:function(a){a.target.composing||t.$set(t.tableData.form,"date_from",a.target.value)}}})])]),t._v(" "),e("div",{staticClass:"col-md-3"},[e("fieldset",{staticClass:"form-group"},[e("label",{attrs:{for:"basicInput"}},[t._v("Date To")]),t._v(" "),e("input",{directives:[{name:"model",rawName:"v-model",value:t.tableData.form.date_to,expression:"tableData.form.date_to"}],staticClass:"form-control",attrs:{type:"date"},domProps:{value:t.tableData.form.date_to},on:{input:function(a){a.target.composing||t.$set(t.tableData.form,"date_to",a.target.value)}}})])]),t._v(" "),e("div",{staticClass:"col-md-3"},[e("fieldset",{staticClass:"form-group"},[e("label",{attrs:{for:"basicInput"}},[t._v("Has Sponsored?")]),t._v(" "),e("select",{directives:[{name:"model",rawName:"v-model",value:t.tableData.form.has_sponsored,expression:"tableData.form.has_sponsored"}],staticClass:"form-control",on:{change:function(a){var e=Array.prototype.filter.call(a.target.options,(function(t){return t.selected})).map((function(t){return"_value"in t?t._value:t.value}));t.$set(t.tableData.form,"has_sponsored",a.target.multiple?e:e[0])}}},[e("option",{attrs:{value:""}},[t._v("Select Type")]),t._v(" "),e("option",{attrs:{value:"Yes"}},[t._v("Yes")]),t._v(" "),e("option",{attrs:{value:"No"}},[t._v("No")])])])])]),t._v(" "),e("div",{staticClass:"d-flex justify-content-between"},[e("button",{staticClass:"btn btn-secondary mr-1 mb-1 waves-effect waves-light",attrs:{type:"submit"},on:{click:function(a){return t.clearFilters()}}},[t._v("Clear")]),t._v(" "),e("v-button",{attrs:{loading:t.tableData.form.busy,type:"primary"}},[t._v("Filter")])],1)])])])])])]),t._v(" "),e("section",{staticClass:"card",attrs:{id:"description"}},[e("div",{staticClass:"card-content"},[e("div",{staticClass:"card-body"},[e("div",{staticClass:"row dataTables_wrapper mb-1"},[e("div",{staticClass:"col-sm-12 col-md-6"},[e("div",{staticClass:"dataTables_length"},[e("label",[t._v("Show "),e("select",{directives:[{name:"model",rawName:"v-model",value:t.tableData.length,expression:"tableData.length"}],staticClass:"custom-select custom-select-sm form-control form-control-sm",on:{change:[function(a){var e=Array.prototype.filter.call(a.target.options,(function(t){return t.selected})).map((function(t){return"_value"in t?t._value:t.value}));t.$set(t.tableData,"length",a.target.multiple?e:e[0])},function(a){return t.getData()}]}},t._l(t.perPage,(function(a,o){return e("option",{key:o,domProps:{value:a}},[t._v("\n                      "+t._s(a)+"\n                    ")])})),0),t._v(" entries\n                ")])])]),t._v(" "),e("div",{staticClass:"col-sm-12 col-md-6"},[e("div",{staticClass:"dataTables_filter"},[e("label",[t._v("Search:"),e("input",{directives:[{name:"model",rawName:"v-model",value:t.tableData.search,expression:"tableData.search"}],staticClass:"form-control form-control-sm",attrs:{type:"search",placeholder:"Search Table"},domProps:{value:t.tableData.search},on:{input:[function(a){a.target.composing||t.$set(t.tableData,"search",a.target.value)},function(a){return t.getData()}]}})])])])]),t._v(" "),e("div",{staticClass:"table-responsive"},[e("datatable",{staticClass:"table-striped",attrs:{columns:t.columns,sortKey:t.sortKey,sortOrders:t.sortOrders},on:{sort:t.sortBy}},[e("tbody",t._l(t.donations,(function(a){return e("tr",{key:a.id},[e("td",t._l(a.items,(function(a){return e("div",{key:"product_id"+a.id,staticClass:"mr-1 mb-1 d-inline"},[t._v(t._s(a.product.name))])})),0),t._v(" "),e("td",[t._v(t._s(a.first_name+" "+a.last_name))]),t._v(" "),e("td",[e("div",{staticClass:"badge badge-pill badge-glow badge-success mr-1 mb-1"},[t._v(t._s(a.gift_aid))])]),t._v(" "),e("td",[t._v(t._s(t.formattedDateDDMMYY(a.donation_date)))]),t._v(" "),e("td",[t._v(t._s("ppec_paypal"==a.payment_method?"Paypal":t.capitalize(a.payment_method)))]),t._v(" "),e("td",[t._v(t._s(t.round2Fixed(a.order_total)))]),t._v(" "),e("td",{staticClass:"text-center"},[e("div",{staticClass:"dropdown"},[e("button",{staticClass:"btn-icon btn btn-primary btn-round btn-sm dropdown-toggle waves-effect waves-light",attrs:{type:"button","data-toggle":"dropdown","aria-haspopup":"true","aria-expanded":"false"}},[t._v("\n                              Action\n                            ")]),t._v(" "),e("div",{staticClass:"dropdown-menu dropdown-menu-right",staticStyle:{position:"absolute",transform:"translate3d(263px, 36px, 0px)",top:"0px",left:"0px","will-change":"transform"},attrs:{"x-placement":"bottom-end"}},[e("router-link",{staticClass:"dropdown-item",attrs:{to:{name:"donation.view",params:{id:a.id}}}},[t._v("View")]),t._v(" "),e("router-link",{staticClass:"dropdown-item",attrs:{to:{name:"donation.edit",params:{id:a.id}}}},[t._v("Edit")])],1)])])])})),0)])],1),t._v(" "),e("pagination",{attrs:{pagination:t.pagination},on:{getpageData:t.getData,prev:function(a){return t.getData(t.pagination.prevPageUrl)},next:function(a){return t.getData(t.pagination.nextPageUrl)}}})],1)])])])])}),[function(){var t=this.$createElement,a=this._self._c||t;return a("div",{staticClass:"content-header-left col-md-9 col-12 mb-2"},[a("div",{staticClass:"row breadcrumbs-top"},[a("div",{staticClass:"col-12"},[a("h2",{staticClass:"content-header-title float-left mb-0"},[this._v("Reports")])])])])},function(){var t=this.$createElement,a=this._self._c||t;return a("div",{staticClass:"card-header collapsed",attrs:{id:"heading200","data-toggle":"collapse",role:"button","data-target":"#collapse200","aria-expanded":"false","aria-controls":"collapse200"}},[a("span",{staticClass:"lead collapse-title"},[this._v("\n                    Advanced Filter\n                ")])])},function(){var t=this.$createElement,a=this._self._c||t;return a("option",{attrs:{value:""}},[a("strong",[this._v("Select Project")])])}],!1,null,"0fa0bd09",null);a.default=v.exports},3:function(t,a,e){"use strict";var o={props:["columns","sortKey","sortOrders"],data:function(){return{select_all:!1}}},n=e(0),r=Object(n.a)(o,(function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("table",{staticClass:"table dataTable"},[e("thead",[e("tr",t._l(t.columns,(function(a){return e("th",{key:a.name,class:t.sortKey===a.name?t.sortOrders[a.name]>0?"sorting_asc":"sorting_desc":"sorting "+a.clasess},[a.checkable?e("span",[e("div",{staticClass:"custom-control custom-checkbox"},[e("input",{directives:[{name:"model",rawName:"v-model",value:t.select_all,expression:"select_all"}],staticClass:"custom-control-input",attrs:{type:"checkbox",id:"select_all_checkbox"},domProps:{checked:Array.isArray(t.select_all)?t._i(t.select_all,null)>-1:t.select_all},on:{click:function(a){return t.$emit("selectall",t.select_all)},change:function(a){var e=t.select_all,o=a.target,n=!!o.checked;if(Array.isArray(e)){var r=t._i(e,null);o.checked?r<0&&(t.select_all=e.concat([null])):r>-1&&(t.select_all=e.slice(0,r).concat(e.slice(r+1)))}else t.select_all=n}}}),t._v(" "),e("label",{staticClass:"custom-control-label",attrs:{for:"select_all_checkbox"}})])]):a.sortable?e("span",{on:{click:function(e){return t.$emit("sort",a.name)}}},[e("i",{staticClass:"feather icon-chevrons-down",class:1==t.sortOrders[a.name]?"icon-chevrons-down":"icon-chevrons-up"}),t._v("\n                    "+t._s(a.label)+"\n                ")]):e("span",[t._v("\n                    "+t._s(a.label)+"\n                ")])])})),0)]),t._v(" "),t._t("default")],2)}),[],!1,null,null,null);a.a=r.exports},4:function(t,a,e){"use strict";var o={props:["pagination","filtered"],created:function(){},methods:{isCurrentPage:function(t){return this.pagination.currentPage===t},changePage:function(t){t>this.pagination.lastPage&&(t=this.pagination.lastPage),this.pagination.currentPage=t,this.$emit("getpageData",t)}},computed:{}},n=(e(122),e(0)),r=Object(n.a)(o,(function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("nav",{attrs:{"aria-label":"Page navigation example"}},[e("ul",{staticClass:"pagination justify-content-center mt-2"},t._l(t.pagination.links,(function(a,o){return e("li",{key:o,staticClass:"page-item",class:t.isCurrentPage(a.label)?"active":"",on:{click:function(e){return e.preventDefault(),t.changePage(a.url)}}},[e("a",{staticClass:"page-link",domProps:{innerHTML:t._s(a.label)}})])})),0)])}),[],!1,null,null,null);a.a=r.exports},81:function(t,a,e){var o=e(123);"string"==typeof o&&(o=[[t.i,o,""]]);var n={hmr:!0,transform:void 0,insertInto:void 0};e(6)(o,n);o.locals&&(t.exports=o.locals)},86:function(t,a,e){var o=e(132);"string"==typeof o&&(o=[[t.i,o,""]]);var n={hmr:!0,transform:void 0,insertInto:void 0};e(6)(o,n);o.locals&&(t.exports=o.locals)}}]);