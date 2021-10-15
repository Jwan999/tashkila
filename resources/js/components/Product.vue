<template>
  <div class="shadow-lg bg-white rounded-2xl flex flex-col">
    <img class="rounded-t-2xl border-t-4 border-blue-500" :src="'storage/'+product.preview_img" alt="">
    <!--    <h3 class="font-bold text-lg"></h3>-->
    <div class="px-3 py-4">
      <h3 class="font-bold text-lg ">{{ product.name }}</h3>
      <h3 class="font-mono text-md ">{{ product.price }}</h3>
      <div class="border border-b-[0.5px] border-gray-300 w-full my-2"></div>
      <template v-if="showButtons">
        <div v-if="cartItem" class="grid grid-cols-4">
          <button @click="removeFromCart"
                  class="bg-red-500 text-white py-4 px-6 font-semibold text-xl rounded-2xl my-1 hover:bg-red-600 cursor-pointer col-span-1">
            －
          </button>
          <span
              class="col-span-2 flex items-center justify-center font-mono text-lg">{{ cartItem.quantity }}</span>
          <button
              @click="addToCart"
              class="bg-blue-500 text-white py-4 px-6 font-semibold text-xl rounded-2xl my-1 hover:bg-blue-600 cursor-pointer col-span-1">
            <span>＋</span>
          </button>
        </div>
        <div v-else class="grid grid-cols-5 ">
          <button
              @click="addToCart"
              class="bg-blue-500 py-4 px-6 text-white rounded-2xl shadow-lg my-1 hover:bg-blue-600 cursor-pointer col-span-5">
            اضافة الى السلة
          </button>
        </div>
      </template>
    </div>
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
