<template>
    <Form/>
    <Table/>
</template>
<script>
import Table from "./Table";
export default {
    components: {Table},
    setup: () => ({
        title: 'welcome to our home'
    })
}
</script>
