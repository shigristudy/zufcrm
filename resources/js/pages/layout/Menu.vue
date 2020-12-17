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
                <li class="nav-item nav-toggle">
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
                    <router-link :to="{ name:'dashboard'}"><i class="feather icon-home"></i>
                        <span class="menu-title" data-i18n="Dashboard">Dashboard</span>
                    </router-link>
                </li>
                <li class=" nav-item" v-if="isPermitted('donations')">
                    <router-link :to="{ name:'donations'}"><i class="feather icon-plus-square"></i>
                        <span class="menu-title" data-i18n="Donation">Donations</span>
                    </router-link>
                </li>
                <li class=" nav-item" v-if="isPermitted('customproject')">
                    <router-link :to="{ name:'customproject'}"><i class="feather icon-plus-square"></i>
                        <span class="menu-title" data-i18n="Custom Project">Custom Project</span>
                    </router-link>
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
                    <router-link :to="{ name:'gift_aids'}"><i class="feather icon-home"></i>
                        <span class="menu-title">Gift Aid</span>
                    </router-link>
                </li>
                <li class=" nav-item" v-if="isPermitted('gift_aids_submitted')">
                    <router-link :to="{ name:'gift_aids_submitted'}"><i class="feather icon-home"></i>
                        <span class="menu-title">Giftaid Generated</span>
                    </router-link>
                </li>
                <li class=" nav-item" v-if="isPermitted('gift_aids_reports')">
                    <router-link :to="{ name:'gift_aids_reports'}"><i class="feather icon-home"></i>
                        <span class="menu-title">Giftaid Reports</span>
                    </router-link>
                </li>
                <li class=" nav-item" v-if="isPermitted('reports')">
                    <router-link :to="{ name:'users'}"><i class="feather icon-home"></i>
                        <span class="menu-title">Reporting</span>
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
        console.log('mounted')
        
    }
}
</script>