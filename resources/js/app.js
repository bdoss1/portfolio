
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('comment-component', require('./components/comment/CommentComponent').default);
Vue.component('contact-form-component', require('./components/ContactFormComponent').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import Notifications from 'vue-notification';
import velocity from 'velocity-animate';
import Loading from 'vue-loading-overlay';

Vue.use(Notifications, {velocity});
Vue.use(Loading);

const app = new Vue({
    el: '#app'
});


const loadFont = (url) => {
    // the 'fetch' equivalent has caching issues
    var xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);
    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            let css = xhr.responseText;
            css = css.replace(/}/g, 'font-display: swap; }');

            const head = document.getElementsByTagName('head')[0];
            const style = document.createElement('style');
            style.appendChild(document.createTextNode(css));
            head.appendChild(style);
        }
    };
    xhr.send();
};

loadFont('https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700,800');



