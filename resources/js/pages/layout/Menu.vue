<template>
    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto">
                    <router-link :to="{ name:'dashboard'}" class="navbar-brand">
                        <div class="brand-logo"></div>
                        <h2 class="brand-text mb-0 d-none">ZUF</h2>
                    </router-link>
                </li>
                <li class="nav-item nav-toggle" @click="hide">
                    <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                        <i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i>
                        <i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block primary" data-ticon="icon-disc"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class=" nav-item" v-if="isPermitted('dashboard')">
                    <router-link class="menu-item-route" :to="{ name:'dashboard'}"><i class="feather icon-home"></i>
                        <span class="menu-title" data-i18n="Dashboard">Dashboard</span>
                    </router-link>
                </li>
                <li class=" nav-item" v-if="isPermitted('donations')">
                    <router-link class="menu-item-route" :to="{ name:'donation.add' }"><i class="feather icon-plus-square"></i>
                        <span class="menu-title" data-i18n="Donation">Add Donation</span>
                    </router-link>
                </li>
                <li class=" nav-item has-sub" v-if="isPermitted('donations')">
                    <a href="#">
                        <i class="feather icon-bar-chart-2"></i>
                        <span class="menu-title" data-i18n="Sponsorships">Donations</span>
                    </a>
                    <ul class="menu-content">
                        <li class="nav-item" v-if="isPermitted('one_off_donations.customers')" :class="{'sub_menu_active' : checkActive(['one_off_donations.customers']) }">
                            <router-link class="menu-item-route" :to="{ name:'one_off_donations.customers' }"><i class="feather icon-trending-up"></i>
                                <span class="menu-title">One-Off Donations</span>
                            </router-link>
                        </li>
                        <li class="nav-item" v-if="isPermitted('monthly_donations.customers')" :class="{'sub_menu_active' : checkActive(['monthly_donations.customers']) }">
                            <router-link class="menu-item-route" :to="{ name:'monthly_donations.customers' }"><i class="feather icon-repeat"></i>
                                <span class="menu-title">Live DDs</span>
                            </router-link>
                        </li>
                         <li class="nav-item" v-if="isPermitted('gocardless.successfull')" :class="{'sub_menu_active' : checkActive(['gocardless.webhooks']) }">
                            <router-link class="menu-item-route" :to="{ name:'gocardless.webhooks' }"><i class="feather icon-cloud"></i>
                                <span class="menu-title">Successful DD Payments</span>
                            </router-link>
                        </li>
                        <li class="nav-item" v-if="isPermitted('gocardless.failed')" :class="{'sub_menu_active' : checkActive(['gocardless.webhooks.failed']) }">
                            <router-link class="menu-item-route" :to="{ name:'gocardless.webhooks.failed' }"><i class="feather icon-cloud-off"></i>
                                <span class="menu-title">Failed DD Payments</span>
                            </router-link>
                        </li>
                    </ul>
                </li>

                <li class=" nav-item has-sub" v-if="isPermitted('sponsorships')">
                    <a href="#">
                        <i class="feather icon-sun"></i>
                        <span class="menu-title" data-i18n="Sponsorships">Sponsorships</span>
                    </a>
                    <ul class="menu-content">
                        <li class="nav-item" v-if="isPermitted('sponsorships.hafiz')" :class="{'sub_menu_active' : checkActive(['sponsorships.hafiz']) }"><router-link class="menu-item-route" :to="{ name:'sponsorships.hafiz'}"><i class="feather icon-users"></i><span class="menu-item" data-i18n="Sponsorships">Hifz</span></router-link></li>
                        <li class="nav-item" v-if="isPermitted('sponsorships.scholar')" :class="{'sub_menu_active' : checkActive(['sponsorships.scholar']) }"><router-link class="menu-item-route" :to="{ name:'sponsorships.scholar'}"><i class="feather icon-users"></i><span class="menu-item" data-i18n="Sponsorships">Scholar</span></router-link></li>
                    </ul>
                </li>
                <li class=" nav-item has-sub" v-if="isPermitted('gift_aids')">
                    <a href="#">
                        <i class="feather icon-sliders"></i>
                        <span class="menu-title" data-i18n="Sponsorships">Gift Aid</span>
                    </a>
                    <ul class="menu-content">
                         <li class=" nav-item" v-if="isPermitted('gift_aids')" :class="{'sub_menu_active' : checkActive(['gift_aids']) }">
                            <router-link class="menu-item-route" :to="{ name:'gift_aids'}"><i class="feather icon-check"></i>
                                <span class="menu-title">Unclaimed Gift Aid</span>
                            </router-link>
                        </li>
                        <li class=" nav-item" v-if="isPermitted('gift_aids_submitted')" :class="{'sub_menu_active' : checkActive(['gift_aids_submitted']) }">
                            <router-link class="menu-item-route" :to="{ name:'gift_aids_submitted'}"><i class="feather icon-check-circle"></i>
                                <span class="menu-title">Make A Claim</span>
                            </router-link>
                        </li>
                        <li class=" nav-item" v-if="isPermitted('gift_aids_reports')" :class="{'sub_menu_active' : checkActive(['gift_aids_reports']) }">
                            <router-link class="menu-item-route" :to="{ name:'gift_aids_reports'}"><i class="feather icon-lock"></i>
                                <span class="menu-title">Past Claims</span>
                            </router-link>
                        </li>
                    </ul>
                </li>

               <li class=" nav-item" v-if="isPermitted('donations')">
                    <router-link class="menu-item-route" :to="{ name:'donations'}"><i class="feather icon-filter"></i>
                        <span class="menu-title" data-i18n="Donation">Reporting</span>
                    </router-link>
                </li>
                <li class=" nav-item has-sub" v-if="isPermitted('settings')">
                    <a href="#">
                        <i class="feather icon-settings"></i>
                        <span class="menu-title" data-i18n="settings_items">Settings</span>
                    </a>
                    <ul class="menu-content">
                        <li :class="{'sub_menu_active' : checkActive(['users']) }"><router-link class="menu-item-route" :to="{ name:'users'}"><i class="feather icon-users"></i><span class="menu-item" data-i18n="settings_items">Users</span></router-link></li>
                        <li :class="{'sub_menu_active' : checkActive(['settings.roles']) }"><router-link class="menu-item-route" :to="{ name:'settings.roles'}"><i class="feather icon-shield"></i><span class="menu-item" data-i18n="settings_items">Roles</span></router-link></li>
                        <li :class="{'sub_menu_active' : checkActive(['settings.permissions']) }"><router-link class="menu-item-route" :to="{ name:'settings.permissions'}"><i class="feather icon-user-check"></i><span class="menu-item" data-i18n="settings_items">Permissions</span></router-link></li>
                        <li :class="{'sub_menu_active' : checkActive(['settings.options']) }"><router-link class="menu-item-route" :to="{ name:'settings.options'}"><i class="feather icon-list"></i><span class="menu-item" data-i18n="settings_items">Options</span></router-link></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->
