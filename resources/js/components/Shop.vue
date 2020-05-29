<template>
    <div class="container">
        <nav class="shop-nav">
            <div class="nav-left">
                <select
                    @change="loadSubCategories"
                    v-model="form.category"
                    name="category"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('category') }"
                >
                    <option value disabled selected>- Category -</option>
                    <option
                        v-for="category in categories"
                        :key="category.id"
                        :value="category.id"
                        >{{ category.name }}</option
                    >
                </select>

                <select
                    @change="loadCabinets"
                    v-model="form.subcategory"
                    name="subcategory"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('subcategory') }"
                >
                    <option v-if="!subcategories.length" value disabled selected
                        >Select Category First</option
                    >
                    <option v-if="subcategories.length" value disabled selected
                        >- Sub-Category -</option
                    >
                    <option
                        v-if="subcategories.length > 0"
                        v-for="subcategory in subcategories"
                        :key="subcategory.id"
                        :value="subcategory.id"
                        >{{ subcategory.name }}</option
                    >
                </select>
            </div>
            <div class="nav-right">
                <div class="cart-button" id="target">
                    <h3>Cart</h3>
                    <div class="cart">
                        <i class="fas fa-shopping-cart fa-2x"></i>
                        <span v-if="cartItemsNumbers > 0" class="badge">{{
                            cartItemsNumbers
                        }}</span>
                    </div>
                </div>
            </div>
        </nav>
        <div class="main-grid">
            <div class="grid">
                <div
                    class="grid__item"
                    v-for="cabinet in cabinets"
                    :key="cabinet.id"
                >
                    <div class="card">
                        <img
                            class="card__img"
                            :src="`/images/cabinets/${cabinet.picture}`"
                            alt="Snowy Mountains"
                        />
                        <div class="card__content">
                            <h1 class="card__header">{{ cabinet.name }}</h1>
                            <p class="card__text"></p>
                            <button
                                class="card__btn"
                                @click="cartItemsNumbers += 1"
                            >
                                View More <span>&rarr;</span>
                            </button>
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
            categories: {},
            subcategories: {},
            cabinets: {},
            cartItemsNumbers: 0,
            form: new Form({
                id: "",
                category: "",
                subcategory: "",
                cabinet: ""
            })
        };
    },
    methods: {
        loadCategories() {
            this.$Progress.start();
            axios
                .get("/api/category")
                .then(({ data }) => {
                    this.categories = data;
                    this.$Progress.finish();
                })
                .catch(() => {
                    this.$Progress.fail();
                });
        },
        loadSubCategories() {
            this.$Progress.start();
            axios
                .get("/api/subcategory/" + this.form.category)
                .then(({ data }) => {
                    this.subcategories = data;
                    this.$Progress.finish();
                })
                .catch(() => {
                    this.$Progress.fail();
                });
        },
        loadCabinets() {
            this.$Progress.start();
            axios
                .get("/api/findCabinetBySubCategory/" + this.form.subcategory)
                .then(({ data }) => {
                    this.cabinets = data;
                    this.$Progress.finish();
                })
                .catch(() => {
                    this.$Progress.fail();
                });
        },
        getCabinets() {
            axios.get("api/library").then(response => {
                this.cabinets = response.data;
            });
        }
    },
    created() {
        this.loadCategories();
        this.getCabinets();
        Fire.$on("reloadCategory", () => {});
    },
    mounted() {
        console.log("Component mounted.");
    }
};
</script>
