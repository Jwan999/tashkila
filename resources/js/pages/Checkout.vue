<template>

  <div>
    <navbar></navbar>
    <div class="grid grid-cols-12 gap-4 lg:px-24 px-4 mt-10">
      <div class="col-span-7 flex flex-col">
        <div class="flex">
          <button class="mb-2 text-lg" @click="goBack">Back</button>
        </div>
        <div class="grid grid-cols-3">
          <product :show-buttons="true" v-for="item in items" :product="item.product"
                   :key="`product-1-${item.product.id}`"></product>
        </div>


      </div>
      <div class="col-span-5">
        <div class="bg-white shadow rounded-lg p-4 flex flex-col">
          Checkout ({{ total }})

          <button
              @click="checkout"
              class="bg-blue-500 text-white p-2 rounded my-1 hover:bg-blue-600 cursor-pointer col-span-5">
            Checkout
          </button>
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
