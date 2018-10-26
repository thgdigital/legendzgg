
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
Vue.use(require('vue-moment'));
Vue.use(require('bootstrap-vue'));
Vue.use(require('v-money'));
Vue.use(require('vee-validate'));
const VueUploadComponent = require('vue-upload-component')
Vue.component('file-upload', VueUploadComponent)
import VueCurrencyFilter from 'vue-currency-filter'
Vue.use(VueCurrencyFilter,
    {
        symbol : 'R$ ',
        thousandsSeparator: '.',
        fractionCount: 2,
        fractionSeparator: ',',
        symbolPosition: 'front',
        symbolSpacing: true
    })

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));
Vue.component('list-rifas', require('./components/ListRifas.vue'));
Vue.component('list-items', require('./components/ListItems.vue'));
Vue.component('list-transacoes', require('./components/ListTransacoes.vue'));
Vue.component('edit-items', require('./components/EditItems.vue'));
Vue.component('cad-items', require('./components/CadItems.vue'));
Vue.component('image-item', require('./components/ImageItem.vue'));
Vue.component('nova-rifa', require('./components/NovaRifa.vue'));
Vue.component('imagem-admin', require('./components/ImageAdmin.vue'));
Vue.component('imagem-compra-loja', require('./components/ImageCompraLoja.vue'));
const app = new Vue({
    el: '#app',
    data: {
        showModal: false
    }
});
