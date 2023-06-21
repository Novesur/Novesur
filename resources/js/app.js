require('./bootstrap');
window.Vue = require('vue')


import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import locale from 'element-ui/lib/locale/lang/es'
import onlyInt from 'vue-input-only-number';
import VueCurrencyFilter from 'vue-currency-filter'



window.Vue.use(ElementUI,{ locale });
window.Vue.use(onlyInt);
window.Vue.use(require('vue-moment'));
window.Vue.use(VueCurrencyFilter,
    {
      symbol : 'S/.',
      thousandsSeparator: '.',
      fractionCount: 2,
      fractionSeparator: ',',
      symbolPosition: 'front',
      symbolSpacing: true
    })

    window.Vue.filter('fourchar',function(value){
        return value.toString().padStart(3,"0000")
    })
    window.Vue.filter('formatPrice',function(value) {
        let val = (value/1).toFixed(2).replace('.', ',')
        return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")

    })

import Swal from 'sweetalert2'
window.Swal = Swal;

export const EventBus = new Vue();
window.EventBus = EventBus;

Vue.component('App', require('./components/App.vue').default);
Vue.component('Auth', require('./components/Auth.vue').default);
import router from './routes';


const app = new Vue({
    el: '#app',
    router
});


