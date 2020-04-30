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
       
        <div class="card text-center mb-3">
  <div class="row no-gutters">
    <div class="col-md-4">
       <img src="/images/cabinet.jpg" class="" alt="cabinet" width="250" height="250">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-text">{{ this.cabinet.name }}</h5>
        <p class="card-text">{{ this.cabinet.measure_type }}</p>
        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
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
