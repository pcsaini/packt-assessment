<template>
    <div class="container">
        <div class="pt-5 mt-3">
            <h1 class="text-center">Welcome to the Packt+ Assessment</h1>

            <div class="text-center">
                <router-link class="mx-1 btn btn-primary" :to="{name: 'user-books'}">Books</router-link>
                <router-link class="mx-1 btn btn-outline-primary" to="admin">Admin</router-link>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "welcome"
}
</script>

<style scoped>

</style>
