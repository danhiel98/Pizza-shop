/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vuex from 'vuex'; // Para tener datos globales
import vuexI18n from 'vuex-i18n'; // Se utiliza para poder utilizar la característica de multiidioma
import Locales from './vue-i18n-locales.generated.js'; // Archivo generado con las traducciones
import VueToast from 'vue-toast-notification';
import {ServerTable, ClientTable, Event} from 'vue-tables-2';
import StackModal from '@innologica/vue-stackable-modal'
import 'vue-toast-notification/dist/index.css';

const store = new Vuex.Store();
Vue.use(vuexI18n.plugin, store); // Utilizar vuex y el plugin para multiidioma
Vue.use(VueToast);
Vue.use(ClientTable);

// Agregar los idiomas
Vue.i18n.add('en', Locales.en);
Vue.i18n.add('es', Locales.es);

// Establecer el idioma por defecto
Vue.i18n.set(localStorage.getItem('locale') || 'es');

// Obtener el id del usuario activo
let meta = document.querySelector("meta[name='user-id']");
Vue.prototype.$userId = meta ? meta.getAttribute('content') : null;

// Componentes personalizados
Vue.component('stack-modal', StackModal);
Vue.component('client-home', require('./components/Client/Dashboard.vue').default);

// URL base para las peticiones con axios
axios.defaults.baseURL = 'http://localhost:8000';

const app = new Vue({
    store,
    el: '#app',
});
