<template>
    <div class="container-fluid">
        <div class="px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <h3>{{ $t('messages.new_order') }}</h3>
        </div>
        <div class="card-deck mb-3 text-center">
            <div class="col-md-6">
                <div class="card mb-4 box-shadow">
                    <div class="card-header bg-primary text-white">
                        {{ $t('messages.select_pizzas') }}
                    </div>
                    <div class="card-body">
                        <form class="form-inline mb-3">
                            <input class="form-control col-md-5 ml-3 w-75" type="text" :placeholder="$t('messages.search')" aria-label="Search" v-model="searchTerm">
                            <a href="#" class="btn btn-outline-success">{{ $t('messages.new') }}</a>
                        </form>
                        <div class="pr-2" style="max-height: 300px; overflow-y: auto;">
                            <table class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th style="font-size: 0.9em;">{{ $t('messages.name') }}</th>
                                        <th style="font-size: 0.9em;">{{ $t('messages.base_price') }}</th>
                                        <th style="font-size: 0.9em;">{{ $t('messages.ingredients_price') }}</th>
                                        <th style="font-size: 0.9em;">{{ $t('messages.total') }}</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="combination in combinations" :key="combination.id">
                                        <td class="text-left" v-text="combination.name"></td>
                                        <td class="text-right" v-text="`$${combination.base_price}`"></td>
                                        <td class="text-right" v-text="`$${combination.ingredients_price}`"></td>
                                        <td class="text-right" v-text="`$${combination.total}`"></td>
                                        <td style="max-width: 80px;">
                                            <form @submit.prevent="addCombination(combination)">
                                                <div class="input-group input-group-sm">
                                                    <input type="number" class="form-control" min="1" max="50" v-model.number="combination.quantity" required>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-success btn-sm"><i class="fa fa-shopping-cart"></i></button>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4 box-shadow">
                    <div class="card-header bg-primary text-white">
                        {{ $t('messages.order_detail') }}
                    </div>
                    <div class="card-body">
                        <div class="mb-2">
                            <strong>{{ $t('messages.order_number') }}:</strong>&nbsp;
                            <span style="font-size: 0.9em;" v-text="orderNumber"></span>
                        </div>
                        <div class="pr-2" style="max-height: 300px; overflow-y: auto;">
                            <table class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th style="font-size: 0.9em;">{{ $t('messages.name') }}</th>
                                        <th style="font-size: 0.9em;">{{ $t('messages.price') }}</th>
                                        <th style="font-size: 0.9em;">{{ $t('messages.quantity') }}</th>
                                        <th style="font-size: 0.9em;">Subtotal</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(combination, i) in selectedCombinations" :key="combination.id">
                                        <td class="text-left" v-text="combination.name"></td>
                                        <td class="text-right" v-text="`$${combination.total}`"></td>
                                        <td class="text-right" v-text="combination.quantity"></td>
                                        <td class="text-right" v-text="`$${Number(combination.total * combination.quantity).toFixed(2)}`"></td>
                                        <td>
                                            <a href="#" class="btn btn-outline-danger btn-sm" @click.prevent="removeItem(i)"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-right">Total</td>
                                        <td class="text-right"><strong v-text="`$${orderTotal}`"></strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mx-auto">
                <a href="#" @click.prevent="saveOrder" class="btn btn-success">{{ $t('messages.save_order') }}</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                searchTerm: '', // Término de búsqueda
                combinations: [], // Elelementos encontrados
                selectedCombinations: [], // Elementos seleccionados para agregar
                orderNumber: 0, // Número de pedido
                tokenSource: null, // Permite detener peticiones con axios
            }
        },
        watch: {
            searchTerm(term) {
                this.tokenSource.cancel(); // Cancelar petición que se está ejecutando actualmente
                this.createCancelToken(); // Crear nuevo token
                this.searchCombinations(); // Nueva petición
            },
        },
        computed: {
            orderTotal(){ // Devuelve el total del pedido según los elementos agregados
                let total = 0;

                this.selectedCombinations.forEach(el => total += el.total * el.quantity);

                return total.toFixed(2);
            }
        },
        methods: {
            translate(key){ // Equivalente a $t en el template
                return Vue.i18n.translate(`messages.${key}`);
            },
            createCancelToken(){ // Crea token para poder cancelar la petición
                const CancelToken = axios.CancelToken;
                this.tokenSource = CancelToken.source();
            },
            loadOrderNumber(){
                let url = `last-order`;

                axios.get(url)
                .then(response => {
                    this.orderNumber = response.data.data.order_number + 1;
                })
                .catch(error => {
                    Vue.$toast.error(`Error: ${error}`, { position: 'top-right' });
                });
            },
            searchCombinations(){ // Busca combinaciones
                let url = `pizzas?q=${this.searchTerm}`;

                axios.get(url, {
                    cancelToken: this.tokenSource.token
                })
                .then(response => {
                    this.combinations = response.data.data;
                })
                .catch(error => {
                    if (axios.isCancel(error)){
                        console.log('Peticion cancelada: ', error.message);
                    }
                    else {
                        Vue.$toast.error(`Error: ${error}`, { position: 'top-right' });
                    }
                });
            },
            addCombination(combination){ // Agrega elementos al pedido
                let index = this.selectedCombinations.findIndex(el => el.id == combination.id); // Buscar el índice de la combinación

                // Sumar la cantidad si ya existe el elemento, sino, agregarlo al arreglo
                if (index >= 0) this.selectedCombinations[index].quantity += combination.quantity;
                // Vue.util.extend sirve para que los cambios que se hagan en el arreglo se actualicen en la vista
                else this.selectedCombinations.push(Vue.util.extend({}, combination));
            },
            removeItem(index) { // Quita un elemento de los seleccionados según el índice
               this.selectedCombinations.splice(index, 1)
            },
            saveOrderDetails(order, callback){ // Guarda los detalles del pedido y ejecuta un callback al haber finalizado
                let i = 0;
                this.selectedCombinations.forEach(el => {
                    let url = `orders/${order}/pizzas/${el.id}/order-details`;
                    axios.post(url, { pizza_quantity: el.quantity }) // Solamente se envia la cantidad como parámetro, lo demás va en la url
                    .then(() => {
                        if (this.selectedCombinations.length == ++i) callback(); // Si ya se terminaron todas las consultas
                    })
                    .catch(error => {
                        throw error;
                    });
                });
            },
            saveOrder(){ // Guarda el pedido
                let me = this;
                let url = `clients/${this.$userId}/orders`;

                try {
                    if (this.selectedCombinations.length <= 0) throw this.translate('add_pizzas_message')

                    axios.post(url)
                    .then(response => {
                        var order = response.data.data.id;
                        me.saveOrderDetails(order, function(){
                            Vue.$toast.success(me.translate('created_order'), { position: 'top-right' });
                            setTimeout(() => {
                                window.location = '/';
                            }, 1000);
                        })
                    })
                    .catch(error => {
                        throw error;
                    });
                } catch (error) {
                    Vue.$toast.error(`Error: ${error}`, { position: 'top-right' });
                    return;
                }

            }
        },
        mounted(){
            this.createCancelToken();
            this.loadOrderNumber();
            this.searchCombinations();
        }
    }
</script>
