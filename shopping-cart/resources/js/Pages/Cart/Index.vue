<script setup>
import { router } from "@inertiajs/vue3";

defineProps({
  cart: Array,
});

const removeItem = (id) => {
  router.delete(route("cart.remove", id));
};
</script>

<template>
  <h1>Mi carrito</h1>

  <div v-for="item in cart" :key="item.id">
    <p>{{ item.product.name }}</p>
    <p>{{ item.quantity }}</p>
    <p>${{ item.product.price }}</p>

    <button @click="removeItem(item.id)">Eliminar</button>
  </div>
</template>
