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

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
   data:{
       visibleUpdateUser:false,
       showCategory:true,
       categoryText:'new',
   },
   methods: {
       toggleUpdateFormUser(){
           this.visibleUpdateUser= !this.visibleUpdateUser;
       },
       showSubmitCategory(){
            this.showCategory=!this.showCategory;
            this.categoryText = this.showCategory==true ? 'new' : 'close';
       },
       showUpdateCategory(e){
            let status = 0;
            e.target.offsetParent.children[2].classList.forEach(element => {
                if(element =='d-none'){
                    status = 1;
                    e.target.offsetParent.children[2].classList.remove('d-none');
                }
            });
            //dipslay noone all
            let forms = document.querySelectorAll('.updateCategory');
            forms.forEach(element => {
                element.classList.add('d-none');
            });


            if(status==0){
                //remove all d-none from lis
                e.target.offsetParent.children[2].classList.add('d-none');
                if(window.innerWidth<600){
                    e.target.offsetParent.children[1].classList.remove('d-none');
                }

            }else{
                e.target.offsetParent.children[2].classList.remove('d-none');

                if(window.innerWidth<600){
                    e.target.offsetParent.children[1].classList.add('d-none');
                }

            }
            // console.log(e.target.offsetParent.children[2].classList.remove('d-none'));
       }
   },
})
