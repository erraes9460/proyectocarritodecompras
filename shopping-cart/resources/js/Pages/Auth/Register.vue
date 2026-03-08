<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const form = useForm({
  name: "",
  email: "",
  phone: "",
  address: "",
  password: "",
  password_confirmation: "",
});

const submit = () => {
  form.post(route("register"), {
    onFinish: () => form.reset("password", "password_confirmation"),
  });
};
</script>

<template>
  <GuestLayout>
    <Head title="Registro" />

    <form @submit.prevent="submit" class="space-y-4">
      <!-- NOMBRE -->

      <div>
        <InputLabel for="name" value="Nombre completo" />

        <TextInput
          id="name"
          type="text"
          class="mt-1 block w-full"
          v-model="form.name"
          required
          autofocus
        />

        <InputError class="mt-2" :message="form.errors.name" />
      </div>

      <!-- EMAIL -->

      <div>
        <InputLabel for="email" value="Correo electrónico" />

        <TextInput
          id="email"
          type="email"
          class="mt-1 block w-full"
          v-model="form.email"
          required
        />

        <InputError class="mt-2" :message="form.errors.email" />
      </div>

      <!-- TELEFONO -->

      <div>
        <InputLabel for="phone" value="Teléfono" />

        <TextInput
          id="phone"
          type="text"
          class="mt-1 block w-full"
          v-model="form.phone"
        />

        <InputError class="mt-2" :message="form.errors.phone" />
      </div>

      <!-- DIRECCION -->

      <div>
        <InputLabel for="address" value="Dirección" />

        <TextInput
          id="address"
          type="text"
          class="mt-1 block w-full"
          v-model="form.address"
        />

        <InputError class="mt-2" :message="form.errors.address" />
      </div>

      <!-- PASSWORD -->

      <div>
        <InputLabel for="password" value="Contraseña" />

        <TextInput
          id="password"
          type="password"
          class="mt-1 block w-full"
          v-model="form.password"
          required
        />

        <InputError class="mt-2" :message="form.errors.password" />
      </div>

      <!-- CONFIRM PASSWORD -->

      <div>
        <InputLabel for="password_confirmation" value="Confirmar contraseña" />

        <TextInput
          id="password_confirmation"
          type="password"
          class="mt-1 block w-full"
          v-model="form.password_confirmation"
          required
        />

        <InputError class="mt-2" :message="form.errors.password_confirmation" />
      </div>

      <!-- BOTONES -->

      <div class="flex items-center justify-between pt-4">
        <Link :href="route('login')" class="text-sm text-gray-600 hover:text-gray-900">
          ¿Ya tienes cuenta?
        </Link>

        <PrimaryButton
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Registrarse
        </PrimaryButton>
      </div>
    </form>
  </GuestLayout>
</template>
