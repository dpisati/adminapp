<template>
    <div class="mt-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <div class="spinner">
                    <img v-if="isLoading" src="/images/spinner.gif" alt="spinner" class="spinnerLoading">
                </div>
                <li v-if="!isLoading" class="breadcrumb-item">{{ this.cabinet.subcategory.category.name}}</li>
                <li v-if="!isLoading" class="breadcrumb-item active">{{ this.cabinet.subcategory.name}}</li>
            </ol>
        </nav>
        <div class="row justify-content-md-center">
            <div class="col-md-10 mt-3">             
                    <div class="card">                         
                        <div class="card-header bg-white">
                            <div class="row">
                                <div class="col-lg-6">
                                    <img src="/images/cabinet.jpg" alt="" width="250" height="250">
                                </div>
                                <div class="col-lg-6">
                                    <h3 class="widget-user-username mt-3">{{ this.cabinet.name }}</h3>
                                    <p >{{ this.cabinet.measure_type }}</p>
                                </div>
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
            isLoading: false,
            id: this.$route.params.id,
            cabinet: {}
        }
    },
    methods: {
    },
    created(){
        this.$Progress.start();
        this.isLoading = true;
        axios
        .get("/api/library/" + this.id)
        .then(({ data }) => {
            this.cabinet = data;
            this.$Progress.finish();
            this.isLoading = false;
        })
        .catch(() => {
            this.isLoading= false
            this.$Progress.fail();
        });
    }
};
</script>
