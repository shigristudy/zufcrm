<template>
    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto">
                    <router-link :to="{ name:'dashboard'}" class="navbar-brand">
                        <div class="brand-logo"></div>
                        <h2 class="brand-text mb-0">ZUF</h2>
                    </router-link>
                </li>
                <!-- <li class="nav-item nav-toggle">
                    <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                        <i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i>
                        <i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block primary" data-ticon="icon-disc"></i>
                    </a>
                </li> -->
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class=" nav-item" v-if="isPermitted('dashboard')">
                    <router-link :to="{ name:'dashboard'}"><i class="feather icon-home"></i>
                        <span class="menu-title" data-i18n="Dashboard">Dashboard</span>
                    </router-link>
                </li>
                <li class=" nav-item" v-if="isPermitted('donations')">
                    <router-link :to="{ name:'donation.add' }"><i class="feather icon-plus-square"></i>
                        <span class="menu-title" data-i18n="Donation">Add Donation</span>
                    </router-link>
                </li>
                <li class=" nav-item" v-if="isPermitted('donations')">
                    <a href="#">
                        <i class="feather icon-sliders"></i>
                        <span class="menu-title" data-i18n="Sponsorships">Donations</span>
                    </a>
                    <ul class="menu-content">
                        <li class="nav-item" v-if="isPermitted('one_off_donations.customers')">
                            <router-link :to="{ name:'one_off_donations.customers' }"><i class="feather icon-trending-up"></i>
                                <span class="menu-title">One-off Donations</span>
                            </router-link>
                        </li>
                        <li class="nav-item" v-if="isPermitted('monthly_donations.customers')">
                            <router-link :to="{ name:'monthly_donations.customers' }"><i class="feather icon-repeat"></i>
                                <span class="menu-title">Live DDs</span>
                            </router-link>
                        </li>
                         <li class="nav-item" v-if="isPermitted('gocardless.successfull')">
                            <router-link :to="{ name:'gocardless.webhooks' }"><i class="feather icon-cloud"></i>
                                <span class="menu-title">Gocardless Successfull</span>
                            </router-link>
                        </li>
                        <li class="nav-item" v-if="isPermitted('gocardless.failed')">
                            <router-link :to="{ name:'gocardless.webhooks.failed' }"><i class="feather icon-cloud-off"></i>
                                <span class="menu-title">Gocardless Failed</span>
                            </router-link>
                        </li>
                    </ul>
                </li>
                
               
                <li class=" nav-item" v-if="isPermitted('sponsorships')">
                    <a href="#">
                        <i class="feather icon-sliders"></i>
                        <span class="menu-title" data-i18n="Sponsorships">Sponsorships</span>
                    </a>
                    <ul class="menu-content">
                        <li v-if="isPermitted('sponsorships.hafiz')"><router-link :to="{ name:'sponsorships.hafiz'}"><i></i><span class="menu-item" data-i18n="Sponsorships">Hafiz Students</span></router-link></li>
                        <li v-if="isPermitted('sponsorships.scholar')"><router-link :to="{ name:'sponsorships.scholar'}"><i></i><span class="menu-item" data-i18n="Sponsorships">Scholar Students</span></router-link></li>
                    </ul>
                </li>
                <li class=" nav-item" v-if="isPermitted('gift_aids')">
                    <a href="#">
                        <i class="feather icon-sliders"></i>
                        <span class="menu-title" data-i18n="Sponsorships">Gift Aid</span>
                    </a>
                    <ul class="menu-content">
                         <li class=" nav-item" v-if="isPermitted('gift_aids')">
                            <router-link :to="{ name:'gift_aids'}"><i class="feather icon-check"></i>
                                <span class="menu-title">Unclaimed Gift Aid</span>
                            </router-link>
                        </li>
                        <li class=" nav-item" v-if="isPermitted('gift_aids_submitted')">
                            <router-link :to="{ name:'gift_aids_submitted'}"><i class="feather icon-check-circle"></i>
                                <span class="menu-title">Make A Claim</span>
                            </router-link>
                        </li>
                        <li class=" nav-item" v-if="isPermitted('gift_aids_reports')">
                            <router-link :to="{ name:'gift_aids_reports'}"><i class="feather icon-lock"></i>
                                <span class="menu-title">Claimed</span>
                            </router-link>
                        </li>
                    </ul>
                </li>
               
               <li class=" nav-item" v-if="isPermitted('donations')">
                    <router-link :to="{ name:'donations'}"><i class="feather icon-plus-square"></i>
                        <span class="menu-title" data-i18n="Donation">Reporting</span>
                    </router-link>
                </li>
                <li class=" nav-item" v-if="isPermitted('settings')">
                    <a href="#">
                        <i class="feather icon-settings"></i>
                        <span class="menu-title" data-i18n="settings_items">Settings</span>
                    </a>
                    <ul class="menu-content">
                        <li><router-link :to="{ name:'users'}"><i></i><span class="menu-item" data-i18n="settings_items">Users</span></router-link></li>
                        <li><router-link :to="{ name:'settings.roles'}"><i></i><span class="menu-item" data-i18n="settings_items">Roles</span></router-link></li>
                        <li><router-link :to="{ name:'settings.permissions'}"><i></i><span class="menu-item" data-i18n="settings_items">Permissions</span></router-link></li>
                        <li><router-link :to="{ name:'settings.options'}"><i></i><span class="menu-item" data-i18n="settings_items">Options</span></router-link></li>
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
            })
        })

        
    }
}
</script>