<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: Boolean,
});
</script>

<template>

    <Head title="Sistema de Gestión" />

    <div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white">

        <!-- NAVBAR -->

        <header class="flex justify-between items-center px-10 py-6">

            <h1 class="text-2xl font-bold tracking-wide">
                ⚙️ Sistema de Gestión
            </h1>

            <nav v-if="canLogin">

                <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                    class="bg-green-500 px-5 py-2 rounded-lg hover:bg-green-600">
                    Ir al Sistema
                </Link>

                <Link v-else :href="route('login')" class="bg-blue-500 px-5 py-2 rounded-lg hover:bg-blue-600">
                    Iniciar Sesión
                </Link>

            </nav>

        </header>


        <!-- HERO -->

        <div class="flex flex-col items-center justify-center text-center mt-32 px-6">

            <h2 class="text-5xl font-bold mb-6">
                Sistema de Ventas y Gestión
            </h2>

            <p class="text-gray-300 text-lg max-w-xl mb-10">
                Administra tus ventas, productos, clientes y reportes
                en una plataforma rápida, moderna y segura.
            </p>


            <div class="flex gap-6">

                <Link v-if="!$page.props.auth.user" :href="route('login')"
                    class="bg-blue-500 px-8 py-3 rounded-lg text-lg hover:bg-blue-600 transition">
                    Iniciar Sesión
                </Link>

                <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                    class="bg-green-500 px-8 py-3 rounded-lg text-lg hover:bg-green-600 transition">
                    Entrar al Sistema
                </Link>

            </div>

        </div>


        <!-- FEATURES -->

        <div class="mt-40 px-10">

            <div class="grid md:grid-cols-3 gap-10 max-w-6xl mx-auto">

                <div class="bg-white/10 p-8 rounded-xl backdrop-blur">
                    <div class="text-4xl mb-4">🛒</div>
                    <h3 class="text-xl font-semibold mb-2">Ventas</h3>
                    <p class="text-gray-300 text-sm">
                        Crea facturas y controla tus ventas fácilmente.
                    </p>
                </div>

                <div class="bg-white/10 p-8 rounded-xl backdrop-blur">
                    <div class="text-4xl mb-4">📦</div>
                    <h3 class="text-xl font-semibold mb-2">Inventario</h3>
                    <p class="text-gray-300 text-sm">
                        Gestiona productos y controla tu stock.
                    </p>
                </div>

                <div class="bg-white/10 p-8 rounded-xl backdrop-blur">
                    <div class="text-4xl mb-4">📊</div>
                    <h3 class="text-xl font-semibold mb-2">Reportes</h3>
                    <p class="text-gray-300 text-sm">
                        Analiza ventas y estadísticas del negocio.
                    </p>
                </div>

            </div>

        </div>


        <!-- FOOTER -->

        <footer class="text-center text-gray-400 mt-40 pb-10 text-sm">
            © {{ new Date().getFullYear() }} Sistema de Gestión
        </footer>

    </div>

</template>