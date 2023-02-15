<template>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <router-link class="navbar-brand fw-bold" :to="{ name: 'dashboard'}">
                Packt+
            </router-link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    <li class="nav-item">
                        <router-link active-class="active" class="nav-link" :to="{ name: 'books'}">
                            Books
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)" @click="logout()">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
import {apiService} from "@/helpers/api.service";

export default {
    name: "Header",
    methods: {
        logout() {
            apiService.logout().then((res) => {
                if (res.status) {
                    localStorage.removeItem('token')
                    localStorage.removeItem('user')
                    location.reload()
                }
            })
        }
    }
}


</script>

<style scoped>

</style>
