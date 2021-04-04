<template>
    <section class="container">
            <b-field label="Data da Compra">
                <b-datepicker
                    v-model="sale.purchase_at"
                    placeholder="Selecione uma data..."
                    icon="calendar-today"
                    :max-date="maxDate"
                    editable>
                <button class="button is-primary"
                    @click="sale.purchase_at = new Date()">
                    <b-icon icon="calendar-today"></b-icon>
                    <span>Hoje</span>
                </button>
                <button class="button is-danger"
                    @click="sale.purchase_at = null">
                    <b-icon icon="close"></b-icon>
                    <span>Limpar</span>
                </button>
                </b-datepicker>
            </b-field>
           
            <b-field label="Encontre um Produto" expanded>
                    <!-- field product -->
                    <b-autocomplete
                        :data="async_products"
                        placeholder="Ex.: VX"
                        field="title"
                        :loading="isFetching"
                        @typing="getAsyncData"
                        icon="magnify"
                        @select="selectProduct($event)">

                        <template slot-scope="props">
                            <div class="media">                       
                                <div class="media-content">
                                    <b>{{ props.option.name }}</b>
                                    <br>
                                    <small>
                                        ID: <b>{{props.option.id}}</b>,
                                        Referência: <b>{{props.option.reference}}</b>,
                                        Preço: <b>{{ props.option.price }}</b>,
                                        Entrega <b>{{ props.option.delivery_days }} dias</b>
                                    </small>
                                </div>
                            </div>
                        </template>
                    </b-autocomplete>
                </b-field>
                 <!-- show the selected product -->
                <div class="row" v-if="isSelected">
                    <p class="content"><b>Produto selecionado:</b>
                        <small>
                            ID: <b>{{selected.id}}</b>,
                            Nome: <b>{{selected.name}}</b>,
                            Referência: <b>{{selected.reference}}</b>,
                            Preço: <b>{{ selected.price }}</b>,
                            Entrega em: <b>{{ selected.delivery_days }} dias</b>
                        </small>
                    </p>
                </div>
                <hr class="is-medium">
                <b-field grouped group-multiline>
                    <b-field label="ID" >
                        <b-input v-model="product.product_id" disabled></b-input>
                    </b-field>
                    <b-field label="Nome" >
                        <b-input v-model="product.name" disabled></b-input>
                    </b-field>
                    <b-field label="Quantidades">
                    <b-numberinput 
                        min="1" 
                        v-model="product.quantity" 
                        controls-position="compact" 
                        controls-rounded>
                    </b-numberinput>
                    </b-field>
                    <b-field label="Preco Unitário" >
                        <b-input v-model="product.price" disabled></b-input>
                    </b-field>
                    <b-field label="Preço Total" >
                        <p class="subtile">{{totalPrice | currency}}</p>
                    </b-field>                        
                </b-field>
                <p class="control">
                    <button class="button is-primary" @click="addProduct" :disabled="!isSelected">Adcionar Produto</button>
                </p>
                <!-- list of added products -->
                <section class="hero">
                    
                    <div class="hero-body">
                        <b-table :data="sale.products">
                        <template slot-scope="props">
                            <b-table-column field="product_id" label="ID">
                                {{ props.row.product_id }}
                            </b-table-column>
                            <b-table-column field="name" label="Descrição">
                                {{props.row.name}}
                            </b-table-column>
                            <b-table-column field="quantity" label="Quantidade">
                                {{ props.row.quantity }}
                            </b-table-column>
                            <b-table-column field="amount" label="Total">
                                {{ props.row.amount | currency}}
                            </b-table-column>
                            <b-table-column field="delivery_days" label="Previsão de Entrega">
                                {{ props.row.delivery_days }} dias
                            </b-table-column>
                            <b-table-column label="Ações">
                                <b-button type="is-danger" @click="removeProduct(props.index)"
                                    icon-left="delete">
                                    Delete
                                </b-button>
                            </b-table-column>
                        </template>
                    </b-table>
                    </div>
                </section> 
                
                
                <nav class="level">
                <!-- Left side -->
                <div class="level-left">
                    <div class="level-item">
                        <div v-if="finishing !== false">
                            <b-button loading>Loading</b-button>
                        </div>
                        <div v-else>
                            <button :disabled="!sale.products.length" class="button is-primary" @click="finishSale">Finalizar Venda</button>
                        </div>
                    </div>
                </div>

                <!-- Right side -->
                <div class="level-right">
                    <div class="level-item has-text-centered">
                        <div>
                            <p class="heading">Total</p>
                            <p class="title">{{totalSale | currency}}</p>
                        </div>
                    </div>
                </div>
                </nav>
    </section>

