<template>
    <div class="shop-container">
        <nav class="shop-nav">
            <div class="nav-left">
                <router-link
                    :to="'/shop'"
                    tag="button"
                    style="width:100px;height:40px;border:none;cursor:pointer;border-radius:5px;margin-right:25px"
                >
                    Back
                </router-link>
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
        <div>
            <img
                :src="`/images/cabinets/${cabinet.picture}`"
                alt="product-picture"
            />
            <div>
                <div class="product-header">
                    <h1>{{ cabinet.name }}</h1>
                    <h3>
                        {{ cabinet.subcategory.category.name }} /
                        {{ cabinet.subcategory.name }}
                    </h3>
                </div>
                <div class="product-price">
                    <div class="price-number">
                        314.78
                    </div>
                    <div class="quantity">
                        <div class="minus"></div>
                        <div class="number"></div>
                        <div class="plus"></div>
                    </div>
                </div>
                <div class="description">
                    <h4>Description</h4>
                    <p>
                        {{ cabinet.description }}
                    </p>
                </div>
                <div class="product-footer">
                    <div class="total">
                        757.45
                    </div>
                    <div class="add-button">
                        <div class="icon"></div>
                        <div class="button-title">Add to Cart</div>
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
            cartItemsNumbers: 0,
            slug: this.$route.params.slug,
            cabinet: {}
        };
    },
    methods: {
        loadCabinet() {
            this.$Progress.start();
            axios
                .get("/api/shop-cabinet/" + this.slug)
                .then(({ data }) => {
                    this.cabinet = data;
                    this.$Progress.finish();
                })
                .catch(() => {
                    this.$Progress.fail();
                });
        }
    },
    created() {
        this.loadCabinet();
    },
    mounted() {}
};
</script>
