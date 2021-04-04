import Vue from 'vue'

const state = {
    status: '',
    sales: [],
    loading: false,
}

const getters = {
    getSales: state => state.sales,
    getLoading: state => state.loading
}

const actions = {

    saleRequest: ({
        commit,
    }, params) => {
        commit('saleRequest')
        axios.get(`/api/sales?${params}`)
            .then((resp) => {
                commit('saleSuccess', resp.data);
            })
            .catch((err) => {
                commit('saleError');
            })
    }
    
}

const mutations = {
    saleRequest: (state) => {
        state.status = 'carregando';
        state.loading = true
    },
    saleSuccess: (state, resp) => {
        state.status = 'success';
        Vue.set(state, 'sales', resp);
        state.loading = false
    },
    changePage:(state, page)=>{
        state.currentPage = page
    },
    saleError: (state) => {
        state.status = 'error';
    }
}

export default {
    state,
    getters,
    actions,
    mutations,
}
