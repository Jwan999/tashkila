<template>

    <div>
        <navbar></navbar>
        <!--        <div class="flex justify-center w-full">-->
        <!--            <div class="fixed mt-10 bg-gray-700 text-white font-bold rounded-2xl py-6 text-center">-->
        <!--                تم ارسال طلبك بنجاح-->
        <!--            </div>-->
        <!--        </div>-->
        <div v-if="orderStatus" class="flex justify-center">
            <div
                class="rounded shadow-xl py-6 bg-gray-700 text-white text-lg lg:w-4/12 w-8/12 mt-16 fixed z-10 items-center text-center">
                تم ارسال طلبك بنجاح
            </div>
        </div>
        <div class="flex flex-wrap lg:px-24 px-4 mt-10">


            <div class="w-full flex flex-col">
                <div class="flex items-center justify-between mb-4">
                    <h1 class="lg:text-3xl text-xl">
                        المنتجات في السلة
                    </h1>
                    <button @click="goBack"
                            class="lg:py-3 py-3 px-4 lg:px-6 bg-dark-100 hover:bg-dark-200 text-white rounded shadow-lg">
                        رجوع
                    </button>
                </div>
                <!--                grid lg:grid-cols-4 md:grid-cols-3 gap-6 grid-cols-1 lg:justify-items-start justify-items-center mt-10-->
                <div class="grid lg:grid-cols-4 md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-10">
                    <product :show-buttons="true" v-for="item in items" :product="item.product"
                             :key="`product-1-${item.product.id}`"></product>
                </div>
                <!--when cart empty-->
                <div v-if="items.length == 0">
                    <div class="flex justify-center mt-32">
                        <img class="lg:w-2/12 w-5/12 lg:-ml-10 -ml-0" src="/images/emptyCart.png" alt="">
                    </div>
                    <h1 class="lg:text-3xl text-xl mt-10 text-center">لا توجد منتجات في السلة</h1>
                    <div class="flex justify-center mb-10 mt-6">
                        <button type="button"
                                class="lg:py-3 text-xl lg:px-6 py-3 px-5 bg-orange-100 hover:bg-orange-200 text-white rounded shadow-lg">
                            <a href="/#store">
                                الذهاب الى المتجر
                            </a>
                        </button>
                    </div>

                </div>


            </div>
            <!--user data-->
            <div v-if="items.length > 0"
                 class="flex flex-wrap lg:space-y-0 space-y-10 w-full justify-between lg:mt-20 mt-10">
                <div class="lg:w-7/12 w-full">
                    <div class="bg-white shadow-lg rounded p-6 flex flex-col">
                        <h1 class="mb-6 text-2xl">الرجاء ادخال المعلومات الاتية لاتمام الطلب</h1>
                        <div class="mb-3">
                            <h1 class="text-dark-100 text-sm mb-2 font-bold">الاسم الكامل</h1>
                            <input v-model="fullName" placeholder="الاسم الكامل" type="text"
                                   class="rounded w-full px-3 py-3 outline-none border-2 border-gray-300 focus:border-gray-700">
                        </div>
                        <div v-for="error in validationErrors.full_name" class="w-full mb-2">
                            <h1 class="text-red-500 text-sm">{{ error }}</h1>
                        </div>

                        <div class="mb-3">
                            <h1 class="text-dark-100 text-sm mb-2 font-bold">العنوان</h1>
                            <input v-model="address" placeholder="العنوان" type="text"
                                   class="rounded w-full px-3 py-3 outline-none border-2 border-gray-300 focus:border-gray-700">
                        </div>

                        <div v-for="error in validationErrors.address" class="w-full mb-2">
                            <h1 class="text-red-500 text-sm">{{ error }}</h1>
                        </div>

                        <div class="mb-3">
                            <h1 class="text-dark-100 text-sm mb-2 font-bold">اقرب نقطة دالة</h1>
                            <input v-model="closestMark" placeholder="اقرب نقطة دالة" type="text"
                                   class="rounded w-full px-3 py-3 outline-none border-2 border-gray-300 focus:border-gray-700">
                        </div>
                        <div v-for="error in validationErrors.closest_mark" class="w-full mb-2">
                            <h1 class="text-red-500 text-sm">{{ error }}</h1>
                        </div>

                        <div class="mb-3">
                            <h1 class="text-dark-100 text-sm mb-2 font-bold">رقم الهاتف</h1>
                            <input v-model="phoneNumberOne" placeholder="رقم الهاتف" type="number"
                                   class="rounded w-full px-3 py-3 outline-none border-2 border-gray-300 focus:border-gray-700">
                        </div>
                        <div v-for="error in validationErrors.phone_one" class="w-full mb-2">
                            <h1 class="text-red-500 text-sm">{{ error }}</h1>
                        </div>
                        <div class="mb-3">
                            <h1 class="text-dark-100 text-sm mb-2 font-bold">رقم هاتف بديل</h1>
                            <input v-model="phoneNumberTwo" placeholder="رقم هاتف بديل" type="number"
                                   class="rounded w-full px-3 py-3 outline-none border-2 border-gray-300 focus:border-gray-700">
                        </div>
                        <div v-for="error in validationErrors.phone_two" class="w-full mb-2">
                            <h1 class="text-red-500 text-sm">{{ error }}</h1>
                        </div>
                        <div class="mb-3">
                            <h1 class="text-dark-100 text-sm mb-2 font-bold">عنوان البريد الالكتروني</h1>
                            <input v-model="emailAddress" placeholder="عنوان البريد الالكتروني" type="email"
                                   class="rounded w-full px-3 py-3 outline-none border-2 border-gray-300 focus:border-gray-700">
                        </div>
                        <div v-for="error in validationErrors.email" class="w-full mb-2">
                            <h1 class="text-red-500 text-sm">{{ error }}</h1>
                        </div>
                    </div>
                </div>

                <!--payment and checkout-->
                <div class="lg:w-4/12 w-full">
                    <div class="bg-white shadow-lg rounded p-6 flex flex-col">
                        <h1 class="text-gray-700 text-2xl mb-2">اختر طريقة الدفع</h1>
                        <div class="flex flex-wrap items-center ">
                            <div class="flex items-center mb-4 w-full">
                                <!--                                <button @click="paymentType = 'Cash'"-->
                                <!--                                        class="px-6 bg-gray-500 text-white text-sm rounded-full py-2">-->
                                <!--                                    الدفع عند الاستلام-->
                                <!--                                </button>-->
                                <input v-model="paymentType" id="option-1" type="radio" name="payment" value="Cash"
                                       class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-500 bg-white border-gray-600 ml-2"
                                       aria-labelledby="option-1" aria-describedby="option-1" checked>
                                <label for="option-1"
                                       class="block ml-2 font-medium text-gray-900">
                                    الدفع عند الاستلام
                                </label>
                            </div>
                            <div class="flex items-center mb-4 w-full ">
                                <input v-model="paymentType" id="option-2" type="radio" name="payment" value="Zain Cash"
                                       class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-500 focus:bg-gray-500 bg-white border-gray-600 ml-2"
                                       aria-labelledby="option-2" aria-describedby="option-2">
                                <label for="option-2"
                                       class="block ml-2 font-medium text-gray-900">
                                    الدفع عن طريق زين كاش
                                </label>
                                <!--                                <a href="https://test.zaincash.iq/" @click="paymentType = 'Zain Cash'"-->
                                <!--                                   class="zaincash-btn">-->
                                <!--                                    <img style="vertical-align:middle"-->
                                <!--                                         src="https://test.zaincash.iq/images/zaincash-ar.png">-->
                                <!--                                </a>-->
                            </div>

                            <div v-for="error in validationErrors.payment_type" class="w-full mb-2">
                                <h1 class="text-red-500 text-sm">اختر احدى طرق الدفع</h1>
                            </div>


                        </div>
                        <p class="text-xl mt-6">
                            عدد المنتجات {{ items.length }}
                        </p>
                        <div class="border-t border-gray-500 my-3"></div>
                        <p class="text-xl">
                            السعر الكامل
                            <span class="text-orange-100">IQD {{ total }}</span>
                        </p>
                        <button
                            @click="checkout"
                            class="bg-orange-100 hover:bg-orange-200 py-3 px-4 text-white rounded shadow-lg mt-6 cursor-pointer">
                            اكمال الطلب
                        </button>

                    </div>
                </div>
            </div>

        </div>
    </div>

