<template>
    <div class="container-fluid">
        <div class="px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <!-- <h1 class="display-4">{{ $t('messages.title') }}</h1> -->
            <p class="lead">{{ $t('messages.client_message') }}</p>
            <div class="d-flex justify-content-center bd-highlight mb-3">
                <button type="button" class="btn btn-lg btn-block btn-success col-md-2">{{ $t('messages.new_order') }}</button>
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
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="order in orderHistory" :key="order.id">
                                    <th v-text="order.order_number"></th>
                                    <td v-text="order.date"></td>
                                    <td v-text="order.pizza_quantity"></td>
                                    <td v-text="`$${order.total}`"></td>
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
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(combination, i) in presetCombinations" :key="combination.id">
                                    <th v-text="++i"></th>
                                    <td v-text="combination.name"></td>
                                    <td v-text="`$${combination.base_price}`"></td>
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
    </div>
</template>

<script>
    export default {
        data() {
            return {
                orderHistory: [],
                presetCombinations: [],
                aviableIngredients: [],
                branchOffices: [],
                loadingOrderHistory: false,
                loadingPresetCombinations: false,
                loadingAviableIngredients: false,
                loadingBranchOffices: false,
            }
        },
        methods: {
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
            getOrderDetail(order){ // Obtener el detalle de un pedido en específico
                let me = this;
                let url = `orders/${this.order.id}`;

                axios.get(url)
                .then(response => {

                })
                .catch(error => {
                    Vue.$toast.error(`Error: ${error}`, { position: 'top-right' });
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
            }
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
