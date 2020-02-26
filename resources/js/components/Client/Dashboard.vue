<template>
    <div class="container-fluid">
        <div class="px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <p class="lead">{{ $t('messages.client_message') }}</p>
            <div class="d-flex justify-content-center bd-highlight mb-3">
                <a href="new-order" class="btn btn-lg btn-block btn-success col-md-2">{{ $t('messages.new_order') }}</a>
            </div>
        </div>
        <div class="card-deck mb-3 text-center">
            <div class="col-sm-6">
                <div class="card mb-4 box-shadow">
                    <div class="card-header bg-primary text-white">
                        <h5 class="my-0 font-weight-normal">
                            {{ $t('messages.client_orders') }}
                            <small v-if="loadingOrderHistory"><i class="fa fa-spinner fa-spin"></i></small>
                        </h5>
                    </div>
                    <div class="card-body-2">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">{{ $t('messages.order_number') }}</th>
                                    <th scope="col">{{ $t('messages.date') }}</th>
                                    <th scope="col">{{ $t('messages.pizza_quantity') }}</th>
                                    <th scope="col">{{ $t('messages.total') }}</th>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="order in orderHistory" :key="order.id">
                                    <th v-text="order.order_number"></th>
                                    <td v-text="order.date"></td>
                                    <td v-text="order.pizza_quantity"></td>
                                    <td v-text="`$${order.total}`"></td>
                                    <td>
                                        <a href="#" class="btn btn-default btn-sm" @click.prevent="showOrderDetails(order)"><i class="fa fa-eye"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card mb-4 box-shadow">
                    <div class="card-header bg-primary text-white">
                        <h5 class="my-0 font-weight-normal">
                            {{ $t('messages.preset_combinations') }}
                            <small v-if="loadingPresetCombinations"><i class="fa fa-spinner fa-spin"></i></small>
                        </h5>
                    </div>
                    <div class="card-body-2">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{ $t('messages.name') }}</th>
                                    <th scope="col">{{ $t('messages.base_price') }}</th>
                                    <th scope="col">{{ $t('messages.ingredients_price') }}</th>
                                    <th scope="col">{{ $t('messages.total') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(combination, i) in presetCombinations" :key="combination.id">
                                    <th v-text="++i"></th>
                                    <td v-text="combination.name"></td>
                                    <td v-text="`$${combination.base_price}`"></td>
                                    <td v-text="`$${combination.ingredients_price}`"></td>
                                    <td v-text="`$${combination.total}`"></td>
                                    <td>
                                        <a href="#" class="btn btn-default btn-sm" @click.prevent="showCombinationDetails(combination)"><i class="fa fa-eye"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card mb-4 box-shadow">
                    <div class="card-header bg-primary text-white">
                        <h5 class="my-0 font-weight-normal">
                            {{ $t('messages.aviable_ingredients') }}
                            <small v-if="loadingAviableIngredients"><i class="fa fa-spinner fa-spin"></i></small>
                        </h5>
                    </div>
                    <div class="card-body-2">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{ $t('messages.name') }}</th>
                                    <th scope="col">{{ $t('messages.price') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(ingredient, i) in aviableIngredients" :key="ingredient.id">
                                    <th v-text="++i"></th>
                                    <td v-text="ingredient.name"></td>
                                    <td v-text="`$${ingredient.price}`"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card mb-4 box-shadow">
                    <div class="card-header bg-primary text-white">
                        <h5 class="my-0 font-weight-normal">
                            {{ $t('messages.offices') }}
                            <small v-if="loadingBranchOffices"><i class="fa fa-spinner fa-spin"></i></small>
                        </h5>
                    </div>
                    <div class="card-body-2">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{ $t('messages.name') }}</th>
                                    <th scope="col">{{ $t('messages.address') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(office, i) in branchOffices" :key="office.id">
                                    <th v-text="++i"></th>
                                    <td v-text="office.name"></td>
                                    <td v-text="office.address"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <stack-modal
            :show="orderDetailModal"
            :title="`${translate('order_detail')} #${activeOrder ? activeOrder.order_number : ''}`"
            @close="closeOrderDetailModal"
        >
            <div class="container">
                <div class="row" v-if="activeOrder">
                    <div class="col-md-4">
                        <strong>{{ $t('messages.date') }}:</strong>&nbsp;
                        <span style="font-size: 0.9em;" v-text="activeOrder.date"></span>
                    </div>
                    <div class="col-md-4">
                        <strong>{{ $t('messages.pizza_quantity') }}:</strong>&nbsp;
                        <span v-text="activeOrder.pizza_quantity"></span>
                    </div>
                    <div class="col-md-4">
                        <strong>{{ $t('messages.total') }}:</strong>&nbsp;
                        <span v-text="`$${activeOrder.total}`"></span>
                    </div>
                    <div class="col-md-12">
                        <strong class="d-flex justify-content-center">{{ $t('messages.details') }}:</strong>
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">{{ $t('messages.pizza_name') }}</th>
                                    <th class="text-center">{{ $t('messages.quantity') }}</th>
                                    <th class="text-center">{{ $t('messages.price') }}</th>
                                    <th class="text-center">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(detail, i) in activeOrderDetails" :key="detail.id">
                                    <th v-text="++i"></th>
                                    <td style="cursor: pointer;" @click.prevent="showCombinationDetails(detail.pizza)" v-text="detail.pizza.name"></td>
                                    <td class="text-center" v-text="detail.pizza_quantity"></td>
                                    <td class="text-center" v-text="`$${detail.pizza_price}`"></td>
                                    <td class="text-center" v-text="`$${detail.total}`"></td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-right">Total</td>
                                    <td v-text="`$${orderTotal}`"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div slot="modal-footer" class="modal-footer">
                <a href="#" @click.prevent="closeOrderDetailModal" class="btn btn-outline-secondary">{{ translate('close') }}</a>
            </div>
        </stack-modal>
        <stack-modal
            :show="combinationDetailModal"
            :title="`${translate('combination_detail')}`"
            @close="closeCombinationDetailModal"
        >
            <div class="container">
                <div class="row" v-if="activeCombination">
                    <div class="col-md-12">
                        <strong>{{ $t('messages.name') }}:</strong>&nbsp;
                        <span v-text="activeCombination.name"></span>
                    </div>
                    <div class="col-md-4">
                        <strong>{{ $t('messages.base_price') }}:</strong>&nbsp;
                        <span v-text="`$${activeCombination.base_price}`"></span>
                    </div>
                    <div class="col-md-5">
                        <strong>{{ $t('messages.ingredients_price') }}:</strong>&nbsp;
                        <span v-text="`$${activeCombination.ingredients_price}`"></span>
                    </div>
                    <div class="col-md-3">
                        <strong>{{ $t('messages.total') }}:</strong>&nbsp;
                        <span v-text="`$${activeCombination.total}`"></span>
                    </div>
                    <div class="col-md-12">
                        <strong class="d-flex justify-content-center">{{ $t('messages.ingredients') }}:</strong>
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">{{ $t('messages.ingredient') }}</th>
                                    <th class="text-center">{{ $t('messages.quantity') }}</th>
                                    <th class="text-center">{{ $t('messages.price') }}</th>
                                    <th class="text-center">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(detail, i) in activeCombinationDetails" :key="detail.id">
                                    <td v-text="++i"></td>
                                    <td v-text="detail.ingredient.name"></td>
                                    <td class="text-center" v-text="detail.ingredient_quantity"></td>
                                    <td class="text-center" v-text="`$${detail.ingredient_price}`"></td>
                                    <td class="text-center" v-text="`$${detail.total}`"></td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-right">Total:</td>
                                    <td class="text-center" v-text="`$${combinationTotal}`"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div slot="modal-footer" class="modal-footer">
                <a href="#" @click.prevent="closeCombinationDetailModal" class="btn btn-outline-secondary">{{ translate('close') }}</a>
            </div>
        </stack-modal>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                orderHistory: [],
                loadingOrderHistory: false,

                presetCombinations: [],
                loadingPresetCombinations: false,

                aviableIngredients: [],
                loadingAviableIngredients: false,

                branchOffices: [],
                loadingBranchOffices: false,

                activeOrder: null, // Pedido a mostrar
                activeOrderDetails: [],
                orderDetailModal: false, // Modal para ver el detalle del pedido

                activeCombination: null, // Combinación personalizada a mostrar
                activeCombinationDetails: [],
                combinationDetailModal: false, // Modal para ver el detalle de la combinación
            }
        },
        computed: {
            orderTotal(){ // Genera el total del pedido
                let total = 0;
                this.activeOrderDetails.forEach(el => total += el.total);

                return total;
            },
            combinationTotal(){ // Genera el total de la combinación
                let total = 0;
                this.activeCombinationDetails.forEach(el => total += el.total);

                return total;
            }
        },
        methods: {
            translate(key){ // Equivalente a $t en el template
                return Vue.i18n.translate(`messages.${key}`);
            },
            getOrderHistory(){ // Obtener historial de pedidos
                let me = this;
                let url = `clients/${this.$userId}/orders`;

                me.loadingOrderHistory = true;
                axios.get(url)
                .then(response => {
                    me.orderHistory = response.data.data; // Asignar el resultado en la variable de vue
                })
                .catch(error => {
                    Vue.$toast.error(`Error: ${error}`, { position: 'top-right' });
                })
                .finally(() => {
                    me.loadingOrderHistory = false;
                });
            },
            getPresetCombinations(){ // Obtener combinaciones preestablecidas
                let me = this;
                let url = `pizzas`;

                me.loadingPresetCombinations = true;
                axios.get(url)
                .then(response => {
                    me.presetCombinations = response.data.data;
                })
                .catch(error => {
                    Vue.$toast.error(`Error: ${error}`, { position: 'top-right' });
                })
                .finally(() => {
                    me.loadingPresetCombinations = false;
                });
            },
            getAviableIngredients(){ // Obtener ingredientes
                let me = this;
                let url = `ingredients`

                me.loadingAviableIngredients = true;
                axios.get(url)
                .then(response => {
                    me.aviableIngredients = response.data.data;
                })
                .catch(error => {
                    Vue.$toast.error(`Error: ${error}`, { position: 'top-right' });
                })
                .finally(() => {
                    me.loadingAviableIngredients = false;
                });
            },
            getBranchOffices(){ // Obtener sucursales
                let me = this;
                let url = `branch-offices`

                me.loadingBranchOffices = true;
                axios.get(url)
                .then(response => {
                    me.branchOffices = response.data.data;
                })
                .catch(error => {
                    Vue.$toast.error(`Error: ${error}`, { position: 'top-right' });
                })
                .finally(() => {
                    me.loadingBranchOffices = false;
                });
            },
            getOrderDetails(order){ // Obtener el detalle de un pedido en específico
                let url = `orders/${order.id}/order-details`;

                return new Promise((resolve, reject) => {
                    axios.get(url)
                    .then(response => {
                        resolve(response.data.data);
                    })
                    .catch(error => {
                        reject(error);
                    });
                });
            },
            showOrderDetails(order){ // Mostrar el detalle del pedido
                this.activeOrder = order;
                this.orderDetailModal = true;
                this.activeOrderDetails = [];

                this.getOrderDetails(order)
                .then(details => {
                    this.activeOrderDetails = details;
                })
                .catch(error => {
                    Vue.$toast.error(`Error: ${error}`, { position: 'top-right' });
                });
            },
            closeOrderDetailModal(){ // Cierra los modales para ver detalles de los pedidos y restablece variables
                this.orderDetailModal = false;
                this.activeOrder = null;
                this.activeOrderDetails = [];
            },
            getCombinationDetails(combination){ // Obtener el detalle de una combinacioón en específico
                let url = `pizzas/${combination.id}/pizza-details`;

                return new Promise((resolve, reject) => {
                    axios.get(url)
                    .then(response => {
                        resolve(response.data.data);
                    })
                    .catch(error => {
                        reject(error);
                    });
                });
            },
            showCombinationDetails(combination){  // Muestra los detalles de las combinaciones
                this.activeCombination = combination;
                this.combinationDetailModal = true;
                this.activeCombinationDetails = [];

                this.getCombinationDetails(combination)
                .then(details => {
                    this.activeCombinationDetails = details;
                })
                .catch(error => {
                    Vue.$toast.error(`Error: ${error}`, { position: 'top-right' });
                });
            },
            closeCombinationDetailModal(){ // Cierra los modales para registro de combinaciones y limpia las variables
                this.combinationDetailModal = false;
                this.activeCombination = null;
                this.activeCombinationDetails = [];
            },
        },
        mounted() {
            this.getOrderHistory();
            this.getPresetCombinations();
            this.getAviableIngredients();
            this.getBranchOffices();
        }
    }
</script>
<style>
    .card-body-2 {
        max-height: 200px;
        overflow-y: auto;
    }
</style>
