<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

const props = defineProps({
  ventas: Number,
  productos: Number,
  clientes: Number,
  pedidos: Number,
});
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Reportes" />

    <div class="max-w-6xl mx-auto p-10">
      <h1 class="text-3xl font-bold mb-8">Reportes del sistema</h1>

      <div class="grid grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded shadow">
          <h2 class="text-gray-500">Ventas totales</h2>
          <p class="text-2xl font-bold">${{ ventas }}</p>
        </div>

        <div class="bg-white p-6 rounded shadow">
          <h2 class="text-gray-500">Productos</h2>
          <p class="text-2xl font-bold">{{ productos }}</p>
        </div>

        <div class="bg-white p-6 rounded shadow">
          <h2 class="text-gray-500">Clientes</h2>
          <p class="text-2xl font-bold">{{ clientes }}</p>
        </div>

        <div class="bg-white p-6 rounded shadow">
          <h2 class="text-gray-500">Pedidos</h2>
          <p class="text-2xl font-bold">{{ pedidos }}</p>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
