<template>
            <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Detalhes da Venda: {{detail.id}}</p>
                <button class="delete " aria-label="close" @click="$parent.close()"></button>
            </header>
            <section class="modal-card-body">
                <div class="row">
                    <nav class="level">
                        <div class="level-item has-text-centered">
                            <div>
                            <p class="heading">Data</p>
                            <p class="title">{{new Date(detail.purchase_at).toLocaleDateString()}}</p>
                            </div>
                        </div>
                        <div class="level-item has-text-centered">
                            <div>
                            <p class="heading">Total</p>
                            <p class="title">{{detail.amount | currency}}</p>
                            </div>
                        </div>
                        <div class="level-item has-text-centered">
                            <div>
                            <p class="heading">Entrega</p>
                            <p class="title">{{detail.delivery_days}} dias</p>
                            </div>
                        </div>
                    </nav>
                    <hr class="is-medium">
                </div>
                <div class="row">
                    <p class="title is-4">Itens da Compra</p>
                    <b-table :data="detail.products">
                        <template slot-scope="props">
                            <b-table-column field="id" label="ID">
                                {{ props.row.pivot.product_id }}
                            </b-table-column>
                            <b-table-column field="name" label="Descrição">
                                {{props.row.name}}
                            </b-table-column>
                            <b-table-column field="price" label="Preço Unitário">
                                {{ props.row.pivot.price | currency}}
                            </b-table-column>
                            <b-table-column field="quantity" label="Quantidade">
                                {{ props.row.pivot.quantity }}
                            </b-table-column>
                            <b-table-column field="amount" label="Total">
                                {{ props.row.pivot.amount | currency}}
                            </b-table-column>
                        </template>
                    </b-table>
                </div>
            </section>
            <footer class="modal-card-foot">
                <button class="button" @click="$parent.close()">Fechar</button>
            </footer>
        </div>
</template>
<script>
export default {
    name: 'ShowSale',
    props:{
        detail:{}
    },
     data() {
            return {
                columns: [
                    {
                        field: 'pivot.product_id',
                        label: 'ID',
                        width: '40',
                        numeric: true
                    },
                    {
                        field: 'name',
                        label: 'Produto',
                    },
                    {
                        field: 'pivot.price',
                        label: 'Preço unitário',
                    },
                    {
                        field: 'pivot.quantity',
                        label: 'Quantidade',
                        centered: true
                    },
                    {
                        field: 'pivot.amount',
                        label: 'Preço Total',
                        numeric: true
                    }
                ]
            }
        }
}
</script>