</template>

<script>
    import debounce from 'lodash/debounce'
import { log } from 'util';
    export default {
        name:'CreateSale',
        data() {
            return {
                sale:{
                    purchase_at: new Date(),
                    amount: 0,
                    delivery_days: 0,
                    products:[]
                },
                product:{
                    product_id: null,
                    name: null,
                    quantity:1,
                    price:0,
                    amount:0
                },
                selected: {},
                isSelected: false,
                isFetching: false,
                finishing: false,
                maxDate: new Date()
            }
        },
         computed: {
             async_products: function (){
                return this.$store.getters.getProducts;
             },
            //  return the calc of quantity and price of product
            totalPrice: function () {
                return this.product.price*this.product.quantity
            },
            // sum the amount of products
            totalSale: function () {
                var total = 0;
                for(var i=0;i < this.sale.products.length;i++) {
                    total += parseFloat(this.sale.products[i].amount);
                }
                return total

            },
            // get the bigger delivery time of products
            saleDeliveryDays: function(){
                let max = 0;
                this.sale.products.forEach(product => {
                    if (product.delivery_days > max) {
                        max = product.delivery_days;
                    }
                });
                return max                
            }
        },
        methods: {
            // Search the products
            getAsyncData: debounce(function (name) {
                if (!name.length) {
                    return
                }
                this.isFetching = true
                this.$store.dispatch('productRequest', name)
                    .then(() => {
                        
                    })
                    .catch((error) => {
                        this.$toast.open({
                            duration: 5000,
                            message: 'Erro ao consultar produto',
                            position: 'is-bottom',
                            type: 'is-danger'
                        })
                    })
                    .finally(() => {
                        this.isFetching = false
                    })
            }, 500),
            // Select Product from asyncData
            selectProduct(item){
                this.product.price = item.price;
                this.product.name = item.name;
                this.product.product_id = item.id;
                this.product.delivery_days = item.delivery_days
                this.selected = item
                this.isSelected = true
            },
            addProduct(){
                this.product.amount = this.totalPrice
                this.product.delivery_days = this.selected.delivery_days
                this.sale.products.push(Object.assign({}, this.product))
                
                // reseting
                this.product = {
                    product_id: null,
                    name: null,
                    quantity:1,
                    price:0,
                    amount:0
                }
                this.selected = null
                this.isSelected = false          
            },
            removeProduct(index) {
                this.$snackbar.open({
                    message: 'O item sera excluído da lista.',
                    type: 'is-warning',
                    position: 'is-top',
                    actionText: 'Ok',
                    indefinite: true,
                    onAction: () => {
                        this.$delete(this.sale.products, index)               
                        this.$toast.open({
                            message: 'Item excluido',
                            queue: false
                        })
                    }
                })
            },
            
            finishSuccess(msg) {
                this.$toast.open({
                    message: msg,
                    type: 'is-success'
                })
            },
            finishSale(){
                this.sale.amount= this.totalSale
                this.sale.delivery_days = this.saleDeliveryDays
                // delete the fields that is not necessary
                 this.sale.products.forEach(product => {
                    delete product.name;
                    delete product.delivery_days;
                });
                this.finishing = true
                axios.post(`/api/sales`, this.sale)
                    .then(({ data }) => {
                        this.finishing=false
                        this.finishSuccess(data.message)
                        this.$router.push('/')
                    })
                    .catch((error) => {      
                        this.finishing=false
                        this.$toast.open({
                            duration: 5000,
                            message: 'Erro ao finalizar a venda',
                            position: 'is-bottom',
                            type: 'is-danger'
                        })
      
                    })
            }
        },

    }
</script>
