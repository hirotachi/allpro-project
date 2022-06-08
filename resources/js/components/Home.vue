<template>
    <div class="home">
        <Form/>
        <Table/>
    </div>
</template>
<script setup>
import {ref, provide, onMounted, computed} from 'vue';
import Table from "./Table";
import Form from "./Form";

const products = ref([]);
provide('products', products);

const addProduct = (product) => {
    products.value = [product, ...products.value];
}
provide('addProduct', addProduct);

const removeProduct = (id) => {
    products.value = products.value.filter(product => product.id !== id);
}
provide('removeProduct', removeProduct);

onMounted(() => {
    fetch('/api/products')
        .then(res => res.json())
        .then(res => {
            products.value = res.data;
        })
        .catch(err => console.log(err));
});
</script>

<style>
.home{
    display: flex;
    flex-direction: column;
    gap: 2rem;
}
</style>
