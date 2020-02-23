<template>
    <div class="container">
        <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <!-- <h1 class="display-4">{{ $t('messages.title') }}</h1> -->
            <p class="lead">{{ $t('messages.client_message') }}</p>
            <button type="button" class="btn btn-lg btn-block btn-primary">{{ $t('messages.new_order') }}</button>
        </div>
        <div class="card-deck mb-3 text-center">
            <div class="col-sm-6">
                <div class="card mb-4 box-shadow">
                    <div class="card-header">
                        <h5 class="my-0 font-weight-normal">{{ $t('messages.client_orders') }}</h5>
                    </div>
                    <div class="card-body">
                        <!-- <h1 class="card-title pricing-card-title"><span v-text="`0`"></span></h1>
                        <button type="button" class="btn btn-lg btn-block btn-outline-primary">Sign up for free</button> -->
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card mb-4 box-shadow">
                    <div class="card-header">
                        <h5 class="my-0 font-weight-normal">{{ $t('messages.preset_combinations') }}</h5>
                    </div>
                    <div class="card-body">
                        <!-- <h1 class="card-title pricing-card-title">0</h1>
                        <button type="button" class="btn btn-lg btn-block btn-primary">Get started</button> -->
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card mb-4 box-shadow">
                    <div class="card-header">
                        <h5 class="my-0 font-weight-normal">{{ $t('messages.aviable_ingredients') }}</h5>
                    </div>
                    <div class="card-body">
                        <!-- <h1 class="card-title pricing-card-title">0</h1>
                        <button type="button" class="btn btn-lg btn-block btn-primary">Contact us</button> -->
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card mb-4 box-shadow">
                    <div class="card-header">
                        <h5 class="my-0 font-weight-normal">{{ $t('messages.offices') }}</h5>
                    </div>
                    <div class="card-body">
                        <!-- <h1 class="card-title pricing-card-title">0</h1>
                        <button type="button" class="btn btn-lg btn-block btn-primary">Contact us</button> -->
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
                branchOffices: []
            }
        },
        methods: {
            getOrderHistory(){

            },
            getPresetCombinations(){

            },
            getAviableIngredients(){

            },
            getBranchOffices(){

            }
        },
        mounted() {

        }
    }
</script>
