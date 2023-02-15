<template>
    <layout>
        <div class="py-3">
            <div>
                <h4>Edit Book</h4>
            </div>
        </div>
    </layout>
</template>

<script>
import Layout from "../layout/main.vue";

export default {
    name: "from",
    components: {Layout},
    data() {
        return {
            book_id: null,
            book: null
        }
    },

    created() {
        this.book_id = this.$route.params?.id;
        if (this.id) {
            this.getBook()
        }
    },

    methods: {
        getBook() {

        }
    }
}
</script>

<style scoped>

</style>