</template>
<script>

export default {

    mounted(){
        this.$nextTick(() => {
            var instance = this
            $(document).on('click','.navigation-main li .menu-item-route',function(){
                console.log('here')
                instance.hide();
            });

            $(document).on('mouseover','#main-menu-navigation .nav-item',function(){
                $(this).addClass('hover');

            })
            $(document).on('mouseout','#main-menu-navigation .nav-item',function(){
                $(this).removeClass('hover');
            })
            $(document).on('click','#main-menu-navigation .nav-item',function(){

                $('#main-menu-navigation .nav-item').removeClass('open');
                $('#main-menu-navigation .nav-item').removeClass('active');
                $(this).addClass('open');
                $(this).addClass('active');
                console.log($(this).has('ul'))
            })

        //     $(document).on('click', 'ul.menu-content li', function (e) {
        //         console.log('slkdjf')
        //         var $listItem = $(this);
        //         if ($listItem.is('.disabled')) {
        //             e.preventDefault();
        //         } else {
        //             if ($listItem.has('ul')) {
        //                 $(this).addClass('active');

        //                 if ($listItem.is('.open')) {
        //                     $listItem.removeClass('open');
        //                     // menuObj.collapse($listItem);
        //                 } else {
        //                     $listItem.addClass('open');

        //                     $listItem.siblings('.open').find('li.open').trigger('close.app.menu');
        //                     $listItem.siblings('.open').trigger('close.app.menu');
        //                     e.stopPropagation();
        //                 }

        //             }else{
        //                 $(this).addClass('active');
        //             }
        //         }

        //         e.stopPropagation();
        //     });
        })
    },
    methods:{
        checkActive(arr){
            if(this.$route.name == arr[0]){
                return true;
            }
            return false;
        },
        hide: function () {
            var $body = $("body");
            $body.removeClass("menu-open menu-expanded").addClass(["menu-hide",'menu-expanded']);

            if ($body.hasClass("vertical-overlay-menu")) {
                $(".sidenav-overlay").removeClass("d-block").addClass("d-none");
                $("body").css("overflow", "auto");
            }
            if (
                !$(".main-menu").hasClass("menu-native-scroll") &&
                $(".main-menu").hasClass("menu-fixed")
            ) {
                $(".main-menu").removeClass("transformation");
            }

            if (!$body.hasClass("vertical-overlay-menu")) {
                $(".sidenav-overlay").removeClass("d-block d-none");
                $("body").css("overflow", "auto");
            }
            },
    }
}
</script>
