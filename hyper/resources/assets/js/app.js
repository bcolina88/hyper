
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue';
import BootstrapVue from 'bootstrap-vue';
import VueOnToast from 'vue-on-toast';
import App from './App.vue';
import router from './router';
import store from './store';

const bTableProps = {
  items: {
    type: [Array, Function],
    default: undefined
  },
  fields: {
    type: [Object, Array],
    default: undefined
  }
};


Vue.component('App', require('./App.vue'));
Vue.component('table-wrapper', {
  props: Object.assign({}, bTableProps),
  render(h) {
    return h('b-table', {
      props: this.$props,
      slots: this.$parent.$slots,
      scopedSlots: this.$parent.$scopedSlots,
      on: {
        'row-clicked': (item, index, event) => alert('clicked ' + index)
      }
    });
  }
});

Vue.component('custom-table', {
  template: '<div><h3>hello table</h3><table-wrapper :items="items" :fields="fields"></table-wrapper></div>',
  props: Object.assign({}, bTableProps)
});

Vue.use(BootstrapVue);
Vue.use(VueOnToast);

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  store,
  template: '<App/>',
  components: {
    App
  }
})
