<template>
    <form @submit.prevent="submitProduct">
        <div class="mb-6">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 leading-tight">Product Name</label>
            <input v-model="data.name" type="text" id="name" class="bg-white border border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="product name" required>
        </div>
        <div class="mb-6">
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 leading-tight">Product description</label>
            <input v-model="data.description" type="text" id="description" class="bg-white border border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="something about this product" required>
        </div>
        <div class="mb-6">
            <label for="price" class="block mb-2 text-sm font-medium text-gray-900 leading-tight">Product price</label>
            <input v-model="data.price" type="number" @keypress="onlyPrice" id="price" class="bg-white border border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
        </div>
        <div class="mb-6">
            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 leading-tight">Product Categories</label>
            <input v-model="categories" type="text" id="category" class="bg-white border border-gray-300  text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="categories split by ','" required>
        </div>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
    </form>


</template>

<script>
const initialState = {
    name: '',
    description: '',
    price: 1.00
}
export default {
    name: "Form",
    inject: ['addProduct'],
    data() {
        return {
            categories:"",
            data: initialState,
        }
    },
    methods: {
        onlyPrice(e) {
            if (!(/^(\d+)(\.)?(\d{2})?/.test(e.key))) {
                e.preventDefault();
            }
        },

        submitProduct() {
            console.log(this.data);
            const data = {
                name: this.data.name,
                description: this.data.description,
                price: this.data.price,
                categories: this.categories.split(',')
            }
            fetch("/api/products", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(data)
            }).then(res => res.json())
                .then(res => {
                    this.addProduct(res.data)
                    this.data = initialState;
                    this.categories = "";
                })
                .catch(err => console.log(err));
        }
    }
}
</script>

<style scoped>

</style>
