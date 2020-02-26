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
                            {{ $t('messages.usual_customers') }}
                            <small v-if="loadingUsualClients"><i class="fa fa-spinner fa-spin"></i></small>
                        </h5>
                    </div>
                    <div class="card-body-2">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{ $t('messages.name') }}</th>
                                    <th scope="col">{{ $t('messages.email') }}</th>
                                    <th scope="col">{{ $t('messages.orders_quantity') }}</th>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(client, i) in usualClients" :key="client.id">
                                    <th v-text="++i"></th>
                                    <td v-text="client.name"></td>
                                    <td v-text="client.email"></td>
                                    <td v-text="client.order_quantity"></td>
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
                            {{ $t('messages.money_spended_client') }}
                            <small v-if="loadingSpendedMoneyClients"><i class="fa fa-spinner fa-spin"></i></small>
                        </h5>
                    </div>
                    <div class="card-body-2">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{ $t('messages.name') }}</th>
                                    <th scope="col">{{ $t('messages.email') }}</th>
                                    <th scope="col">{{ $t('messages.spended_money') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(client, i) in spendedMoneyClients" :key="client.id">
                                    <th v-text="++i"></th>
                                    <td v-text="client.name"></td>
                                    <td v-text="client.email"></td>
                                    <td v-text="`$${client.total_spended}`"></td>
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
                            {{ $t('messages.most_popular_ingredients') }}
                            <small v-if="loadingPopularIngredients"><i class="fa fa-spinner fa-spin"></i></small>
                        </h5>
                    </div>
                    <div class="card-body-2">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{ $t('messages.name') }}</th>
                                    <th scope="col">{{ $t('messages.times_used') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(ingredient, i) in popularIngredients" :key="ingredient.id">
                                    <th v-text="++i"></th>
                                    <td v-text="ingredient.name"></td>
                                    <td v-text="ingredient.pizza_count"></td>
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
                usualClients: [], // Clientes frecuentes
                loadingUsualClients: false,

                spendedMoneyClients: [], // Clientes que han gastado más dinero
                loadingSpendedMoneyClients: false,

                popularIngredients: [], // Ingredientes populares (se eligen 5)
                loadingPopularIngredients: false,

                branchOffices: [], // Sucursales
                loadingBranchOffices: false
            }
        },
        methods: {
            translate(key){ // Equivalente a $t en el template
                return Vue.i18n.translate(`messages.${key}`);
            },
            getUsualClients(){ // Obtener clientes frecuentes
                let url = `clients/usual`;

                this.loadingUsualClients = true;
                axios.get(url)
                .then(response => {
                    this.usualClients = response.data.data;
                })
                .catch(error => {
                    Vue.$toast.error(`Error: ${error}`, { position: 'top-right' });
                })
                .finally(() => {
                    this.loadingUsualClients = false;
                });
            },
            getSpendedMoneyClients(){ // Obtener clientes según dinero gastado
                let url = `clients/spended`;

                this.loadingSpendedMoneyClients = true;
                axios.get(url)
                .then(response => {
                    this.spendedMoneyClients = response.data.data;
                })
                .catch(error => {
                    Vue.$toast.error(`Error: ${error}`, { position: 'top-right' });
                })
                .finally(() => {
                    this.loadingSpendedMoneyClients = false;
                });
            },
            getPopularIngredients(){ // Obtener ingredientes más populares
                let url = `ingredients/popular`;

                this.loadingPopularIngredients = true;
                axios.get(url)
                .then(response => {
                    this.popularIngredients = response.data.data;
                })
                .catch(error => {
                    Vue.$toast.error(`Error: ${error}`, { position: 'top-right' });
                })
                .finally(() => {
                    this.loadingPopularIngredients = false;
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
        },
        mounted(){
            this.getUsualClients();
            this.getSpendedMoneyClients();
            this.getPopularIngredients();
            this.getBranchOffices();
        }
    }
</script>
