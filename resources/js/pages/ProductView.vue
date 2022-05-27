<template>
    <div>
        <navbar></navbar>

        <div class="lg:px-24 px-4 mt-10">
            <div class="flex justify-end">
                <button @click="goBack"
                        class="lg:py-3 py-3 px-4 lg:px-6 bg-dark-100 hover:bg-dark-200 text-white rounded shadow-lg">
                    الرجوع
                </button>
            </div>
            <div class="flex lg:flex-row flex-col-reverse items-center justify-between mt-10 bg-white rounded p-4">

                <div class="lg:w-4/12 w-full">
                    <h1 class="text-2xl text-dark-100">{{ product.name }}</h1>
                    <p class="text-base mt-6 text-dark-200">
                        {{ product.description }}
                    </p>
                    <h1 class="text-orange-100 text-xl mt-4">
                        <span class="text-dark-100 text-sm">  تكلفة المنتج:</span>
                        {{ product.final_price }}$
                    </h1>


                    <div v-if="cartItem" class="grid grid-cols-4 mt-10">
                        <button
                            @click="removeFromCart"
                            class="bg-dark-100 text-white py-2 px-4 font-semibold text-xl rounded my-1 hover:bg-dark-200 cursor-pointer col-span-1">
            <span class="flex justify-center">
                <svg class="fill-current text-white w-8 h-8" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg"><path
                    d="M18 12.75H6C5.59 12.75 5.25 12.41 5.25 12C5.25 11.59 5.59 11.25 6 11.25H18C18.41 11.25 18.75 11.59 18.75 12C18.75 12.41 18.41 12.75 18 12.75Z"/></svg>

            </span>
                        </button>
                        <span
                            class="col-span-2 flex items-center justify-center font-mono text-lg">{{
                                cartItem.quantity
                            }}</span>
                        <button
                            @click="addToCart"
                            class="bg-orange-100 text-white py-2 px-4 font-semibold text-xl rounded my-1 hover:bg-orange-200 cursor-pointer col-span-1">
            <span class="flex justify-center">
              <svg class="fill-current text-white w-8 h-8" viewBox="0 0 24 24"
                   xmlns="http://www.w3.org/2000/svg"><path
                  d="M18 12.75H6C5.59 12.75 5.25 12.41 5.25 12C5.25 11.59 5.59 11.25 6 11.25H18C18.41 11.25 18.75 11.59 18.75 12C18.75 12.41 18.41 12.75 18 12.75Z"/><path
                  d="M12 18.75C11.59 18.75 11.25 18.41 11.25 18V6C11.25 5.59 11.59 5.25 12 5.25C12.41 5.25 12.75 5.59 12.75 6V18C12.75 18.41 12.41 18.75 12 18.75Z"/>
              </svg>

            </span>
                        </button>
                    </div>
                    <div v-else class="grid grid-cols-5 mt-10">
                        <button
                            @click="addToCart"
                            class="bg-orange-100 focus:bg-dark py-3 px-4 text-white rounded shadow-lg my-1 hover:bg-orange-200 cursor-pointer col-span-5">
                            اضافة الى السلة
                        </button>
                    </div>


                    <h1 class="text-xl text-dark-200 mt-10">
                        هذا المنتج من متجر: {{ product.shop.name }}
                    </h1>
                    <p class="text-dark-200 mt-3">
                        {{ product.shop.overview }}
                    </p>
                </div>
                <div class="lg:w-5/12 w-full self-end">
                    <img :src="'/storage/'+product.preview_img" alt="">
                </div>
            </div>

        </div>

        <!--        <h1>hello product {{ $route.params.id }}</h1>-->
    </div>
</template>


<script>
import Navbar from "../components/Navbar";
import axios from "axios";
import {mapGetters} from "vuex";

export default {
    data() {
        return {
            product: {},
        }
    },
    components: {
        Navbar
    },
    methods: {
        goBack() {
            this.$router.back();
        },
        getProduct() {
            axios.get('/api/product', {
                params: {
                    id: this.$route.params.id
                }
            }).then(response => {
                this.product = response.data.product
                console.log(this.product)
            })
        },
        addToCart() {
            this.$store.dispatch("addToCart", {
                product: this.product,
                quantity: 1
            });
        },
        removeFromCart() {
            this.$store.dispatch("removeFromCart", {
                product: this.product,
            });
        }
    },
    computed: {
        ...mapGetters({
            "cartItems": "items"
        }),
        cartItem() {
            return this.cartItems.find(item => item.product.id === this.product.id);
        }
    },

    mounted() {
        this.getProduct()
    }

}
</script>

<!--<template>-->

<!--    <div class="text-black">-->
<!--       hello Product-->
<!--    </div>-->

<!--</template>-->

<!--<script>-->
<!--export default {-->
<!--    name: "ProductView",-->

<!--}-->
<!--</script>-->


<!--<style scoped>-->

<!--</style>-->
