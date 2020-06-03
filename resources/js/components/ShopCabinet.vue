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
                    <h4>Color</h4>
                    <div class="color">
                        <div class="color-preview"></div>
                        <p>{{ color }}</p>
                    </div>
                    <div class="color-button">
                        <i class="fas fa-palette fa-lg"></i>
                        <div class="button-title">Change Color</div>
                    </div>
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
                            {{ price | roundPrice }}
                        </div>
                    </div>
                    <div class="quantity">
                        <h4>Quantity</h4>
                        <div class="qnty-controller">
                            <div
                                class="minus"
                                @click="
                                    quantity > 0 ? (quantity -= 1) : quantity
                                "
                            >
                                -
                            </div>
                            <div class="number">{{ quantity }}</div>
                            <div class="plus" @click="quantity += 1">+</div>
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
                        <p>{{ (price * quantity) | roundPrice }}</p>
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
            price: 317.54,
            quantity: 1,
            color: "Southern Oak Woodgrain",
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
