<template>
    <div class="container">
        <nav class="shop-nav">
            <div class="nav-left">
                <button
                    v-if="subcategoryLoaded"
                    @click="reset"
                    style="width:100px;height:40px;border:none;cursor:pointer;border-radius:5px;margin-right:25px"
                >
                    All
                </button>
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
                    v-if="subcategoryLoaded"
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
                            alt="prodcut-picture"
                        />
                        <div class="card__content">
                            <h1 class="card__header">{{ cabinet.name }}</h1>
                            <p class="card__text"></p>

                            <router-link
                                :to="'/shop/' + cabinet.slug"
                                tag="button"
                                class="card__btn"
                            >
                                View More <span>&rarr;</span>
                            </router-link>
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
            subcategoryLoaded: false,
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
        reset() {
            this.$Progress.start();
            this.getCabinets();
            this.form.category = "";
            this.subcategories = {};
            this.subcategoryLoaded = false;
        },
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
            this.subcategoryLoaded = false;
            this.$Progress.start();
            axios
                .get("/api/subcategory/" + this.form.category)
                .then(({ data }) => {
                    this.subcategories = data;
                    this.subcategoryLoaded = true;
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
