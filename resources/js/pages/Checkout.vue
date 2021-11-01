<template>

  <div>
    <navbar></navbar>
    <div class="flex flex-wrap lg:px-24 px-4 mt-10">
      <div class="w-full flex flex-col">

        <div class="flex items-center justify-between mb-4">
          <h1 class="lg:text-3xl text-xl">
            المنتجات في السلة
          </h1>
          <button @click="goBack" class="lg:py-3 py-3 px-4 lg:px-6 bg-gray-700 focus:bg-gray-800 text-white rounded-2xl shadow-lg">
            الرجوع
          </button>
        </div>

        <div class="grid lg:grid-cols-4 grid-cols-1 gap-8">
          <product :show-buttons="true" v-for="item in items" :product="item.product"
                   :key="`product-1-${item.product.id}`"></product>
        </div>


      </div>

      <div class="flex flex-wrap lg:space-y-0 space-y-10 w-full justify-between lg:mt-20 mt-10">
        <div class="lg:w-7/12 w-full">
          <div class="bg-white shadow-lg rounded-2xl p-6 flex flex-col">
          </div>
        </div>
        <div class="lg:w-4/12 w-full">
          <div class="bg-white shadow-lg rounded-2xl p-6 flex flex-col">
            <p class="text-xl">
              عدد المنتجات {{ items.length }}
            </p>
            <div class="border-t border-gray-500 my-3"></div>
            <p class="text-xl">
              السعر الكامل {{ total }}
            </p>

            <button
                @click="checkout"
                class="bg-red-500 focus:bg-red-600-500 py-3 px-4 text-white rounded-2xl shadow-lg mt-6 hover:bg-red-600 cursor-pointer">
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
  computed: {
    ...mapGetters(["items", "total"]),
  },
  methods: {
    checkout() {
      axios.post('/api/orders', {
        items: this.items,
        total: this.total
      }).then(response => {
        console.log('your items have been purchased')
      })
    },
    goBack() {
      this.$router.back();
    }
  }

}
</script>

<style scoped>

</style>
