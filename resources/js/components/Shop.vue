<template>
    <div class="container">
        <nav class="shop-nav">
            <select name="shop-cabinets" id="shop-cabinets">
                <option value disabled selected>- Measure Type -</option>
                <option value="Single">Single</option>
                <option value="Multiple">Multiple</option>
                <option value="Parametric">Parametric</option>
            </select>
            <select name="shop-cabinets" id="shop-cabinets">
                <option value disabled selected>- Measure Type -</option>
                <option value="Single">Single</option>
                <option value="Multiple">Multiple</option>
                <option value="Parametric">Parametric</option>
            </select>
            <select name="shop-cabinets" id="shop-cabinets">
                <option value disabled selected>- Measure Type -</option>
                <option value="Single">Single</option>
                <option value="Multiple">Multiple</option>
                <option value="Parametric">Parametric</option>
            </select>
        </nav>

        <div v-for="cabinet in cabinets" :key="cabinet.id" class="align-middle">
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
</template>

<script>
export default {
    data() {
        return {
            cabinets: {}
        };
    },
    methods: {
        getCabinets() {
            axios.get("api/library").then(response => {
                this.cabinets = response.data;
            });
        }
    },
    created() {
        this.getCabinets();
    },
    mounted() {
        console.log("Component mounted.");
    }
};
</script>
