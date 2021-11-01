<!--<template>-->
<!--  <div>-->
<!--    <router-link :to="{path:'/'}">Go Back</router-link>-->
<!--    <router-link :to="{path:'/checkout'}">Checkout</router-link>-->

<!--    <h1>There's <span>{{ items.length }}</span> in cart with total {{ total }}</h1>-->
<!--    <div class="flex justify-between">-->
<!--      <div class="w-2/12 ml-6 sticky top-0 flex-start">-->
<!--        <div class="bg-gray-50 p-4 rounded-2xl">-->
<!--          <h1 class="text-xl mb-3 font-bold">ابحث عن منتج معين</h1>-->
<!--          <input type="text"-->
<!--                 class="rounded-2xl py-4 px-4 focus:outline-none w-full border-2 border-blue-100 focus:border-blue-400"-->
<!--                 placeholder="البحث">-->
<!--          <h1 class="text-xl my-3 font-bold">-->
<!--            الفئات:-->
<!--          </h1>-->
<!--          &lt;!&ndash;          <category  :key="`category-${category.id}`"&ndash;&gt;-->
<!--          &lt;!&ndash;                    :category="category"></category>&ndash;&gt;-->
<!--          <h1 @click="getProducts(null)"-->
<!--              class="text-xl text-blue-500 hover:bg-blue-100 items-center px-4 py-2 rounded-2xl font-bold">-->
<!--            All-->
<!--          </h1>-->
<!--          <div v-for="category in categories">-->
<!--            <h1 @click="getProducts(category.id)"-->
<!--                class="text-xl text-blue-500 hover:bg-blue-100 items-center px-4 py-2 rounded-2xl font-bold">-->
<!--              {{ category.name }}-->
<!--            </h1>-->
<!--          </div>-->

<!--        </div>-->
<!--      </div>-->

<!--      <div class="grid lg:grid-cols-3 grid-cols-1 gap-10 justify-items-center w-9/12 mb-10">-->
<!--        &lt;!&ndash;    // loop through the products array, create a <product> component for each and pass the object as 'product' prop&ndash;&gt;-->
<!--        <product v-for="product in products" :hide-price="true" :key="`product-${product.id}`"-->
<!--                 :product="product"></product>-->


<!--      </div>-->
<!--    </div>-->

<!--  </div>-->
<!--</template>-->


<!--<script>-->

<!--import {mapGetters} from 'vuex';-->
<!--import axios from 'axios';-->
<!--import Product from "../components/Product";-->
<!--import Category from "../components/Category";-->


<!--export default {-->
<!--  components: {-->
<!--    Product-->
<!--  },-->
<!--  name: "Products",-->
<!--  data() {-->
<!--    return {-->
<!--      products: [],-->
<!--      categories: []-->
<!--    }-->
<!--  },-->
<!--  computed: {-->
<!--    items() {-->
<!--      return this.$store.getters.items;-->
<!--    },-->
<!--    total() {-->
<!--      return this.$store.getters.total;-->
<!--    },-->
<!--    // ...mapGetters(["total"])-->
<!--  },-->
<!--  methods: {-->
<!--    getProducts(category) {-->
<!--      // console.log(category)-->
<!--      axios.get('/api/products', {-->
<!--        params: {-->
<!--          category: category,-->
<!--        }-->
<!--      }).then(response => {-->
<!--        console.log(response)-->
<!--        this.products = response.data.products;-->
<!--      })-->
<!--    }-->
<!--  },-->
<!--  mounted() {-->
<!--    this.getProducts()-->
<!--    axios.get('/api/categories').then(response => {-->
<!--      this.categories = response.data.categories-->
<!--      // console.log(response)-->

<!--    });-->
<!--  }-->
<!--}-->
<!--</script>-->

<!--<style scoped>-->

<!--</style>-->