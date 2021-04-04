import Vue from 'vue'

const state = {
    status: '',
    products: [],
    loading: false,
}

const getters = {
    getProducts: state => state.products,
    getProductLoading: state => state.loading
}

const actions = {

    productRequest: ({
        commit,
    }, name) => {
        commit('productRequest')
        axios.get(`/api/products?product_name=${name}`)
            .then((resp) => {
                commit('productSuccess', resp.data);
            })
            .catch((err) => {
                commit('productError');
            })
    }
}

const mutations = {
    productRequest: (state) => {
        state.status = 'carregando';
        state.loading = true
    },
    productSuccess: (state, resp) => {
        state.status = 'success';
        Vue.set(state, 'products', resp);
        state.loading = false
    },
    changePage:(state, page)=>{
        state.currentPage = page
    },
    productError: (state) => {
        state.status = 'error';
    }
}

export default {
    state,
    getters,
    actions,
    mutations,
}
