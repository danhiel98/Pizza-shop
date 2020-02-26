<template>
    <div class="container-fluid">
        <div class="px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <h3>{{ $t('messages.welcome_message') }}</h3>
        </div>
        <div class="card-deck mb-3 text-center">
            <div class="col-sm-6">
                <div class="card mb-4 box-shadow">
                    <div class="card-header bg-primary text-white">
                        <h5 class="my-0 font-weight-normal">
                            {{ $t('messages.frequent_clients') }}
                            <!-- <small v-if="loadingOrderHistory"><i class="fa fa-spinner fa-spin"></i></small> -->
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
                                <!-- <tr v-for="order in orderHistory" :key="order.id">
                                    <th v-text="order.order_number"></th>
                                    <td v-text="order.date"></td>
                                    <td v-text="order.pizza_quantity"></td>
                                    <td v-text="`$${order.total}`"></td>
                                    <td>
                                        <a href="#" class="btn btn-default btn-sm" @click.prevent="showOrderDetails(order)"><i class="fa fa-eye"></i></a>
                                    </td>
                                </tr> -->
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
                            <!-- <small v-if="loadingPresetCombinations"><i class="fa fa-spinner fa-spin"></i></small> -->
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
                                <!-- <tr v-for="(combination, i) in presetCombinations" :key="combination.id">
                                    <th v-text="++i"></th>
                                    <td v-text="combination.name"></td>
                                    <td v-text="`$${combination.base_price}`"></td>
                                    <td v-text="`$${combination.ingredients_price}`"></td>
                                    <td v-text="`$${combination.total}`"></td>
                                    <td>
                                        <a href="#" class="btn btn-default btn-sm" @click.prevent="showCombinationDetails(combination)"><i class="fa fa-eye"></i></a>
                                    </td>
                                </tr> -->
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
                            <!-- <small v-if="loadingAviableIngredients"><i class="fa fa-spinner fa-spin"></i></small> -->
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
                                <!-- <tr v-for="(ingredient, i) in aviableIngredients" :key="ingredient.id">
                                    <th v-text="++i"></th>
                                    <td v-text="ingredient.name"></td>
                                    <td v-text="`$${ingredient.price}`"></td>
                                </tr> -->
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
                            <!-- <small v-if="loadingBranchOffices"><i class="fa fa-spinner fa-spin"></i></small> -->
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
                                <!-- <tr v-for="(office, i) in branchOffices" :key="office.id">
                                    <th v-text="++i"></th>
                                    <td v-text="office.name"></td>
                                    <td v-text="office.address"></td>
                                </tr> -->
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

            }
        },
        methods: {

        },
        mounted(){

        }
    }
</script>
