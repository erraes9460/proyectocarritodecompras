<script setup>
import { Head } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const confirmOrder = () => {
  router.post("/orders");
};
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Checkout" />

    <h1 class="text-3xl font-bold">Checkout</h1>
  </AuthenticatedLayout>
</template>
