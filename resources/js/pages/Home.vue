<template>
    <div>

        <navbar></navbar>

        <div class="w-full flex flex-col mt-10">
            <!--welcoming-->
            <div class="lg:mb-32 mb-20">
                <div class="flex flex-wrap items-center justify-between lg:px-24 px-4 ">
                    <div class="lg:w-5/12 w-full">
                        <h1 class="lg:text-5xl text-4xl font-bold text-orange-100">
                            تشكيلة
                        </h1>
                        <p class="mt-10 lg:text-xl text-base">
                            اطلالة الى عالم الطفولة، سنعيش معا مغامرات شيقة
                            نعزف من خلالها لحنا في كل ما نتمناه لكم من ثقافة واخلاق
                            رفيعة ومتعة وابداع.
                        </p>
                        <div class="mt-10">


                            <!--                        <button type="button"-->
                            <!--                                class="lg:py-3 text-xl lg:px-6 py-3 px-5 bg-gray-500 text-white rounded-2xl shadow-lg">-->
                            <!--                            <a href="/#store">-->
                            <!--                                الذهاب الى المتجر-->
                            <!--                            </a>-->
                            <!--                        </button>-->
                        </div>

                    </div>

                    <div class="lg:w-5/12 w-full flex lg:justify-end justify-center mt-6 lg:mt-0">
                        <img class="" src="images/main_page.png" alt="">
                    </div>

                </div>

                <div class="flex justify-between items-center lg:-mt-32 -mt-28">
                    <div class="lg:w-4/12 w-6/12">
                        <img src="/images/shoppingBags.png" alt="">
                    </div>
                    <div class="lg:w-3/12 w-6/12 lg:ml-18 ml-0 lg:-mt-10 -mt-0">
                        <img src="/images/shoppingCart.png" alt="">
                    </div>
                </div>
            </div>

            <!--top picks-->
            <!--            new scroller that works-->
            <div class="flex justify-center bg-gray-300">
                <div class="mx-auto w-full lg:px-4 px-0 mt-10 mb-10">
                    <div class="lg:mx-20 mx-0 my-8">
                        <h1 class="text-orange-100 text-3xl text-center mb-10 mt-">مختارات</h1>

                        <div id="scrollContainer"
                             class="flex flex-no-wrap overflow-x-scroll overflow-y-hidden scrolling-touch items-start mb-8 hide-scroller">
                            <!--                        bg-blue-500 shadow-lg rounded-->
                            <!--                        customized card-->
                            <div v-for="product in picks" class="flex-none w-2/4 md:w-1/4 mr-8 md:pb-4">
                                <a :href="'/product/'+ product.id" class="space-y-4">
                                    <div class="aspect-w-16 aspect-h-9">
                                        <img
                                            class="object-fit bg-gray-100 object-center shadow-md hover:shadow-xl rounded-lg w-full h-64"
                                            :src="'storage/'+product.preview_img" alt=""
                                        />
                                    </div>
                                    <div class="px-4 py-2">
                                        <div class="text-lg leading-6 font-medium space-y-1">
                                            <h3 class="font-bold text-xl text-orange-200 text-center">{{
                                                    product.name
                                                }}</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!--                        other not customized-->

                        </div>
                    </div>
                    <!---->

                </div>

            </div>
        </div>

        <!--store-->
        <div id="store">
            <div class="flex items-start flex-wrap lg:mt-32 mt-20 hide-scroller">
                <div
                    class="lg:w-2/12 w-11/12 lg:mb-0 mb-6 lg:mx-0 mx-auto bg-white rounded p-4 shadow-lg hide-scroller">
                    <h1 class="text-orange-100 text-3xl text-center">المتاجر</h1>

                    <div
                        class="hide-scroller flex lg:flex-col flex-row lg:items-start items-center lg:overflow-x-hidden overflow-x-scroll scrolling-touch flex-no-wrap mt-10">
                        <h1 :class="activeShops == null ? 'bg-dark-100 text-white' :  'text-dark-100'"
                            @click="getProducts(null)"
                            class="lg:text-xl lg:text-start text-center whitespace-nowrap items-center px-5 py-3 rounded font-bold ml-2 cursor-pointer lg:mt-0 mt-2 lg:w-full w-auto">
                            كل المنتجات
                        </h1>
                        <div class="hide-scroller lg:w-full w-auto" v-for="shop in shops">
                            <h1 :class="activeShops == shop.id ? 'bg-dark-100 text-white' :  'text-dark-100'"
                                @click="getProducts(shop.id)"
                                class="lg:text-xl lg:text-start text-center whitespace-nowrap items-center px-5 py-3 rounded font-bold ml-2 cursor-pointer lg:mt-0 mt-2 w-full">
                                {{ shop.name }}
                            </h1>
                        </div>

                    </div>
                </div>

                <div class="lg:w-10/12 w-full px-6">
                    <!--                        <h1 class="text-orange-100 text-3xl pt-4">اسم المحل</h1>-->
                    <div class="grid xl:grid-cols-3 lg:grid-cols-2 grid-cols-1 gap-14">
                        <product v-for="product in products" :hide-price="true" :key="`product-${product.id}`"
                                 :product="product"></product>

                    </div>
                </div>

            </div>

        </div>
    </div>



</template>

<script>
import Product from "../components/Product";
// import shop from "../components/shop";
import Navbar from "../components/Navbar";

import axios from "axios";

export default {
    components: {
        Product, Navbar
    },
    name: "Home",
    data() {
        return {
            products: [],
            shops: [],
            picks: [],
            activeShops: null
        }
    },
    computed: {
        items() {
            return this.$store.getters.items;
        },
        total() {
            return this.$store.getters.total;
        },

        // ...mapGetters(["total"])
    },
    methods: {
        getProducts(shop) {
            axios.get('/api/products', {
                params: {
                    shop: shop,
                }
            }).then(response => {

                this.products = response.data.products;

                if (shop !== undefined) {
                    this.activeShops = shop
                }
                // console.log(this.products.final_price)
            })
        },
        getTopPicks() {
            axios.get('/api/toppicks').then(response => {
                this.picks = response.data.picks;
                // console.log(this.picks)

            })
        }
    },
    mounted() {
        this.getProducts()
        this.getTopPicks()

        axios.get('/api/shops').then(response => {
            this.shops = response.data.shops

        });
    }
}
</script>

<style scoped>

</style>
