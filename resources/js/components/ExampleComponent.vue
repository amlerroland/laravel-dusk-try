<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        <div>
                            <label for="page_length">Page Length</label>
                            <select name="page_length" id="page_length" v-model="pageLength" @change="changeLength">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <ul id="products">
                            <li class="product" v-for="product in products" :key="product.id" v-text="product.name"></li>
                        </ul>
                        <div class="pagination">
                            <button v-for="n in pages" :key="n" v-text="n" @click="selectPage(n)" :dusk="`page-${n}`"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                products: [],
                pageLength: 10,
                currentPage: 1,
                recordsTotal: 0
            }
        },
        methods: {
            selectPage(page) {
                if (page == this.currentPage) {
                    return;
                }

                this.currentPage = page;
                this.get();
            },
            changeLength() {
                this.currentPage = 1;
                this.get();
            },
            get() {
                axios.get('/api/products', {
                    params: {
                        pageLength: this.pageLength,
                        currentPage: this.currentPage
                    },
                }).then(response => {
                    this.products = response.data.products;
                    this.recordsTotal = response.data.recordsTotal;
                });
            }
        },
        computed: {
            pages() {
                return Math.ceil(this.recordsTotal / this.pageLength);
            }
        },
        created() {
            this.get();
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
