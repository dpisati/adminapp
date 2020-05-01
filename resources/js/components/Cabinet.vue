<template>
<div class="mt-3">   
    <div class="card text-center">
        <div class="row no-gutters align-items-center">
            <div class="col-md-4">
                <img src="/images/no-preview.png" class="m-5" alt="cabinet" width="250" height="250">
            </div>

        <div class="col-md-8">
            <div class="card mb-0">
                <div class="card-header align-items-center">
                    <h3 class="mb-0">{{ this.cabinet.name }}</h3>                
                </div>
            <div class="card-body">
                <div aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <div class="spinner">
                            <img v-if="isLoading" src="/images/spinner.gif" alt="spinner" class="spinnerLoading">
                        </div>
                        <li v-if="!isLoading" class="breadcrumb-item">{{ this.cabinet.subcategory.category.name}}</li>
                        <li v-if="!isLoading" class="breadcrumb-item active">{{ this.cabinet.subcategory.name}}</li>
                    </ol>
                </div>

            <div class="row">
            <div class="col-md-6 pr-2">
                    <div class="card">
                        <div class="card-header">
                            <h5>Unit Type</h5>                
                        </div>
                        <div class="card-body">
                            <h5>{{ this.cabinet.type }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 pl-2">
                    <div class="card">
                        <div class="card-header">
                            <h5>Measure Type</h5>                
                        </div>
                        <div class="card-body">
                            <h5>{{ this.cabinet.measure_type }}</h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-0">
                <div class="card-header">
                    <h5>Measures</h5>                
                </div>
            <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Minimum</th>
                        <th scope="col">Maximum</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Width</th>
                        <td>{{ this.cabinet.min_width }}</td>
                        <td>{{ this.cabinet.max_width }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Height</th>
                        <td>{{ this.cabinet.min_height }}</td>
                        <td>{{ this.cabinet.max_height }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Depth</th>      
                        <td>{{ this.cabinet.min_depth }}</td>
                        <td>{{ this.cabinet.max_depth }}</td>
                    </tr>
                </tbody>
            </table>
            </div>
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
