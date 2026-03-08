<script setup>
import { Head, Link } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Mi cuenta" />

    <div class="max-w-6xl mx-auto p-8">
      <h1 class="text-3xl font-bold mb-8">Mi cuenta</h1>

      <div class="grid md:grid-cols-2 gap-6">
        <!-- Compras -->
        <Link href="/orders">
          <div class="bg-white p-6 rounded shadow">
            <h2 class="font-semibold">Compras</h2>
            <p class="text-gray-600">Ver historial de pedidos</p>
          </div>
        </Link>

        <!-- Perfil -->
        <Link href="/profile">
          <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <h2 class="text-lg font-semibold">Perfil</h2>
            <p class="text-gray-600 mt-2">Actualizar datos</p>
          </div>
        </Link>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