</template>

<script>
import {mapGetters} from 'vuex';
import axios from 'axios';
import Product from "../components/Product";
import Navbar from "../components/Navbar";

export default {
    name: "Checkout",
    components: {
        Product, Navbar
    },
    data() {
        return {
            fullName: '',
            phoneNumberOne: '',
            phoneNumberTwo: '',
            address: '',
            closestMark: '',
            emailAddress: '',
            paymentType: '',
            orderStatus: null,
            validationErrors: [],
        }
    },

    computed: {
        ...mapGetters(["items", "total"]),
    },

    methods: {
        sendUserData() {
            axios.post('/api/orders', {
                full_name: this.fullName,
                phone_one: this.phoneNumberOne,
                phone_two: this.phoneNumberTwo,
                address: this.address,
                closest_mark: this.closestMark,
                email: this.emailAddress,
                payment_type: this.paymentType,
                items: this.items,
                total: this.total
            })
                .then(response => {
                    this.orderStatus = true
                    this.$store.dispatch("clearCart");
                })
                .catch((error) => {
                    this.validationErrors = error.response.data.errors
                })
        },
        checkout() {
            if (this.paymentType === 'Cash') {
                this.sendUserData();
            } else if (this.paymentType === 'Zain Cash') {
            } else {
                this.sendUserData();
            }
        },

        goBack() {
            this.$router.back();
        }
    },
    watch: {
        orderStatus: function () {
            if (this.orderStatus) {
                setTimeout(order => {
                    this.orderStatus = false;
                    window.location.href = '/'
                }, 4000);
            }
        }
    },

}
</script>

<style scoped>

</style>
