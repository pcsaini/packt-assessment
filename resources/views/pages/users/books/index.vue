<template>
    <UserLayout>
        <div class="py-3">
            <div>
                <h4>Books</h4>
            </div>
            <div class="py-2">
                <div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <!-- Search -->
                                <div class="col-sm-12 col-md-6">
                                    <div class="text-md-right">
                                        <label class="d-inline-flex align-items-center">
                                            Search:
                                            <input
                                                v-model="search"
                                                type="search"
                                                v-on:keyup="getBooks"
                                                placeholder="Search..."
                                                class="form-control form-control-sm ms-2"
                                            >
                                        </label>
                                    </div>
                                </div>
                                <!-- End search -->
                            </div>
                            <EasyDataTable
                                v-model:server-options="options"
                                :headers="headers"
                                :items="books"
                                :server-items-length="totalLength"
                                :loading="loading"
                                buttons-pagination
                            >
                                <template #item-action="item">
                                    <div class="operation-wrapper">
                                        <router-link :to="{ name : 'edit-books', params: {id: item.id} }"
                                                     class="btn btn-sm btn-info mx-1">Edit
                                        </router-link>
                                        <button class="btn btn-sm btn-danger mx-1" @click="deleteBook(item.id)">Delete
                                        </button>
                                    </div>
                                </template>
                            </EasyDataTable>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </UserLayout>
</template>

<script>
import {apiService} from "@/helpers/api.service";
import UserLayout from "../layout/main.vue";

export default {
    components: {UserLayout},
    data() {
        return {
            headers: [
                {text: "Title", value: "title", sortable: true},
                {text: "ISBN", value: "isbn", sortable: true},
                {text: "Author", value: "author", sortable: true},
                {text: "Genre", value: "genre", sortable: true},
                {text: "Publisher", value: "publisher", sortable: true},
                {text: "Published", value: "published", sortable: true},
            ],
            books: [],
            loading: false,
            search: '',

            options: {
                page: 1,
                rowsPerPage: 10,
                sortBy: 'title',
                sortType: 'desc',
            },
            totalLength: 0
        }
    },
    mounted() {
        this.getBooks()
    },
    watch: {
        // whenever question changes, this function will run
        search(newQuestion, oldQuestion) {
            this.getBooks()
        },
        options(newQuestion, oldQuestion) {
            this.getBooks()
        }
    },
    methods: {
        getBooks() {
            this.loading = true

            let query = `page=${this.options.page}&limit=${this.options.rowsPerPage}`

            if (this.options.rowsPerPage && this.options.sortType) {
                query += `&sortBy=${this.options.sortBy}&sortType=${this.options.sortType}`
            }

            if (this.search) {
                query += `&search=${this.search}`
            }

            apiService.getUserBooks(query).then((res) => {
                this.books = res?.data
                this.totalLength = res?.meta?.total_item
            }).finally(() => {
                this.loading = false
            })
        },
    },
}
</script>

<style scoped>

</style>
