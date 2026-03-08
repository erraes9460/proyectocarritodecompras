<script setup>
import { Head } from "@inertiajs/vue3";
import { ref, computed, watch } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
  products: Array,
});

/*
-----------------------------------------
CARGAR CARRITO DESDE LOCALSTORAGE
-----------------------------------------
*/
const savedCart = JSON.parse(localStorage.getItem("cart")) || [];

/*
Filtrar productos que aún existen
*/
const cart = ref(
  savedCart.filter((item) => props.products.some((product) => product.id === item.id))
);

const showCart = ref(false);

/*
-----------------------------------------
GUARDAR AUTOMÁTICAMENTE EL CARRITO
-----------------------------------------
*/
watch(
  cart,
  () => {
    if (cart.value.length === 0) {
      localStorage.removeItem("cart");
    } else {
      localStorage.setItem("cart", JSON.stringify(cart.value));
    }
  },
  { deep: true }
);

/*
-----------------------------------------
AGREGAR PRODUCTO
-----------------------------------------
*/
const addToCart = (product) => {
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

/*
-----------------------------------------
SUMAR CANTIDAD
-----------------------------------------
*/
const increaseQty = (item) => {
  item.qty++;
};

/*
-----------------------------------------
RESTAR CANTIDAD
-----------------------------------------
*/
const decreaseQty = (item) => {
  if (item.qty > 1) {
    item.qty--;
  } else {
    removeItem(item);
  }
};

/*
-----------------------------------------
ELIMINAR PRODUCTO
-----------------------------------------
*/
const removeItem = (item) => {
  cart.value = cart.value.filter((p) => p.id !== item.id);
};

/*
-----------------------------------------
TOTAL DEL CARRITO
-----------------------------------------
*/
const cartTotal = computed(() => {
  return cart.value.reduce((total, item) => {
    return total + item.price * item.qty;
  }, 0);
});

/*
-----------------------------------------
CHECKOUT
-----------------------------------------
*/
const checkout = () => {
  router.post("/checkout", {
    cart: cart.value,
  });
};
</script>

<template>
  <Head title="Tienda" />

  <div class="max-w-7xl mx-auto p-10">
    <!-- HEADER -->

    <div class="flex justify-between items-center mb-8">
      <h1 class="text-3xl font-bold">🛒 Tienda</h1>

      <div class="relative">
        <button
          @click="showCart = !showCart"
          class="bg-gray-800 text-white px-4 py-2 rounded"
        >
          🛒 {{ cart.length }}
        </button>

        <!-- CARRITO -->

        <div
          v-if="showCart"
          class="absolute right-0 bg-white shadow-lg p-4 w-80 mt-2 rounded"
        >
          <div v-if="cart.length === 0">Carrito vacío</div>

          <div
            v-for="item in cart"
            :key="item.id"
            class="flex justify-between items-center mb-3"
          >
            <div>
              <p class="font-semibold">
                {{ item.name }}
              </p>

              <p class="text-sm text-gray-500">${{ item.price }}</p>
            </div>

            <!-- CONTROLES -->

            <div class="flex items-center gap-2">
              <button @click="decreaseQty(item)" class="bg-gray-200 px-2 rounded">
                -
              </button>

              <span>
                {{ item.qty }}
              </span>

              <button @click="increaseQty(item)" class="bg-gray-200 px-2 rounded">
                +
              </button>
            </div>

            <div class="text-right">
              <p>${{ item.price * item.qty }}</p>

              <button @click="removeItem(item)" class="text-red-500 text-sm">
                eliminar
              </button>
            </div>
          </div>

          <hr class="my-3" />

          <div class="flex justify-between font-bold">
            <span>Total</span>
            <span>${{ cartTotal }}</span>
          </div>

          <button
            @click="checkout"
            class="w-full mt-4 bg-green-600 text-white py-2 rounded"
          >
            Pagar
          </button>
        </div>
      </div>
    </div>

    <!-- PRODUCTOS -->

    <div class="grid grid-cols-4 gap-6">
      <div
        v-for="product in products"
        :key="product.id"
        class="bg-white p-6 rounded shadow"
      >
        <img
          v-if="product.image"
          :src="`/storage/${product.image}`"
          class="w-full h-40 object-cover rounded mb-3"
        />

        <h2 class="font-bold">
          {{ product.name }}
        </h2>

        <p class="text-gray-500">$ {{ product.price }}</p>

        <button
          @click="addToCart(product)"
          class="mt-4 bg-blue-600 text-white px-4 py-2 rounded w-full"
        >
          Agregar al carrito
        </button>
      </div>
    </div>
  </div>
</template>
