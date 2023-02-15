<template>
    <Header />

    <div class="container">
        <slot />
    </div>
</template>

<script>
import Header from "./header.vue";

export default {
    name: "Layout",
    components: {Header}
}
</script>

<style scoped>

</style>
