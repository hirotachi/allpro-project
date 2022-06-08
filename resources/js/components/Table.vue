<template>
    <div class="container flex justify-center mx-auto">
        <div class="flex flex-col">
            <div class="w-full">
                <div class="border-b border-gray-200 shadow">
                    <table  class="divide-y divide-gray-300 ">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-2 text-xs text-gray-500">
                                ID
                            </th>
                            <th class="px-6 py-2 text-xs text-gray-500">
                                Name
                            </th>
                            <th class="px-6 py-2 text-xs text-gray-500">
                                description
                            </th>
                            <th class="px-6 py-2 text-xs text-gray-500">
                                price
                            </th>
                            <th class="px-6 py-2 text-xs text-gray-500">
                                categories
                            </th>
                            <th class="px-6 py-2 text-xs text-gray-500">
                                Delete
                            </th>
                        </tr>
                        </thead>
                        <tbody v-if="!!products.length" class="bg-white divide-y divide-gray-300">
                        <tr  v-for="product in products" :key="product.id">
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{product.id}}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{product.name}}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{product.description}}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{product.price}}$
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{product.categories.join(', ')}}
                            </td>

                            <td class="px-6 py-4">
                                <span class="text-sm text-gray-500 cursor-pointer" @click="removeProduct(product.id)">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-400" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </span>
                            </td>
                        </tr>
                        </tbody>

                    </table>
                    <p v-if="!products.length" class="text-center text-gray-400 h-auto placeholder">there are not products created yet</p>
            </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import {inject, onMounted} from "vue";
const products = inject('products');
const removeProductFromClient = inject('removeProduct');
const removeProduct = (id) => {
    fetch(`/api/products/${id}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json'
        }
    })
        .then(res => res.json())
        .then(() => {
            removeProductFromClient(id);
        })
        .catch(err => console.log(err));
}
</script>

<style scoped>

.placeholder{
    height: 2rem;
}

</style>
