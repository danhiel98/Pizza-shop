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

const store = new Vuex.Store();
Vue.use(vuexI18n.plugin, store); // Utilizar vuex y el plugin para multiidioma

// Agregar los idiomas
Vue.i18n.add('en', Locales.en);
Vue.i18n.add('es', Locales.es);

// Establecer el idioma por defecto
Vue.i18n.set(localStorage.getItem('locale') || 'es');

// Componentes personalizados
Vue.component('client-home', require('./components/Client/Dashboard.vue').default);

const app = new Vue({
    store,
    el: '#app',
});
