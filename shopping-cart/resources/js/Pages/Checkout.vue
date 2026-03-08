<script setup>
import { Head, router } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props = defineProps({
  cart: Array,
});

const confirmOrder = () => {
  router.post("/orders");
};
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Checkout" />

    <div class="max-w-5xl mx-auto p-10">
      <h1 class="text-3xl font-bold mb-6">Checkout</h1>

      <div v-if="cart.length">
        <table class="w-full border mb-6">
          <thead>
            <tr class="bg-gray-200">
              <th class="p-2 text-left">Producto</th>
              <th class="p-2 text-left">Precio</th>
              <th class="p-2 text-left">Cantidad</th>
              <th class="p-2 text-left">Subtotal</th>
            </tr>
          </thead>

          <tbody>
            <tr v-for="item in cart" :key="item.id">
              <td class="p-2">{{ item.name }}</td>
              <td class="p-2">${{ item.price }}</td>
              <td class="p-2">{{ item.qty }}</td>
              <td class="p-2">${{ item.price * item.qty }}</td>
            </tr>
          </tbody>
        </table>

        <button
          @click="confirmOrder"
          class="bg-green-600 text-white px-6 py-3 rounded hover:bg-green-700"
        >
          Confirmar Pedido
        </button>
      </div>

      <p v-else class="text-gray-500">Tu carrito está vacío</p>
    </div>
  </AuthenticatedLayout>
</template>
