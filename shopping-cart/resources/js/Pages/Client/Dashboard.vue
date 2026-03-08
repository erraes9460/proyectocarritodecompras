<script setup>
import { Head } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props = defineProps({
  cart: Array,
});
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Mi cuenta" />

    <div class="max-w-6xl mx-auto p-10">
      <h1 class="text-3xl font-bold mb-6">Mi cuenta</h1>

      <div v-if="cart.length > 0" class="bg-yellow-100 p-4 rounded mb-6">
        Tienes {{ cart.length }} productos pendientes en tu carrito.
      </div>

      <div class="grid grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded shadow">
          <h2 class="font-bold mb-2">Compras</h2>
          <p>Ver historial de pedidos</p>
        </div>

        <div class="bg-white p-6 rounded shadow">
          <h2 class="font-bold mb-2">Perfil</h2>
          <p>Actualizar datos</p>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
