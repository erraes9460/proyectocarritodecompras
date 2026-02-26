<script setup>
    import { ref, onMounted } from 'vue'
    import axios from 'axios'

    const products = ref([])

    onMounted(async () => {
        const res = await axios.get('/api/products')
        products.value = res.data
    })
</script>

<template>
    <h1>Productos</h1>

    <ul>
        <li v-for="p in products" :key="p.id">
            {{ p.name }} - ${{ p.price }}
        </li>
    </ul>
</template>