import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        csrf_token: '',
        user: false,
        userPermission: null,
        userPermissions: [],
        activeRoute:'',
        user_custom_notice:[],
    },
    getters: {
        getUserPermission(state) {
            return state.userPermission
        },
        getUserNotifications(state) {
            return state.user_custom_notice
        },
    },

    mutations: {
        setUpdateUser(state, data) {
            state.user = data
        },
        setUserPermission(state, data) {
            state.userPermission = data
        },
        SET_CSRfTOKEN(state, data) {
            state.csrf_token = data
        },
        SET_USER_PERMISSIONS(state, data){
            state.userPermissions = data
        },
        SET_CURRENT_ROUTE(state,data){
            state.activeRoute = data
        },
        SET_USER_DATA(state,data){
            state.user = data
        },
        SET_USER_NOTIFICATION(state,data){
            state.user_custom_notice = data
        },
        UPDATE_USER_NOTIFICATION(state,data){
            state.user_custom_notice = data
        }
    },

    actions: {
        updateCSRFTOKEN({ commit }, data) {
            commit('SET_CSRfTOKEN', data)
        },
        setUserPermissions({ commit }, data){
            commit( 'SET_USER_PERMISSIONS' ,data)
        },
        setCURRENTROUTE({ commit }, data){
            commit( 'SET_CURRENT_ROUTE',data)
        },
        setUserData({ commit }, data){
            commit( 'SET_USER_DATA',data)
        },
        setUserNotifications({ commit }, data){
            commit( 'SET_USER_NOTIFICATION',data)
        },
        updateUserNotification({ commit }, data){
            commit('UPDATE_USER_NOTIFICATION',data)
        }
    }


})
