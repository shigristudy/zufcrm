(window.webpackJsonp=window.webpackJsonp||[]).push([[45],{64:function(t,e,r){"use strict";r.r(e);var a=r(1),o=r.n(a),s=r(2),n=r.n(s),i=r(9);function m(t,e,r,a,o,s,n){try{var i=t[s](n),m=i.value}catch(t){return void r(t)}i.done?e(m):Promise.resolve(m).then(a,o)}var l={scrollToTop:!1,metaInfo:function(){return{title:this.$t("settings")}},data:function(){return{form:new n.a({name:"",email:""})}},computed:Object(i.b)({user:"auth/user"}),created:function(){var t=this;this.form.keys().forEach((function(e){t.form[e]=t.user[e]}))},methods:{update:function(){var t,e=this;return(t=o.a.mark((function t(){var r,a;return o.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,e.form.patch("/api/settings/profile");case 2:r=t.sent,a=r.data,e.$store.dispatch("auth/updateUser",{user:a});case 5:case"end":return t.stop()}}),t)})),function(){var e=this,r=arguments;return new Promise((function(a,o){var s=t.apply(e,r);function n(t){m(s,a,o,n,i,"next",t)}function i(t){m(s,a,o,n,i,"throw",t)}n(void 0)}))})()}}},u=r(0),c=Object(u.a)(l,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("card",{attrs:{title:t.$t("your_info")}},[r("form",{on:{submit:function(e){return e.preventDefault(),t.update(e)},keydown:function(e){return t.form.onKeydown(e)}}},[r("alert-success",{attrs:{form:t.form,message:t.$t("info_updated")}}),t._v(" "),r("div",{staticClass:"form-group row"},[r("label",{staticClass:"col-md-3 col-form-label text-md-right"},[t._v(t._s(t.$t("name")))]),t._v(" "),r("div",{staticClass:"col-md-7"},[r("input",{directives:[{name:"model",rawName:"v-model",value:t.form.name,expression:"form.name"}],staticClass:"form-control",class:{"is-invalid":t.form.errors.has("name")},attrs:{type:"text",name:"name"},domProps:{value:t.form.name},on:{input:function(e){e.target.composing||t.$set(t.form,"name",e.target.value)}}}),t._v(" "),r("has-error",{attrs:{form:t.form,field:"name"}})],1)]),t._v(" "),r("div",{staticClass:"form-group row"},[r("label",{staticClass:"col-md-3 col-form-label text-md-right"},[t._v(t._s(t.$t("email")))]),t._v(" "),r("div",{staticClass:"col-md-7"},[r("input",{directives:[{name:"model",rawName:"v-model",value:t.form.email,expression:"form.email"}],staticClass:"form-control",class:{"is-invalid":t.form.errors.has("email")},attrs:{type:"email",name:"email"},domProps:{value:t.form.email},on:{input:function(e){e.target.composing||t.$set(t.form,"email",e.target.value)}}}),t._v(" "),r("has-error",{attrs:{form:t.form,field:"email"}})],1)]),t._v(" "),r("div",{staticClass:"form-group row"},[r("div",{staticClass:"col-md-9 ml-md-auto"},[r("v-button",{attrs:{loading:t.form.busy,type:"success"}},[t._v("\n          "+t._s(t.$t("update"))+"\n        ")])],1)])],1)])}),[],!1,null,null,null);e.default=c.exports}}]);