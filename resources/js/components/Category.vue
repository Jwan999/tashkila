<template>
  <!--  <div @click="filter({category:category.name})" >{{ category.name }}</div>-->
  <!--  <button class="w-full">Add To Cart</button>-->


  <div class="mt-3 cursor-pointer">
    this compoenent is useless now

  </div>


</template>

<script>

export default {
  props: ["category"],
  name: "Category",
  data() {
    return {
      categories: [],
    }
  },
  methods: {},

}
</script>

<style scoped>

</style>