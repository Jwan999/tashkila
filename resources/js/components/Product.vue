<template>


    <div class="shadow-md hover:shadow-xl bg-white rounded flex flex-col">
        <!--        <div class="z-10">-->
        <!--            <template v-if="showButtons">-->
        <!--                <div v-if="cartItem" class="grid grid-cols-4 w-5/12 -mb-16 z-10">-->
        <!--                    <button-->
        <!--                        @click="removeFromCart"-->
        <!--                        class="bg-dark-100 text-white py-1 px-2 font-semibold text-xl rounded-tr hover:bg-dark-200 cursor-pointer col-span-1">-->
        <!--            <span class="flex justify-center">-->
        <!--                <svg class="fill-current text-white w-6 h-6" viewBox="0 0 24 24"-->
        <!--                     xmlns="http://www.w3.org/2000/svg"><path-->
        <!--                    d="M18 12.75H6C5.59 12.75 5.25 12.41 5.25 12C5.25 11.59 5.59 11.25 6 11.25H18C18.41 11.25 18.75 11.59 18.75 12C18.75 12.41 18.41 12.75 18 12.75Z"/></svg>-->

        <!--            </span>-->
        <!--                    </button>-->
        <!--                    <span-->
        <!--                        class="col-span-2 flex items-center justify-center font-mono text-sm font-bold bg-gray-100">{{-->
        <!--                            cartItem.quantity-->
        <!--                        }}</span>-->
        <!--                    <button-->
        <!--                        @click="addToCart"-->
        <!--                        class="bg-orange-100 text-white py-1 px-2 font-semibold text-xl rounded-bl hover:bg-orange-200 cursor-pointer col-span-1">-->
        <!--            <span class="flex justify-center">-->
        <!--              <svg class="fill-current text-white w-6 h-6" viewBox="0 0 24 24"-->
        <!--                   xmlns="http://www.w3.org/2000/svg"><path-->
        <!--                  d="M18 12.75H6C5.59 12.75 5.25 12.41 5.25 12C5.25 11.59 5.59 11.25 6 11.25H18C18.41 11.25 18.75 11.59 18.75 12C18.75 12.41 18.41 12.75 18 12.75Z"/><path-->
        <!--                  d="M12 18.75C11.59 18.75 11.25 18.41 11.25 18V6C11.25 5.59 11.59 5.25 12 5.25C12.41 5.25 12.75 5.59 12.75 6V18C12.75 18.41 12.41 18.75 12 18.75Z"/>-->
        <!--              </svg>-->

        <!--            </span>-->
        <!--                    </button>-->
        <!--                </div>-->
        <!--                <div v-else class="grid grid-cols-5 justify-items-start w-5/12 -mb-10 z-10">-->
        <!--                    <button-->
        <!--                        @click="addToCart"-->
        <!--                        class="bg-orange-100 text-white font-english rounded-bl rounded-tr px-4 py-1 cursor-pointer col-span-5 relative">-->
        <!--                        &lt;!&ndash;                          <span&ndash;&gt;-->
        <!--                        &lt;!&ndash;                              class="text-dark-100 english-font text-sm font-semibold bg-orange-100 rounded-full w-5 h-5 text-center content-center absolute top-0 -mt-2">tst</span>&ndash;&gt;-->
        <!--                        &lt;!&ndash;                        <span class="text-white content-center text-sm rounded-full w-5 h-5 english-font absolute top-0 -mt-2 bg-orange-100">&ndash;&gt;-->
        <!--                        &lt;!&ndash;                            +&ndash;&gt;-->
        <!--                        &lt;!&ndash;                        </span>&ndash;&gt;-->
        <!--                        add to cart-->
        <!--                    </button>-->
        <!--                </div>-->
        <!--            </template>-->
        <!--        </div>-->
        <div>
            <a :href="'product/'+product.id">
                <img class="rounded-t h-96 w-full object-cover hover:opacity-90"
                     :src="'/storage/'+product.preview_img"
                     alt="">
            </a>

        </div>
        <div class="flex justify-between -mt-8 z-10">
            <div class="">
                <template v-if="showButtons">
                    <div v-if="cartItem" class="grid grid-cols-4">
                        <button
                            @click="removeFromCart"
                            class="bg-dark-100 rounded-br text-white py-1 px-2 font-semibold text-xl hover:bg-dark-200 cursor-pointer col-span-1">
                            <span class="flex justify-center">
                <svg class="fill-current text-white w-6 h-6" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M18 12.75H6C5.59 12.75 5.25 12.41 5.25 12C5.25 11.59 5.59 11.25 6 11.25H18C18.41 11.25 18.75 11.59 18.75 12C18.75 12.41 18.41 12.75 18 12.75Z"/></svg>

            </span>
                        </button>
                        <span
                            class="col-span-2 flex items-center justify-center font-mono text-sm font-bold bg-gray-100">
                            {{ cartItem.quantity }}
                        </span>
                        <button
                            @click="addToCart"
                            class="bg-orange-100 text-white py-1 px-2 font-semibold text-xl rounded-tl hover:bg-orange-200 cursor-pointer col-span-1">
                            <span class="flex justify-center">
              <svg class="fill-current text-white w-6 h-6" viewBox="0 0 24 24"
                   xmlns="http://www.w3.org/2000/svg">
                  <path
                      d="M18 12.75H6C5.59 12.75 5.25 12.41 5.25 12C5.25 11.59 5.59 11.25 6 11.25H18C18.41 11.25 18.75 11.59 18.75 12C18.75 12.41 18.41 12.75 18 12.75Z"/><path
                  d="M12 18.75C11.59 18.75 11.25 18.41 11.25 18V6C11.25 5.59 11.59 5.25 12 5.25C12.41 5.25 12.75 5.59 12.75 6V18C12.75 18.41 12.41 18.75 12 18.75Z"/>
              </svg>

            </span>
                        </button>
                    </div>
                    <div v-else class="grid justify-items-start z-10">
                        <button @click="addToCart"
                                class="bg-orange-100 text-white font-english rounded-tl rounded-br px-4 py-1 cursor-pointer w-full font-bold">
                            add to cart
                        </button>
                    </div>
                </template>
            </div>
            <div>
                <h1 class="bg-dark-100 text-white rounded-tr rounded-bl px-3 py-1 font-bold">
                    IQD {{ product.final_price }}
                </h1>
            </div>

        </div>

        <!--    <h3 class="font-bold text-lg"></h3>-->
        <!--        <div class="px-3 py-4">-->
        <!--            <h3 class="font-bold text-lg ">{{ product.name }}</h3>-->
        <!--            <h3 class="font-mono text-md ">{{ product.final_price }}</h3>-->
        <!--            <h3 class="font-mono text-md ">original price {{ product.price }}</h3>-->
        <!--            <div class="border border-b-[0.5px] border-gray-300 w-full my-2"></div>-->
        <!--            <template v-if="showButtons">-->
        <!--                <div v-if="cartItem" class="grid grid-cols-4">-->
        <!--                    <button-->
        <!--                        @click="removeFromCart"-->
        <!--                        class="bg-dark-100 text-white py-2 px-4 font-semibold text-xl rounded my-1 hover:bg-dark-200 cursor-pointer col-span-1">-->
        <!--            <span class="flex justify-center">-->
        <!--                <svg class="fill-current text-white w-8 h-8" viewBox="0 0 24 24"-->
        <!--                     xmlns="http://www.w3.org/2000/svg"><path-->
        <!--                    d="M18 12.75H6C5.59 12.75 5.25 12.41 5.25 12C5.25 11.59 5.59 11.25 6 11.25H18C18.41 11.25 18.75 11.59 18.75 12C18.75 12.41 18.41 12.75 18 12.75Z"/></svg>-->

        <!--            </span>-->
        <!--                    </button>-->
        <!--                    <span-->
        <!--                        class="col-span-2 flex items-center justify-center font-mono text-lg">{{-->
        <!--                            cartItem.quantity-->
        <!--                        }}</span>-->
        <!--                    <button-->
        <!--                        @click="addToCart"-->
        <!--                        class="bg-orange-100 text-white py-2 px-4 font-semibold text-xl rounded my-1 hover:bg-orange-200 cursor-pointer col-span-1">-->
        <!--            <span class="flex justify-center">-->
        <!--              <svg class="fill-current text-white w-8 h-8" viewBox="0 0 24 24"-->
        <!--                   xmlns="http://www.w3.org/2000/svg"><path-->
        <!--                  d="M18 12.75H6C5.59 12.75 5.25 12.41 5.25 12C5.25 11.59 5.59 11.25 6 11.25H18C18.41 11.25 18.75 11.59 18.75 12C18.75 12.41 18.41 12.75 18 12.75Z"/><path-->
        <!--                  d="M12 18.75C11.59 18.75 11.25 18.41 11.25 18V6C11.25 5.59 11.59 5.25 12 5.25C12.41 5.25 12.75 5.59 12.75 6V18C12.75 18.41 12.41 18.75 12 18.75Z"/>-->
        <!--              </svg>-->

        <!--            </span>-->
        <!--                    </button>-->
        <!--                </div>-->
        <!--                <div v-else class="grid grid-cols-5">-->
        <!--                    <button-->
        <!--                        @click="addToCart"-->
        <!--                        class="bg-orange-100 focus:bg-dark py-3 px-4 text-white rounded shadow-lg my-1 hover:bg-orange-200 cursor-pointer col-span-5">-->
        <!--                        اضافة الى السلة-->
        <!--                    </button>-->
        <!--                </div>-->
        <!--            </template>-->
        <!--        </div>-->
    </div>
</template>

<script>
import {mapGetters} from 'vuex';

export default {
    props: {
        product: {
            type: Object,
            required: false,
        },
        showButtons: {
            type: Boolean,
            default() {
                return true;
            }
        }
    },
    name: "Product",
    methods: {

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
    }

}
</script>

<style scoped>

</style>
