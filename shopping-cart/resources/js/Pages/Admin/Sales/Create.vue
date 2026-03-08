<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router } from "@inertiajs/vue3";
import { ref, computed } from "vue";

const props = defineProps({
  clients: Array,
  products: Array,
});

const client_id = ref("");

const cart = ref([]);

const addProduct = (product) => {
  const existing = cart.value.find((p) => p.id === product.id);

  if (existing) {
    existing.qty++;
  } else {
    cart.value.push({
      ...product,
      qty: 1,
    });
  }
};

const total = computed(() => {
  return cart.value.reduce((sum, item) => {
    return sum + item.price * item.qty;
  }, 0);
});

const saveSale = () => {
  router.post("/admin/sales", {
    client_id: client_id.value,
    items: cart.value,
  });
};
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Nueva Venta" />

    <div class="max-w-6xl mx-auto p-10">
      <h1 class="text-3xl font-bold mb-6">Nueva Venta</h1>

      <select v-model="client_id" class="border p-2 mb-6">
        <option value="">Seleccionar cliente</option>

        <option v-for="client in clients" :key="client.id" :value="client.id">
          {{ client.name }}
        </option>
      </select>

      <div class="grid grid-cols-4 gap-4 mb-6">
        <div v-for="product in products" :key="product.id" class="border p-4">
          <h2>{{ product.name }}</h2>

          <p>${{ product.price }}</p>

          <button
            @click="addProduct(product)"
            class="bg-blue-600 text-white px-2 py-1 mt-2"
          >
            Agregar
          </button>
        </div>
      </div>

      <h2 class="text-xl font-bold mb-3">Productos</h2>

      <div v-for="item in cart" :key="item.id" class="flex justify-between border-b py-2">
        <span> {{ item.name }} x {{ item.qty }} </span>

        <span> ${{ item.price * item.qty }} </span>
      </div>

      <div class="text-xl font-bold mt-6">Total: ${{ total }}</div>

      <button @click="saveSale" class="bg-green-600 text-white px-6 py-2 mt-4">
        Guardar Venta
      </button>
    </div>
  </AuthenticatedLayout>
</template>
