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
                            <a href="#" @click.prevent="newCombinationModal = true" class="btn btn-outline-success">{{ $t('messages.new') }}</a>
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
                                            <a href="#" class="btn btn-outline-danger btn-sm" @click.prevent="quitCombination(i)"><i class="fa fa-trash"></i></a>
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
                <button ref="btnSaveOrder" @click.prevent="saveOrder" class="btn btn-success">{{ $t('messages.save_order') }}</button>
            </div>
        </div>

        <stack-modal
            :show="newCombinationModal"
            :title="`${translate('new_combination')}`"
            @close="closeNewCombinationModal"
        >
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <strong class="d-flex justify-content-center">{{ $t('messages.ingredients') }}:</strong>
                        <div class="pr-2" style="max-height: 200px; overflow-y: auto;">
                            <table class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>{{ $t('messages.name') }}</th>
                                        <th>{{ $t('messages.price') }}</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="ingredient in ingredients" :key="ingredient.id">
                                        <td v-text="ingredient.name"></td>
                                        <td v-text="`$${ingredient.price}`"></td>
                                        <td style="width: 90px !important;">
                                            <form @submit.prevent="addIngredient(ingredient)">
                                                <div class="input-group input-group-sm">
                                                    <input type="number" class="form-control" min="1" max="50" v-model.number="ingredient.quantity" required>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-success btn-sm"><i class="fa fa-plus"></i></button>
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
            <div slot="modal-footer" class="modal-footer">
                <a href="#" @click.prevent="showCombinationDetail" class="btn btn-primary">{{ $t('messages.view_detail') }} ({{ selectedIngredients.length }})</a>
            </div>
        </stack-modal>

        <stack-modal
            :show="combinationDetailModal"
            :title="`${translate('combination_detail')}`"
            @close="combinationDetailModal = false"
        >
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <strong>{{ $t('messages.base_price') }}:</strong>
                        <span v-text="`$${basePrice}`"></span>
                    </div>
                    <div class="col-md-8">
                        <strong>{{ $t('messages.ingredients_total') }}</strong>
                        <span v-text="`$${ingredientsTotal}`"></span>
                    </div>
                    <div class="col-md-12">
                        <strong>{{ $t('messages.combination_total') }}</strong>
                        <span v-text="`$${combinationTotal}`"></span>
                    </div>
                    <div class="col-md-12 form-inline mb-3">
                        <label for="combinationName"><strong>{{ $t('messages.combination_name') }}</strong></label>
                        <input type="text" id="combinationName" class="form-control col-md-6 form-control-sm mx-sm-3" v-model="combinationName">
                    </div>
                    <div class="col-md-12 pr-2" style="max-height: 200px; overflow-y: auto;">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>{{ $t('messages.name') }}</th>
                                    <th>{{ $t('messages.price') }}</th>
                                    <th>{{ $t('messages.quantity') }}</th>
                                    <th>Subtotal</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(ingredient, i) in selectedIngredients" :key="ingredient.id">
                                    <td v-text="ingredient.name"></td>
                                    <td v-text="`$${ingredient.price}`"></td>
                                    <td class="text-right" v-text="`${ingredient.quantity}`"></td>
                                    <td v-text="`$${Number(ingredient.price * ingredient.quantity).toFixed(2)}`"></td>
                                    <td>
                                        <a href="#" class="btn btn-outline-danger btn-sm" @click.prevent="quitIngredient(i)"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right" colspan="3">Total:</td>
                                    <td v-text="`$${ingredientsTotal}`"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div slot="modal-footer" class="modal-footer">
                <a href="#" @click.prevent="saveCombination" class="btn btn-success">{{ $t('messages.save') }}</a>
            </div>
        </stack-modal>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                searchTerm: '', // Término de búsqueda
                combinations: [], // Elelementos encontrados
                selectedCombinations: [], // Elementos seleccionados para agregar
                ingredients: [], // Lista de ingredientes
                selectedIngredients: [], // Ingredientes seleccionados
                orderNumber: 0, // Número de pedido
                tokenSource: null, // Permite detener peticiones con axios

                combinationName: '',
                newCombinationModal: false, // Modal para registrar una nueva pizza personalizada
                combinationDetailModal: false,
                defaults: null
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
            },
            ingredientsTotal(){
                let total = 0;
                this.selectedIngredients.forEach(el => total += el.quantity * el.price);

                return total.toFixed(2);
            },
            basePrice(){
                return this.defaults ? Number(this.defaults.pizza_base_price) : 0
            },
            combinationTotal(){
                return Number(this.ingredientsTotal) + Number(this.basePrice);
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
            getDefaults(){ // Se obtienen datos globales (precio de la base de la pizza)
                let url = `configs`;

                axios.get(url)
                .then(response => {
                    this.defaults = response.data.data;
                })
                .catch(error => {
                    Vue.$toast.error(`Error: ${error}`, { position: 'top-right' });
                });
            },
            getIngredients(){
                let url = `ingredients`;

                axios.get(url)
                .then(response => {
                    this.ingredients = response.data.data;
                })
                .catch(error => {
                    Vue.$toast.error(`Error: ${error}`, { position: 'top-right' });
                })
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

                me.$refs.btnSaveOrder.disabled = true;
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
                        Vue.$toast.error(`Error: ${error}`, { position: 'top-right' });
                    })
                    .finally(() => {
                        me.$refs.btnSaveOrder.disabled = false;
                    })
                } catch (error) {
                    Vue.$toast.error(`Error: ${error}`, { position: 'top-right' });
                    return;
                }
            },
            closeNewCombinationModal(){
                this.newCombinationModal = false;
            },
            addCombination(combination){ // Agrega elementos al pedido
                let index = this.selectedCombinations.findIndex(el => el.id == combination.id); // Buscar el índice de la combinación

                // Sumar la cantidad si ya existe el elemento, sino, agregarlo al arreglo
                if (index >= 0) this.selectedCombinations[index].quantity += combination.quantity;
                // Vue.util.extend sirve para que los cambios que se hagan en el arreglo se actualicen en la vista
                else this.selectedCombinations.push(Vue.util.extend({}, combination));
            },
            quitCombination(index) { // Quita un elemento de los seleccionados según el índice
               this.selectedCombinations.splice(index, 1)
            },
            addIngredient(ingredient){ // Agrega ingredientes al detalle de la pizza
                let index = this.selectedIngredients.findIndex(el => el.id == ingredient.id); // Buscar el índice del ingrediente

                // Sumar la cantidad si ya existe el elemento, sino, agregarlo al arreglo
                if (index >= 0) this.selectedIngredients[index].quantity += ingredient.quantity;
                else this.selectedIngredients.push(Vue.util.extend({}, ingredient));
            },
            quitIngredient(index) { // Quita un elemento de los seleccionados según el índice
               this.selectedIngredients.splice(index, 1)
            },
            showCombinationDetail(){
                this.combinationDetailModal = true;
            },
            saveCombinationDetails(combination, callback){
                let i = 0;
                this.selectedIngredients.forEach(el => {
                    let url = `pizzas/${combination.id}/ingredients/${el.id}/pizza-details`;
                    axios.post(url, {
                        ingredient_price: el.price,
                        ingredient_quantity: el.quantity
                    }) // Solamente se envia la cantidad como parámetro, lo demás va en la url
                    .then(() => {
                        if (this.selectedIngredients.length == ++i) callback(); // Si ya se terminaron todas las consultas
                    })
                    .catch(error => {
                        throw error;
                    });
                });
            },
            saveCombination(){
                let me = this;
                let url = `pizzas`;

                try {
                    if (this.selectedIngredients.length <= 0) throw this.translate('add_ingredients_message')
                    if (this.combinationName.length <= 0) throw this.translate('required_name_message')

                    axios.post(url, {
                        name: me.combinationName
                    })
                    .then(response => {
                        if (response.status == 200) throw me.translate('combination_message_exists')
                        let combination = response.data.data;
                        this.saveCombinationDetails(combination, function(){
                            Vue.$toast.success(me.translate('created_combination'), { position: 'top-right' });
                            me.resetNewCombination();
                            me.searchCombinations();
                        });
                    })
                    .catch(error => {
                        Vue.$toast.error(`Error: ${error}`, { position: 'top-right' });
                    });
                } catch (error) {
                    Vue.$toast.error(`Error: ${error}`, { position: 'top-right' });
                }
            },
            resetNewCombination(){ // Limpia los campos para registrar una nueva combinación y cierra los modales
                this.combinationDetailModal = false;
                this.newCombinationModal = false;
                this.combinationName = '';
                this.selectedIngredients = [];
                this.getIngredients();
            }
        },
        mounted(){
            this.createCancelToken();
            this.getDefaults();
            this.getIngredients();
            this.loadOrderNumber();
            this.searchCombinations();
        }
    }
</script>
