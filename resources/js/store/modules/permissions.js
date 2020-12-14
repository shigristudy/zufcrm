import * as types from '../mutation-types'

// state
export const state = {
  userPermissions: [],
}

// getters
export const getters = {
    userPermissions: state => state.userPermissions,
}

// mutations
export const mutations = {
    [types.SET_PERMISSIONS] (state,  payload) {
        state.userPermissions = payload
    },
    [types.FETCH_USER_PERMISSIONS] (state,  payload) {
        state.userPermissions = payload
    },
}

// actions
export const actions = {
    setUserPermissions ({ commit }, payload) {
        commit(types.SET_PERMISSIONS,payload)
    },
    async fetchUserPermissions({ commit}){
        try {
            const { data } = await axios.get('/api/settings/permission/getUserPermissions')

            commit(types.FETCH_USER_PERMISSIONS, data )
        } catch (e) {
        }
    }
}
