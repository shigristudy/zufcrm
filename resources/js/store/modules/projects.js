import axios from 'axios'
import * as types from '../mutation-types'

// state
export const state = {
  projects: [],
}

// getters
export const getters = {
    projects: state => state.projects,
}

// mutations
export const mutations = {
  [types.SET_PROJECTS] (state, { projects }) {
    state.projects = projects
  },
}

// actions
export const actions = {
   fetchProjects ({ commit }) {
    try {
        let wooProducts = []
        axios.get('https://www.ziaulummahfoundation.org.uk/wp-json/wc/v3/products?per_page=100',{
            auth: {
                username :'ck_4202435a3ffa2878c84d3064e2e5463f7a234589', 
                password :'cs_91b6f3fd2894b1a818f8c38e912ca56756b88ba6'
            }
        }).then(function (response) {
            response.data.map(p => {
                let project = {
                    id : p.id,
                    name : p.name,
                    type : p.type,
                    price : p.price,
                };
                if(p.type != 'grouped'){
                    wooProducts.push(project)
                }
            })
            
            commit(types.SET_PROJECTS, wooProducts)
        })
        

    } catch (e) {
      
    }
  },
}
