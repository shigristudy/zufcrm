<template>
   <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top navbar-light navbar-shadow">
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                        <ul class="nav navbar-nav">
                            <li class="nav-item mobile-menu d-xl-none mr-auto">
                              <a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#">
                                <i @click="open" class="ficon feather icon-menu"></i>
                              </a>
                            </li>
                        </ul>
                    </div>
                    <ul class="nav navbar-nav float-right">
                        <!-- <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon feather icon-bell"></i><span class="badge badge-pill badge-primary badge-up">5</span></a>
                            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                                <li class="dropdown-menu-header">
                                    <div class="dropdown-header m-0 p-2">
                                        <h3 class="white">5 New</h3><span class="grey darken-2">App Notifications</span>
                                    </div>
                                </li>
                                <li class="scrollable-container media-list">
                                    <a class="d-flex justify-content-between" href="javascript:void(0)">
                                        <div class="media d-flex align-items-start">
                                            <div class="media-left"><i class="feather icon-plus-square font-medium-5 primary"></i></div>
                                            <div class="media-body">
                                                <h6 class="primary media-heading">You have new order!</h6><small class="notification-text"> Are your going to meet me tonight?</small>
                                            </div><small>
                                                <time class="media-meta" datetime="2015-06-11T18:29:20+08:00">9 hours ago</time></small>
                                        </div>
                                    </a>
                                </li>
                                <li class="dropdown-menu-footer"><a class="dropdown-item p-1 text-center" href="javascript:void(0)">Read all notifications</a></li>
                            </ul>
                        </li> -->
                        <li class="dropdown dropdown-user nav-item">
                            <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <div class="user-nav d-sm-flex d-none"><span class="user-name text-bold-600">{{ user.name}}</span>
                                    <span class="user-status">Online</span>
                                </div>
                                <span><img class="round" src="https://www.staging5.ziaulummahfoundation.org.uk/wp-content/uploads/2020/03/zuu-logo-green-100x100.png" alt="avatar" height="40" width="40"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                 <router-link class="dropdown-item" :to="{ name:'settings.profile' }"><i class="feather icon-user"></i>
                                    <span class="menu-title">Profile</span>
                                </router-link>
                                <router-link class="dropdown-item" :to="{ name:'settings.password' }"><i class="feather icon-lock"></i>
                                    <span class="menu-title">Change Password</span>
                                </router-link>
                                <!-- <a class="dropdown-item" href="#"><i class="feather icon-message-square"></i> Chats</a>-->
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" @click.prevent="logout">
                                    <i class="feather icon-power" fixed-width></i>
                                    {{ $t('logout') }}
                                </a>
                                <!-- <a class="dropdown-item" href="#"><i class="feather icon-power"></i> Logout</a> -->
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</template>
<script>
import { mapGetters } from 'vuex'
export default {
    data: () => ({
        appName: window.config.appName
    }),

    computed: mapGetters({
        user: 'auth/user'
    }),

    methods: {
        async logout () {
        // Log out the user.
        await this.$store.dispatch('auth/logout')

        // Redirect to login.
        this.$router.push({ name: 'login' })
        },
        open: function () {
            var $body = $("body");

            $body.removeClass("menu-hide menu-collapsed").addClass("menu-open");

            if ($body.hasClass("vertical-overlay-menu")) {
                $(".sidenav-overlay").removeClass("d-none").addClass("d-block");
                $("body").css("overflow", "hidden");
            }
            if (
                !$(".main-menu").hasClass("menu-native-scroll") &&
                $(".main-menu").hasClass("menu-fixed")
            ) {
                // this.manualScroller.enable();
                $(".main-menu-content").css(
                "height",
                $(window).height() -
                    $(".header-navbar").height() -
                    $(".main-menu-header").outerHeight() -
                    $(".main-menu-footer").outerHeight()
                );

                $(".main-menu").addClass("transformation");
                // this.manualScroller.update();
            }

            if (!$body.hasClass("vertical-overlay-menu")) {
                $(".sidenav-overlay").removeClass("d-block d-none");
                $("body").css("overflow", "auto");
            }
            },
    }
}
</script>
<style>
.transformation {
  transform: translate3d(260px, 0, 0) !important;
  opacity: 1 !important;
}
</style>
