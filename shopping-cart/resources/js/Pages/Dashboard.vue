<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold text-gray-800">Panel de Control</h2>
    </template>

    <div class="py-10">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- TARJETAS -->

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
          <Link
            href="/admin/sales/create"
            class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition"
          >
            <div class="text-4xl mb-3">🛒</div>
            <h3 class="font-semibold text-lg">Nueva Venta</h3>
            <p class="text-gray-500 text-sm">Crear una venta o factura</p>
          </Link>

          <Link
            href="/products"
            class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition"
          >
            <div class="text-4xl mb-3">📦</div>
            <h3 class="font-semibold text-lg">Productos</h3>
            <p class="text-gray-500 text-sm">Administrar inventario</p>
          </Link>

          <Link
            href="/admin/clients"
            class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition"
          >
            <div class="text-4xl mb-3">👥</div>
            <h3 class="font-semibold text-lg">Clientes</h3>
            <p class="text-gray-500 text-sm">Gestionar clientes</p>
          </Link>

          <Link
            href="/admin/reports"
            class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition"
          >
            <div class="text-4xl mb-3">📊</div>
            <h3 class="font-semibold text-lg">Reportes</h3>
            <p class="text-gray-500 text-sm">Estadísticas del sistema</p>
          </Link>
        </div>

        <!-- ESTADISTICAS -->
      </div>
    </div>
  </AuthenticatedLayout>
</template>
