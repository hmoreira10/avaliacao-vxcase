<template>
    <div>
        <b-modal :active.sync="isComponentModalActive" has-modal-card full-screen :can-cancel="false">
            <show-sale :detail="itemProps" v-if="itemProps !== null"></show-sale>
        </b-modal>
       <section class="hero">
            <!-- if exists sales -->
            <div class="hero-body" v-if="isEmpty === false">
                <b-field grouped group-multiline>
                    <b-select v-model="perPage" @change.native="loadAsyncData()">
                        <option value="5">5 por página</option>
                        <option value="10">10 por página</option>
                        <option value="15">15 por página</option>
                        <option value="20">20 por página</option>
                    </b-select>

                </b-field>


                <b-table :data="data.data" :loading="loading" backend-pagination pagination-simple paginated
                    :total="data.total" :per-page="data.per_page" @page-change="onPageChange" aria-next-label="Next page"
                    aria-previous-label="Previous page" aria-page-label="Page" aria-current-label="Current page"
                    detail-key="name">

                    <template slot-scope="props">
                        <b-table-column field="id" label="ID">
                            {{ props.row.id }}
                        </b-table-column>
                        <b-table-column field="purchase_at" label="Data da Compra">
                            {{ new Date(props.row.purchase_at).toLocaleDateString() }}
                        </b-table-column>
                        <b-table-column field="amount" label="Valor da Venda">
                            {{ props.row.amount | currency }}
                        </b-table-column>
                        <b-table-column field="total_items" label="Total de Items">
                            {{ props.row.products.length }}
                        </b-table-column>
                        <b-table-column field="delivery_days" label="Previsão de Entrega">
                            {{ props.row.delivery_days }} dias
                        </b-table-column>
                        <b-table-column label="Ações">
                            <button @click="openModal(props.index)" type="button" class="button is-primary is-outlined">
                                Ver Mais</button>
                        </b-table-column>
                    </template>
                </b-table>
            </div>
            <!-- if not exists sales -->
            <div class="hero-body" v-if="isEmpty === true">                
                <div class="container has-text-centered">
                    <h1 class="title">
                        Nenhum venda realizada.
                    </h1>
                    <h2 class="subtitle">
                        Começe a lançar suas vendas.
                    </h2>
                </div>
            </div>
       </section>
    </div>
</template>

<script>
    import ShowSale from './ShowSale'
    export default {
        name: 'ListSales',
        components:{
            ShowSale
        },
        data() {
            return {
                isEmpty: true,
                perPage: 10,
                isComponentModalActive: false,
                itemProps: null
            }
        },
        computed:{
            data() {
                return this.$store.getters.getSales;
            },
            loading(){
                return this.$store.getters.getLoading
            }
        },
        methods: {
            openModal(item) {
                let obj = this.data.data[item];
                this.itemProps = Object.assign(obj)
                this.isComponentModalActive = true
            },
            /*
             * Load async data
             */
            loadAsyncData() {
                const params = [
                    `per_page=${this.perPage}`,
                    `page=${this.page}`
                ].join('&')
                this.$store.dispatch('saleRequest', params)
                    .then(() => {
                        this.isEmpty = false
                    })
                    .catch((error) => {
                        this.$toast.open({
                            duration: 5000,
                            message: 'Não foi posível carregar as vendas!',
                            position: 'is-bottom',
                            type: 'is-danger'
                        })
                    })
            },
            /*
             * Handle page-change event
             */
            onPageChange(page) {
                this.page = page
                this.loadAsyncData()
            },
        },
        filters: {
            /**
             * Filter to truncate string, accepts a length parameter
             */
            truncate(value, length) {
                return value.length > length
                    ? value.substr(0, length) + '...'
                    : value
            }
        },
        mounted() {
            this.loadAsyncData()
        }
    }
</script>
