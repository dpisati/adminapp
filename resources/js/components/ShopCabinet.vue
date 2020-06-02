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
        <div class="product-container">
            <div class="product-left">
                <img
                    :src="`/images/cabinets/${cabinet.picture}`"
                    alt="product-picture"
                />
                <div class="product-color">
                    <p>Color</p>
                    <p>Prime White Embossed</p>
                    <button>Change Color</button>
                </div>
            </div>
            <div class="product-right">
                <div class="product-header">
                    <h1>{{ cabinet.name }}</h1>
                    <h3>
                        {{ cabinet.subcategory.category.name }} /
                        {{ cabinet.subcategory.name }}
                    </h3>
                </div>
                <div class="product-price">
                    <div class="price-name">
                        <h4>Price</h4>
                        <div class="price-number">
                            314.78
                        </div>
                    </div>
                    <div class="quantity">
                        <h4>Quantity</h4>
                        <div class="qnty-controller">
                            <div class="minus">-</div>
                            <div class="number">10</div>
                            <div class="plus">+</div>
                        </div>
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
                        <h4>Total Price</h4>
                        <p>757.45</p>
                    </div>
                    <div class="add-button">
                        <i class="fas fa-cart-plus fa-lg"></i>
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
