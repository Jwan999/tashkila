<template>
    <div>
        <navbar></navbar>

        <!--email form-->
        <div v-if="!submittedEmail" class="w-full flex flex-col lg:px-24 px-4 mt-10">

            <div class="flex justify-between items-center w-full lg:mb-10 mb-6">
                <div class="lg:w-4/12 w-0">

                </div>
                <div class="lg:w-4/12 w-6/12">
                    <h1 class="lg:text-4xl text-3xl lg:text-center text-right text-red-500 font-bold">الطلبات</h1>

                </div>
                <div class="flex justify-end lg:w-4/12 w-6/12">
                    <button @click="goBack"
                            class="lg:py-3 py-3 px-4 lg:px-6 bg-gray-700 focus:bg-gray-800 text-white rounded-2xl shadow-lg">
                        الرجوع
                    </button>
                </div>

            </div>


            <div class="flex justify-center">
                <div class="lg:w-5/12 w-full">
                    <div class="bg-white shadow-lg rounded-2xl p-6 flex flex-col">
                        <h1 class="mb-6 text-xl text-gray-700">الرجاء ادخال البريد الاكتروني الذي سجلت به عند اتمام
                            الطلب</h1>
                        <div class="mb-3">
                            <h1 class="text-gray-800 text-sm mb-2 font-bold">عنوان البريد الالكتروني</h1>
                            <input @keyup.enter="getOrders" v-model="email"
                                   placeholder="عنوان البريد الالكتروني" type="email"
                                   class="rounded-2xl w-full px-3 py-4 outline-none border-2 border-gray-300 focus:border-gray-700">
                        </div>
                        <div>
                            <button @click="getOrders"
                                    class="bg-red-500 focus:bg-red-600-500 py-3 px-4 text-white rounded-2xl shadow-lg mt-6 hover:bg-red-600 cursor-pointer">
                                ارسل
                            </button>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <!--when there are no orders or the email is wrong-->
        <div v-if="submittedEmail && this.orders.length  == 0">
            <div class="flex justify-center mt-32">
                <img class="lg:w-2/12 w-4/12" src="/images/emptyOrders.svg" alt="">
            </div>
            <h1 class="lg:text-3xl text-xl mt-10 text-center">لا توجد طلبات حاليا</h1>
            <h1 class="text-lg text-gray-700 text-center">تاكد من ادخال البريد الالكتروني الصحيح الذي ادخلته عند اتمام
                الطلب</h1>
            <div class="flex justify-center mb-10 mt-6">
                <button @click="submittedEmail = ''"
                        class="bg-gray-800 focus:bg-gray-600 py-3 px-4 text-white rounded-2xl shadow-lg mt-4 hover:bg-gray-600 cursor-pointer">
                    ادخال بريد الكتروني مختلف
                </button>
            </div>
        </div>

        <!--orders -->
        <div v-if="submittedEmail && !this.orders.length  == 0" class="w-full flex flex-col lg:px-24 px-4 mt-10">
            <!--    <router-link :to="{path:'/products'}">Click Me</router-link>-->
            <!--    <router-link :to="{path:'/checkout'}">Checkout</router-link>-->

            <div id="store">
                <div class="flex justify-between items-center w-full lg:mb-10 mb-6">
                    <div class="lg:w-4/12 w-0">

                    </div>
                    <div class="lg:w-4/12 w-6/12">
                        <h1 class="lg:text-4xl text-3xl lg:text-center text-right text-red-500 font-bold">الطلبات</h1>

                    </div>
                    <div class="flex justify-end lg:w-4/12 w-6/12">
                        <button @click="submittedEmail = ''"
                                class="bg-gray-800 focus:bg-gray-600 py-3 px-4 text-white rounded-2xl text-sm shadow-lg hover:bg-gray-600 cursor-pointer">
                            ادخال بريد الكتروني مختلف
                        </button>
                    </div>

                </div>


                <div class="flex flex-wrap rounded-2xl justify-center">
                    <!--                    where completed is true-->
                    <h1 :class="!showCompleted ? 'bg-red-500 text-white' :  'text-red-500 bg-red-100'"
                        @click="showCompleted = false;"
                        class="lg:text-xl items-center px-5 py-3 rounded-2xl font-bold ml-2 cursor-pointer lg:mt-0 mt-2">
                        الطلبات السابقة
                    </h1>
                    <!--where completed is null-->
                    <!--and is dispatched then write it's on it's way-->
                    <h1 :class="showCompleted ? 'bg-red-500 text-white' :  'text-red-500 bg-red-100'"
                        @click="showCompleted = true;"
                        class="lg:text-xl items-center px-5 py-3 rounded-2xl font-bold ml-2 cursor-pointer lg:mt-0 mt-2">
                        الطلبات الحالية
                    </h1>
                </div>
                <!--products-->

                <div v-if="showCompleted && notCompleted.length === 0">
                    <div class="flex justify-center mt-32">
                        <img class="lg:w-2/12 w-4/12" src="/images/emptyOrders.svg" alt="">
                    </div>
                    <h1 class="lg:text-3xl text-xl mt-10 text-center">لا توجد طلبات قيد التنفيذ</h1>

                </div>


                <div class="flex flex-wrap gap-10">


                    <!--past orders data-->
                    <div class="w-full" v-if="!showCompleted" v-for="order in completed">
                        <h1 class="font-bold text-2xl my-10 text-center ">محتويات الطلب رقم {{ order.id }}</h1>
                        <div class="grid lg:grid-cols-4 md:grid-cols-3 grid-cols-1 gap-10">
                            <div v-for="item in order.items">
                                <div v-if="item.product"
                                     class="shadow-lg bg-white rounded-2xl flex flex-col">

                                    <img class="rounded-t-2xl border-t-2 border-gray-700 h-96 w-full object-cover"
                                         :src="'storage/'+item.product.preview_img"
                                         alt="">
                                    <div class="px-3 py-4">
                                        <h3 class="font-bold text-lg ">{{ item.product.name }}</h3>
                                        <h3 class="font-mono text-md ">{{ item.product.price }}</h3>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                    <!--new orders data-->
                    <div class="w-full" v-if="showCompleted" v-for="order in notCompleted">
                        <h1 class="font-bold text-2xl my-10 text-center ">محتويات الطلب رقم {{ order.id }}</h1>
                        <div class="grid lg:grid-cols-4 md:grid-cols-3 grid-cols-1 gap-10">
                            <div v-for="item in order.items">
                                <div v-if="item.product"
                                     class="shadow-lg bg-white rounded-2xl flex flex-col">

                                    <img class="rounded-t-2xl border-t-2 border-gray-700 h-96 w-full object-cover"
                                         :src="'storage/'+item.product.preview_img"
                                         alt="">
                                    <div class="px-3 py-4">
                                        <h3 class="font-bold text-lg ">{{ item.product.name }}</h3>
                                        <h3 class="font-mono text-md ">{{ item.product.price }}</h3>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
            </div>

        </div>

    </div>


</template>

<script>
import Product from "../components/Product";
// import Category from "../components/Category";
import Navbar from "../components/Navbar";

import axios from "axios";

export default {
    components: {
        Product, Navbar
    },
    name: "Home",
    data() {
        return {
            orders: [],
            showCompleted: true,
            submittedEmail: '',
            email: '',
        }
    },

    methods: {
        // getProductForItem(item) {
        //     return this.products.find(product => item.product_id === product.id);
        // },
        getOrders() {
            this.submittedEmail = this.email;
            axios.get('/api/orders', {
                params: {
                    email: this.submittedEmail,
                }
                // hehe
            }).then(response => {
                this.orders = response.data.orders;

            })
        },
        goBack() {
            this.$router.back();
        }


    },
    computed: {
        notCompleted() {
            return this.orders.filter(order => order.completed_at == null);
        },
        completed() {
            return this.orders.filter(order => order.completed_at != null);
        }

    },
    mounted() {
        this.getOrders();
    }
}
</script>


