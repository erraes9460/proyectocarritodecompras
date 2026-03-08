<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

defineProps({
  canResetPassword: Boolean,
  status: String,
});

const form = useForm({
  email: "",
  password: "",
  remember: false,
});

const submit = () => {
  form.post(route("login"), {
    onSuccess: () => {
      const cart = JSON.parse(localStorage.getItem("cart") || "[]");

      if (cart.length > 0) {
        window.location.href = "/checkout";
      } else {
        window.location.href = "/dashboard";
      }
    },

    onFinish: () => form.reset("password"),
  });
};
</script>

<template>
  <Head title="Iniciar sesión" />

  <div class="min-h-screen flex">
    <!-- IZQUIERDA -->

    <div
      class="hidden lg:flex w-1/2 bg-gradient-to-br from-indigo-600 to-blue-700 items-center justify-center text-white"
    >
      <div class="text-center">
        <h1 class="text-4xl font-bold mb-4">Tienda Online</h1>

        <p class="text-lg opacity-90">Compra productos de forma rápida y segura</p>

        <div class="text-7xl mt-8">🛒</div>
      </div>
    </div>

    <!-- LOGIN -->

    <div class="flex w-full lg:w-1/2 items-center justify-center bg-gray-100">
      <div class="w-full max-w-md bg-white p-8 rounded-xl shadow">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Bienvenido</h2>

        <p class="text-gray-500 mb-6">Inicia sesión para continuar con tu compra</p>

        <form @submit.prevent="submit">
          <div>
            <InputLabel for="email" value="Correo electrónico" />
            <TextInput
              id="email"
              type="email"
              class="mt-1 block w-full"
              v-model="form.email"
            />
            <InputError class="mt-2" :message="form.errors.email" />
          </div>

          <div class="mt-4">
            <InputLabel for="password" value="Contraseña" />
            <TextInput
              id="password"
              type="password"
              class="mt-1 block w-full"
              v-model="form.password"
            />
            <InputError class="mt-2" :message="form.errors.password" />
          </div>

          <div class="flex items-center justify-between mt-4">
            <label class="flex items-center text-sm text-gray-600">
              <Checkbox name="remember" v-model:checked="form.remember" />
              <span class="ml-2">Recordarme</span>
            </label>

            <Link
              v-if="canResetPassword"
              :href="route('password.request')"
              class="text-sm text-blue-600 hover:underline"
            >
              ¿Olvidaste tu contraseña?
            </Link>
          </div>

          <PrimaryButton
            class="w-full mt-6 justify-center"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
          >
            Iniciar sesión
          </PrimaryButton>
        </form>

        <!-- REGISTRO -->

        <div class="mt-6 text-center text-sm text-gray-600">
          ¿No tienes cuenta?

          <Link
            :href="route('register')"
            class="text-blue-600 font-semibold hover:underline"
          >
            Crear cuenta
          </Link>
        </div>
      </div>
    </div>
  </div>
</template>
