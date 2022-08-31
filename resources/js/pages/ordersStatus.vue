<template>
    <div>
        <navbar></navbar>

        <!--email form-->
        <div v-if="!submittedEmail" class="w-full flex flex-col lg:px-24 px-4 mt-10">

            <div class="flex justify-between items-center w-full lg:mb-10 mb-6">
                <div class="lg:w-4/12 w-0">

                </div>
                <div class="lg:w-4/12 w-6/12">
                    <h1 class="lg:text-4xl text-3xl lg:text-center text-right text-dark-100 font-bold">الطلبات</h1>

                </div>
                <div class="flex justify-end lg:w-4/12 w-6/12">
                    <button @click="goBack"
                            class="lg:py-3 py-3 px-4 lg:px-6 bg-dark-100 hover:bg-dark-200 text-white rounded shadow-lg">
                        رجوع
                    </button>
                </div>

            </div>


            <div class="flex justify-center">
                <div class="lg:w-5/12 w-full">
                    <div class="bg-white shadow-lg rounded p-6 flex flex-col">
                        <h1 class="mb-6 text-xl text-dark-100">الرجاء ادخال البريد الاكتروني الذي سجلت به عند اتمام
                            الطلب</h1>
                        <div class="mb-3">
                            <h1 class="text-dark-100 text-sm mb-2 font-bold">عنوان البريد الالكتروني</h1>
                            <input @keyup.enter="getOrders" v-model="email"
                                   placeholder="عنوان البريد الالكتروني" type="email"
                                   class="rounded w-full px-3 py-3 outline-none border-2 border-gray-300 focus:border-gray-700">
                        </div>
                        <div>
                            <button @click="getOrders"
                                    class="bg-orange-100 hover:bg-orange-200 py-3 px-4 text-white rounded shadow-lg mt-6 cursor-pointer">
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
                <img class="lg:w-2/12 w-4/12" src="/images/emptyOrders.png" alt="">
            </div>
            <h1 class="lg:text-3xl text-xl mt-10 text-center text-dark-100">لا توجد طلبات حاليا</h1>
            <h1 class="text-lg text-gray-700 text-center">تاكد من ادخال البريد الالكتروني الصحيح الذي ادخلته عند اتمام
                الطلب</h1>
            <div class="flex justify-center mb-10 mt-6">
                <button @click="submittedEmail = ''"
                        class="bg-dark-100 py-3 px-4 text-white rounded shadow-lg mt-4 hover:bg-dark-200 cursor-pointer">
                    ادخال بريد الكتروني مختلف
                </button>
            </div>
        </div>

        <!--orders -->
        <div v-if="submittedEmail && !this.orders.length  == 0" class="w-full flex flex-col mt-10">
            <!--    <router-link :to="{path:'/products'}">Click Me</router-link>-->
            <!--    <router-link :to="{path:'/checkout'}">Checkout</router-link>-->

            <div id="store">
                <!--header-->
                <div class="flex justify-between items-center w-full lg:mb-10 mb-6 lg:px-24 px-4">
                    <div class="lg:w-4/12 w-0">

                    </div>
                    <div class="lg:w-4/12 w-6/12">
                        <h1 class="lg:text-4xl text-3xl lg:text-center text-right text-dark-100 font-bold">الطلبات</h1>

                    </div>
                    <div class="flex justify-end lg:w-4/12 w-6/12">
                        <button @click="submittedEmail = ''"
                                class="bg-gray-800 focus:bg-gray-600 py-3 px-4 text-white rounded text-sm shadow-lg hover:bg-gray-600 cursor-pointer">
                            ادخال بريد الكتروني مختلف
                        </button>
                    </div>

                </div>

                <div class="flex flex-wrap rounded justify-center lg:px-24 px-4">
                    <!--where completed is true-->
                    <h1 :class="!showCompleted ? 'bg-dark-100 text-white' :  'text-dark-100'"
                        @click="showCompleted = false;"
                        class="lg:text-xl items-center px-5 py-3 rounded font-bold ml-2 cursor-pointer lg:mt-0 mt-2">
                        الطلبات السابقة
                    </h1>

                    <!--where completed is null-->
                    <!--and is dispatched then write it's on it's way-->
                    <h1 :class="showCompleted ? 'bg-dark-100 text-white' :  'text-dark-100'"
                        @click="showCompleted = true;"
                        class="lg:text-xl items-center px-5 py-3 rounded font-bold ml-2 cursor-pointer lg:mt-0 mt-2">
                        الطلبات الحالية
                    </h1>
                </div>

                <!--no current products-->
                <div v-if="showCompleted && notCompleted.length === 0">
                    <div class="flex justify-center mt-32 lg:px-24 px-4">
                        <img class="lg:w-2/12 w-4/12" src="/images/emptyOrders.png" alt="">
                    </div>
                    <h1 class="lg:text-3xl text-xl mt-10 text-center">لا توجد طلبات قيد التنفيذ</h1>
                </div>

                <div class="flex flex-wrap gap-10">

                    <!--past orders data-->
                    <div class="w-full " v-if="!showCompleted" v-for="order in completed">

                        <div class="my-10 py-3 bg-gray-200 text-center">
                            <div class="flex justify-center">
                                <h1 class="font-bold text-xl px-2">محتويات الطلب رقم</h1>
                                <h1 class="font-bold text-xl px-2">#{{ order.id }}</h1>
                            </div>

                            <div class="flex justify-center">
                                <h1 class="text-gray-800 text-sm mt-1 px-2">بتاريخ</h1>
                                <h1 class="text-gray-800 text-sm mt-1 px-2"> {{ new Date(order.completed_at).getDate() }} - {{ new Date(order.completed_at).getMonth() + 1}} - {{ new Date(order.completed_at).getFullYear() }}</h1>

                            </div>
                        </div>

                        <div class="grid lg:grid-cols-4 md:grid-cols-3 grid-cols-1 gap-10 lg:px-24 px-4">

                            <div class="w-full bg-white rounded shadow-md hover:shadow-xl" v-for="item in order.items">
                                <div v-if="item.product">
                                    <a :href="'/product/'+ item.product.id">
                                        <img
                                            class="object-fit object-center w-full h-64"
                                            :src="'storage/'+item.product.preview_img" alt=""
                                        />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--new orders data-->
                    <div class="w-full" v-if="showCompleted" v-for="order in notCompleted">
                        <div class="my-10 bg-gray-200 text-center">
                            <div class="my-10 py-3 bg-gray-200 text-center">
                                <div class="flex justify-center">
                                    <h1 class="font-bold text-xl px-2">محتويات الطلب رقم</h1>
                                    <h1 class="font-bold text-xl px-2">#{{ order.id }}</h1>
                                </div>

                                <div class="flex justify-center">
                                    <h1 class="text-gray-800 text-sm mt-1 px-2">بتاريخ</h1>
                                    <h1 class="text-gray-800 text-sm mt-1 px-2"> {{ new Date(order.created_at).getDate() }} - {{ new Date(order.created_at).getMonth() + 1}} - {{ new Date(order.created_at).getFullYear() }}</h1>

                                </div>
                            </div>
                        </div>

                        <div class="grid lg:grid-cols-4 md:grid-cols-3 grid-cols-1 gap-10 lg:px-24 px-4">

                            <div class="w-full bg-white rounded shadow-md hover:shadow-xl " v-for="item in order.items">
                                <div v-if="item.product">
                                    <a :href="'/product/'+ item.product.id">
                                        <img
                                            class="object-fit object-center w-full h-64"
                                            :src="'storage/'+item.product.preview_img" alt=""
                                        />

                                    </a>
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
                console.log(this.orders)

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


