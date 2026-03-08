<script setup>
import { ref, reactive, onMounted, watch } from "vue";
import axios from "axios";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const products = ref([]);
const showModal = ref(false);
const preview = ref(null);
const editingId = ref(null);

const form = reactive({
  name: "",
  price: "",
  category: "",
  stock: "",
  image: null,
});

const search = ref("");
const currentPage = ref(1);
const lastPage = ref(1);

const loadProducts = async () => {
  const res = await axios.get("/api/products", {
    params: {
      search: search.value,
      page: currentPage.value,
    },
  });

  products.value = res.data.data;
  lastPage.value = res.data.last_page;
};

watch(search, () => {
  currentPage.value = 1;
  loadProducts();
});

onMounted(loadProducts);

const handleFile = (e) => {
  const file = e.target.files[0];
  form.image = file;
  preview.value = URL.createObjectURL(file);
};

const resetForm = () => {
  form.name = "";
  form.price = "";
  form.category = "";
  form.stock = "";
  form.image = null;
  preview.value = null;
  editingId.value = null;
};

const createProduct = async () => {
  const data = new FormData();

  data.append("name", form.name);
  data.append("price", form.price);
  data.append("category", form.category);
  data.append("stock", form.stock);

  if (form.image) {
    data.append("image", form.image);
  }

  if (editingId.value) {
    await axios.post(`/api/products/${editingId.value}?_method=PUT`, data);
  } else {
    await axios.post("/api/products", data);
  }

  showModal.value = false;
  resetForm();
  loadProducts();
};

const editProduct = (product) => {
  form.name = product.name;
  form.price = product.price;
  form.category = product.category;
  form.stock = product.stock;

  preview.value = product.image ? `/storage/${product.image}` : null;

  editingId.value = product.id;

  showModal.value = true;
};

const deleteProduct = async (id) => {
  if (!confirm("¿Eliminar producto?")) return;

  await axios.delete(`/api/products/${id}`);

  loadProducts();
};

const changePage = (page) => {
  currentPage.value = page;
  loadProducts();
};
</script>

<template>
  <AuthenticatedLayout>
    <div class="p-8">
      <!-- HEADER -->

      <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">📦 Productos</h1>

        <button
          @click="showModal = true"
          class="bg-blue-600 text-white px-4 py-2 rounded flex items-center gap-2"
        >
          ➕ Nuevo producto
        </button>
      </div>

      <!-- BUSCADOR -->

      <div class="mb-6">
        <input
          v-model="search"
          placeholder="🔎 Buscar producto..."
          class="border p-2 rounded w-64"
        />
      </div>

      <!-- LISTA PRODUCTOS -->

      <div class="grid grid-cols-4 gap-6">
        <div v-for="p in products" :key="p.id" class="bg-white p-4 rounded shadow">
          <img
            v-if="p.image"
            :src="`/storage/${p.image}`"
            class="w-full h-40 object-cover rounded mb-3"
          />

          <h2 class="font-bold">
            {{ p.name }}
          </h2>

          <p class="text-gray-500">$ {{ p.price }}</p>

          <p class="text-sm text-gray-400">Stock: {{ p.stock }}</p>

          <div class="flex gap-2 mt-3">
            <button
              @click="editProduct(p)"
              class="bg-yellow-500 text-white px-3 py-1 rounded"
            >
              ✏️ Editar
            </button>

            <button
              @click="deleteProduct(p.id)"
              class="bg-red-600 text-white px-3 py-1 rounded"
            >
              🗑 Eliminar
            </button>
          </div>
        </div>
      </div>

      <!-- PAGINACIÓN -->

      <div class="flex gap-2 mt-8 items-center">
        <button
          @click="changePage(currentPage - 1)"
          :disabled="currentPage === 1"
          class="px-3 py-1 bg-gray-300 rounded"
        >
          Anterior
        </button>

        <span> Página {{ currentPage }} de {{ lastPage }} </span>

        <button
          @click="changePage(currentPage + 1)"
          :disabled="currentPage === lastPage"
          class="px-3 py-1 bg-gray-300 rounded"
        >
          Siguiente
        </button>
      </div>

      <!-- MODAL -->

      <div
        v-if="showModal"
        class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center"
      >
        <div class="bg-white p-6 rounded-lg w-96">
          <h2 class="text-xl font-bold mb-4">
            {{ editingId ? "Editar Producto" : "Nuevo Producto" }}
          </h2>

          <input
            v-model="form.name"
            placeholder="Nombre"
            class="border p-2 w-full mb-2"
          />

          <input
            v-model="form.price"
            placeholder="Precio"
            type="number"
            class="border p-2 w-full mb-2"
          />

          <input
            v-model="form.category"
            placeholder="Categoría"
            class="border p-2 w-full mb-2"
          />

          <input
            v-model="form.stock"
            placeholder="Stock"
            type="number"
            class="border p-2 w-full mb-2"
          />

          <input type="file" @change="handleFile" class="mb-4" />

          <img
            v-if="preview"
            :src="preview"
            class="w-full h-40 object-cover mb-4 rounded"
          />

          <div class="flex justify-end gap-3">
            <button
              @click="showModal = false"
              class="px-4 py-2 bg-gray-400 text-white rounded"
            >
              Cancelar
            </button>

            <button
              @click="createProduct"
              class="px-4 py-2 bg-blue-600 text-white rounded"
            >
              {{ editingId ? "Actualizar" : "Guardar" }}
            </button>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
