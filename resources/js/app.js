require('./bootstrap');
require('./map');


window.Vue = require('vue');

import { Form, HasError, AlertError } from 'vform';

window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)


Vue.component('pagination', require('laravel-vue-pagination'));

window.Fire = new Vue();
//----------------
import swal from 'sweetalert2'
window.swal = swal;
const toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});

import Vue from 'vue'
import VueAgile from 'vue-agile'

Vue.use(VueAgile)

window.toast = toast;

import VueRouter from 'vue-router'


Vue.use(VueRouter)

let routes = [
    { path: '/admin/dashboard', component: require('./components/admin/Dashboard.vue').default },
    { path: '/admin/preview', component: require('./components/admin/Preview.vue').default },
    { path: '/admin/users', component: require('./components/admin/Users.vue').default },
    { path: '/admin/groups', component: require('./components/admin/Groups.vue').default },
    { path: '/admin/manufacturers', component: require('./components/admin/Manufacturers.vue').default },
    { path: '/admin/products', component: require('./components/admin/Products.vue').default },
    { path: '/admin/carousel', component: require('./components/admin/Carousel.vue').default },
    { path: '/', component: require('./components/front/Main.vue').default },
    { path: '/information', component: require('./components/front/Information.vue').default },
    { path: '/contacts', component: require('./components/front/Contacts.vue').default },
    { path: '/news', component: require('./components/front/News.vue').default },
    { path: '/price', component: require('./components/front/Price.vue').default },
    { path: '/shop', component: require('./components/front/Shop.vue').default },
    { path: '/shop/solo', component: require('./components/front/SoloProduct.vue').default },
]

const router = new VueRouter({
    mode: 'history',
    routes
})

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('carousel-component', {
    render: function (createElement) {
        return createElement('div', { class: 'carousel-component' },
            this.items.map((item, index) =>
                createElement('div', {
                    'class': 'carousel-page' + (this.current === index ? ' active' : ''),
                    style: {
                        transform: `translate3d(${this.position(index) * 100}%, 0, 0)`,
                    }
                }, [item])
            ).concat([
                createElement('button', {
                    'class': 'carousel-nav-prev',
                    on: { click: () => { this.decreaseCurrent(); } }
                }, 'Назад'),
                createElement('button', {
                    'class': 'carousel-nav-next',
                    on: { click: () => { this.increaseCurrent(); } }
                }, 'Вперед')
            ])
        );
    },
    data: function() {
        return {
            current: 0
        };
    },
    computed: {
        items: function() {
            return this.$slots.default.filter(function(item) {
                return item.componentOptions !== undefined &&
                    item.componentOptions.tag === 'carousel-item';
            });
        }
    },
    methods: {
        decreaseCurrent: function() {
            this.current += this.items.length - 1;
            this.current %= this.items.length;
        },
        increaseCurrent: function() {
            this.current += 1;
            this.current %= this.items.length;
        },
        position: function(index) {
            if (index === this.current) return 0;
            if (index === (this.current + 1) % this.items.length) return 1;
            return -1;
        }
    }
});

Vue.component('carousel-item', {
    render: function (createElement) {
        return createElement('div', { class: 'carousel-item' }, this.$slots.default);
    }
});

const app = new Vue({
    el: '#app',
    router,
    data: {
        search: '',

    },
    methods: {
        searchit:_.debounce(()=>{
            Fire.$emit('searching');
        },500)

    }
});





$(document).ready(function () {
    var touch = $('#toggle-menu');
    var menu = $('.nav');

    $(touch).on('click', function (e) {
        e.preventDefault();
        menu.slideToggle(500);
        $(touch).toggleClass('open');


        /*if($(touch).hasClass('open')) {
            $('.menu li').on('click',function (e) {
                e.preventDefault();
                menu.hide(500);
            })
        }*/

    });
    $(window).resize(function () {
        var wid = $(window).width();
        if(wid > 1000 && menu.is(':hidden')){
            menu.removeAttr('style');
        }
        if($(touch).hasClass('open') && wid > 1000){
            $(touch).removeClass('open')
        }
    })
})

$('#openMap').click(function () {
    $('.map_block').css("display", "block")
})
$('#closeMap').click(function () {
    $('.map_block').css("display", "none")
})

$('.enter').click(function () {
    $('#registration_block').css("display", "block")
})

$('#closeRegistration').click(function () {
    $('#registration_block').css("display", "none");
})









