import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './routes';
import Vuex from 'vuex';

Vue.use(Vuex)
import cart from "./cart";
import Navbar from "./components/Navbar";
const store = new Vuex.Store(cart);

const router = new VueRouter({routes, mode: "history"});
Vue.use(VueRouter);


new Vue({
    components: {
        "friends-navbar": Navbar,
    },
    router,
    store,
    el: "#app"
})

