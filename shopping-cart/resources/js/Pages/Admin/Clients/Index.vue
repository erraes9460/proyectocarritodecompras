<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps({
  clients: Array,
});

const showModal = ref(false);
const editMode = ref(false);

const form = ref({
  id: null,
  name: "",
  email: "",
  password: "",
});

const openCreate = () => {
  editMode.value = false;

  form.value = {
    id: null,
    name: "",
    email: "",
    password: "",
  };

  showModal.value = true;
};

const openEdit = (client) => {
  editMode.value = true;

  form.value = {
    id: client.id,
    name: client.name,
    email: client.email,
    password: "",
  };

  showModal.value = true;
};

const saveClient = () => {
  if (editMode.value) {
    router.put(`/admin/clients/${form.value.id}`, form.value);
  } else {
    router.post("/admin/clients", form.value);
  }

  showModal.value = false;
};

const deleteClient = (id) => {
  if (confirm("¿Eliminar cliente?")) {
    router.delete(`/admin/clients/${id}`);
  }
};
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Clientes" />

    <div class="max-w-6xl mx-auto p-10">
      <div class="flex justify-between mb-6">
        <h1 class="text-3xl font-bold">Clientes</h1>

        <button @click="openCreate" class="bg-blue-600 text-white px-4 py-2 rounded">
          Nuevo cliente
        </button>
      </div>

      <table class="w-full bg-white shadow rounded">
        <thead class="bg-gray-100">
          <tr>
            <th class="p-3">ID</th>
            <th class="p-3">Nombre</th>
            <th class="p-3">Email</th>
            <th class="p-3">Acciones</th>
          </tr>
        </thead>

        <tbody>
          <tr v-for="client in clients" :key="client.id" class="border-t">
            <td class="p-3">{{ client.id }}</td>
            <td class="p-3">{{ client.name }}</td>
            <td class="p-3">{{ client.email }}</td>

            <td class="p-3 flex gap-3">
              <button @click="openEdit(client)" class="text-blue-600">Editar</button>

              <button @click="deleteClient(client.id)" class="text-red-600">
                Eliminar
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- MODAL -->

    <div
      v-if="showModal"
      class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center"
    >
      <div class="bg-white p-6 rounded w-96">
        <h2 class="text-xl font-bold mb-4">
          {{ editMode ? "Editar Cliente" : "Nuevo Cliente" }}
        </h2>

        <input v-model="form.name" placeholder="Nombre" class="w-full border p-2 mb-3" />

        <input v-model="form.email" placeholder="Email" class="w-full border p-2 mb-3" />

        <input
          v-if="!editMode"
          type="password"
          v-model="form.password"
          placeholder="Password"
          class="w-full border p-2 mb-3"
        />

        <div class="flex justify-end gap-3">
          <button @click="showModal = false" class="px-4 py-2 bg-gray-300 rounded">
            Cancelar
          </button>

          <button @click="saveClient" class="px-4 py-2 bg-green-600 text-white rounded">
            Guardar
          </button>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
