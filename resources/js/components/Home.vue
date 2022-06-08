<template>
    <div class="home">
        <Form/>
        <Table/>
    </div>
</template>
<script>
import Table from "./Table";
import Form from "./Form";
export default {
    components: {Form, Table},
    setup: () => ({
        title: 'welcome to our home'
    })
}
</script>

<style>
.home{
    display: flex;
    flex-direction: column;
    gap: 2rem;
}
</style>
