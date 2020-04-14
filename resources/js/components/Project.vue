<style>
    .widget-user-header {
        background-position: center center;
        background-size: cover;
    }
</style>

<template>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-12 mt-3">
                <div>
                    <!-- Widget: user widget style 1 -->
                    <div class="card card-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-white">
                            <h3 class="widget-user-username mt-3">{{ this.project.name }}</h3>                        
                        </div>
                        <div class="card-footer">
                        <div class="row">
                                <div class="col-sm-6 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">32</h5>
                                        <span class="description-text">PROJECTS</span>
                                    </div>
                                <!-- /.description-block -->
                                </div>
                            <!-- /.col -->
                                <div class="col-sm-6">
                                    <div class="description-block">
                                        <h5 class="description-header">44</h5>
                                        <span class="description-text">SOLD</span>
                                    </div>
                            <!-- /.description-block -->
                                </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        </div>                                           
                    </div>
                        <div class="m-3">
                            <div class="input-group input-group-sm hidden-xs">
                            <button class="btn btn-success btn-sm mr-3 m-2" @click="newModal">
                                <i class="fas fa-file-powerpoint nav-icon mr-2"></i>
                                Add Room
                            </button>
                            </div>
                        </div>           
                                                <!-- /.card-header -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title mt-2">Kitchen</h3>
                                                <div class="card-tools">
                            <div class="input-group input-group-sm hidden-xs">
                            <button class="btn btn-success btn-sm mr-3 m-2" @click="newModal">
                                <i class="fas fa-file-powerpoint nav-icon mr-2"></i>
                                Add Cabinet
                            </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>Number</th>
                            <th>Quantity</th>
                            <th>Name</th>
                            <th>Width</th>
                            <th>Height</th>
                            <th>Depth</th>
                            <th>Comment</th>
                        </tr>


                        <tr v-for="project in projects" :key="project.id">
                            
                              <td>{{ project.id }}</td>
                              <td>{{ project.user_id }}</td>
                              <td><router-link :to="'/projects/' + project.id"> {{ project.name | upText }} </router-link></td>
                              <td>{{ project.code }}</td>
                              <td>{{ project.client }}</td>
                              <td>{{ project.quote }}</td>
                            
                            <td>
                            <a href="#" @click="editModal(project)">
                                <i class="fa fa-edit mr-2"></i>
                            </a>
                            /
                            <a href="#" @click="deleteproject(project.id)">
                                <i class="fa fa-trash-alt ml-2"></i>
                            </a>
                            </td>
                        </tr>
                            
                        </tbody>
                    </table>
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
            id: this.$route.params.id,
            project: {}
        }
    },
    created() {
        this.$Progress.start();
        axios
        .get("/api/project/" + this.id)
        .then(({ data }) => {
            this.project = data;
            this.$Progress.finish();
        })
        .catch(() => {
            this.$Progress.fail();
        });
    }
};
</script>
