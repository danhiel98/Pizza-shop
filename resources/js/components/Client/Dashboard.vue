<template>
    <div class="container-fluid">
        <div class="px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <!-- <h1 class="display-4">{{ $t('messages.title') }}</h1> -->
            <p class="lead">{{ $t('messages.client_message') }}</p>
            <div class="d-flex justify-content-center bd-highlight mb-3">
                <button type="button" class="btn btn-lg btn-block btn-primary col-md-2">{{ $t('messages.new_order') }}</button>
            </div>
        </div>
        <div class="card-deck mb-3 text-center">
            <div class="col-sm-6">
                <div class="card mb-4 box-shadow">
                    <div class="card-header">
                        <h5 class="my-0 font-weight-normal">{{ $t('messages.client_orders') }}</h5>
                    </div>
                    <div class="card-body">
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
                    <div class="card-header">
                        <h5 class="my-0 font-weight-normal">{{ $t('messages.preset_combinations') }}</h5>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card mb-4 box-shadow">
                    <div class="card-header">
                        <h5 class="my-0 font-weight-normal">{{ $t('messages.aviable_ingredients') }}</h5>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card mb-4 box-shadow">
                    <div class="card-header">
                        <h5 class="my-0 font-weight-normal">{{ $t('messages.offices') }}</h5>
                    </div>
                    <div class="card-body">

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

            }
        },
        methods: {
            getOrderHistory(){
                let me = this;
                let url = `clients/${this.$userId}/orders`;
                Vue.$toast.success('message string', { position: 'top-right' });

                axios.get(url)
                .then(response => {
                    me.orderHistory = response.data.data;
                })
                .catch(error => {

                });
            },
            getPresetCombinations(){

            },
            getAviableIngredients(){

            },
            getBranchOffices(){

            }
        },
        mounted() {
            this.getOrderHistory();
        }
    }
</script>
<style>
    .card-body {
        max-height: 200px;
        overflow-y: auto;
    }
</style>
