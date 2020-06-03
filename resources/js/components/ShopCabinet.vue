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
                    <h4>COLOR</h4>
                    <div class="color">
                        <div class="color-preview"></div>
                        <p>{{ color }}</p>
                    </div>
                    <div class="color-button">
                        <i class="fas fa-palette fa-lg"></i>
                        <div class="button-title" @click="newModal">
                            Change Color
                        </div>
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
                <div class="description">
                    <h4>DESCRIPTION</h4>
                    <p>
                        {{ cabinet.description }}
                    </p>
                </div>
                <div class="product-price">
                    <div class="price-name">
                        <h4>PRICE</h4>
                        <div class="price-number">
                            {{ price | roundPrice }}
                        </div>
                    </div>
                    <div class="quantity">
                        <h4>QUANTITY</h4>
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
                <div class="product-footer">
                    <div class="total">
                        <h4>TOTAL</h4>
                        <p>{{ (price * quantity) | roundPrice }}</p>
                    </div>
                    <div class="add-button">
                        <i class="fas fa-cart-plus fa-lg"></i>
                        <div class="button-title">Add to Cart</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Room Modal -->
        <div
            class="modal fade"
            id="addNew"
            tabindex="-1"
            role="dialog"
            aria-labelledby="addNewLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNewLabel">
                            Select Material
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form
                            @submit.prevent="updateColor()"
                            @keyup.enter.prevent="updateColor()"
                        >
                            <div class="form-group">
                                <select
                                    @change="loadMaterials"
                                    v-model="form.supplier_id"
                                    name="supplier"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'supplier'
                                        )
                                    }"
                                >
                                    <option value disabled selected
                                        >- Supplier -</option
                                    >
                                    <option
                                        v-for="supplier in suppliers"
                                        :key="supplier.id"
                                        :value="supplier.id"
                                        >{{ supplier.name }}</option
                                    >
                                </select>
                                <has-error
                                    :form="form"
                                    field="supplier"
                                ></has-error>
                            </div>

                            <div class="form-group">
                                <select
                                    @change="loadSupplierName"
                                    v-model="form.material"
                                    name="material"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has(
                                            'material'
                                        )
                                    }"
                                >
                                    <option value disabled selected
                                        >- Material -</option
                                    >
                                    <option
                                        v-for="material in materials"
                                        :key="material.id"
                                        :value="
                                            material.name +
                                                ' ' +
                                                material.finish
                                        "
                                        >{{ material.name }}
                                        {{ material.finish }}
                                    </option>
                                </select>
                                <has-error
                                    :form="form"
                                    field="material"
                                ></has-error>
                            </div>

                            <div class="modal-footer">
                                <button
                                    class="btn btn-secondary"
                                    data-dismiss="modal"
                                    :disabled="form.busy"
                                    type="submit"
                                >
                                    Close
                                </button>
                                <button type="submit" class="btn btn-success">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Room Modal -->
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
            cabinet: {},
            materials: {},
            suppliers: {},
            form: new Form({ supplier: "", supplier_id: "", material: "" })
        };
    },
    methods: {
        newModal() {
            this.editmode = false;
            this.form.reset();
            $("#addNew").modal("show");
        },
        updateColor() {
            this.$Progress.start();
            this.color = this.form.material;
            $("#addNew").modal("hide");
            Toast.fire({
                icon: "success",
                title: "Color Updated"
            });
            this.$Progress.finish();
        },
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
        },
        getSuppliers() {
            axios.get("/api/supplier").then(response => {
                this.suppliers = response.data;
            });
        },
        loadMaterials() {
            axios
                .get("/api/findMaterial/" + this.form.supplier_id)
                .then(response => {
                    this.materials = response.data;
                });
        }
    },
    created() {
        this.loadCabinet();
        this.getSuppliers();
    },
    mounted() {}
};
</script>
