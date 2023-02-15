<template>
    <UserHeader />

    <div class="container">
        <slot />
    </div>
</template>

<script>
import UserHeader from "./header.vue";

export default {
    name: "UserLayout",
    components: {UserHeader}
}
</script>

<style scoped>

</style>
