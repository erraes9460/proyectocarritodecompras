<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

const props = defineProps({
  orders: Array,
});
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Mis compras" />

    <div class="max-w-6xl mx-auto p-10">
      <h1 class="text-3xl font-bold mb-6">Historial de compras</h1>

      <div v-if="orders.length === 0">No tienes compras todavía</div>

      <div
        v-for="order in orders"
        :key="order.id"
        class="bg-white p-6 rounded shadow mb-4"
      >
        <div class="flex justify-between">
          <div>Pedido #{{ order.id }}</div>

          <div>${{ order.total }}</div>
        </div>

        <div class="text-gray-500 text-sm">Estado: {{ order.status }}</div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
