<template>
    <div class="container">
        <nav class="shop-nav">
            <div class="nav-left">
                <select
                    @change="loadSubCategories"
                    v-model="form.category"
                    name="category"
                    :class="{ 'is-invalid': form.errors.has('category') }"
                >
                    <option value disabled selected>- Category -</option>
                    <option
                        v-for="category in categories"
                        :key="category.id"
                        :value="category.id"
                        >{{ category.name }}
                    </option>
                </select>

                <select class="">
                    <option value="" data-display-text="Product">None</option>
                    <option value="apples">Cabinets</option>
                    <option value="bananas">Appliances</option>
                    <option value="oranges">Hardware</option>
                </select>
                <select class="">
                    <option value="" data-display-text="Fruits">None</option>
                    <option value="apples">Apples</option>
                    <option value="bananas">Bananas</option>
                    <option value="oranges">Oranges</option>
                </select>
                <select class="">
                    <option value="" data-display-text="Fruits">None</option>
                    <option value="apples">Apples</option>
                    <option value="bananas">Bananas</option>
                    <option value="oranges">Oranges</option>
                </select>
            </div>
            <div class="nav-right">
                <div class="cart-button">
                    <h3>Cart</h3>
                    <div class="cart">
                        <i class="fas fa-shopping-cart fa-2x"></i>
                        <span class="badge">15</span>
                    </div>
                </div>
            </div>
        </nav>

        <div class="shop-content">
            <div
                v-for="cabinet in cabinets"
                :key="cabinet.id"
                class="align-middle"
            >
                <img
                    :src="`/images/cabinets/${cabinet.picture}`"
                    alt="cabinet"
                    style="width:100px;height:100px;object-fit:cover"
                />
                <p class="align-middle mt-5">
                    {{ cabinet.subcategory.category.name }} /
                    {{ cabinet.subcategory.name }} - {{ cabinet.name }}
                </p>
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
            form: new Form({
                id: "",
                category: ""
            })
        };
    },
    methods: {
        getCabinets() {
            axios.get("api/library").then(response => {
                this.cabinets = response.data;
            });
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
        }
    },
    created() {
        this.getCabinets();
        this.loadCategories();
        console.log(this.categories);
    },
    mounted() {
        console.log("Component mounted.");
    }
};
</script>
