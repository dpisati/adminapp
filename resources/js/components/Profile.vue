<style>
    .widget-user-header {
        background-position: center center;
        background-size: cover;
    }
</style>

<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-3">
                <div >
                    <!-- Widget: user widget style 1 -->
                    <div class="card card-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-white" 
                            style="background-image:url('./images/user-background.jpg')">
                        <h3 class="widget-user-username">Daniel</h3>
                        </div>
                        <div class="widget-user-image">
                        <img class="img-circle" src="" alt="User Avatar">
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
                            <div class="col-sm-6 border-right">
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
                        <!-- /.widget-user -->
                        <div class="tab-pane active" id="settings">
                            <div class="card">
                                 <div class="card-header">Settings</div>
                                <form class="form-horizontal p-3">
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                                    <div class="col-sm-12">
                                    <input type="email" v-model="form.name" class="form-control" id="inputName" placeholder="Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail"class="col-sm-2 control-label">Email</label>

                                    <div class="col-sm-12">
                                    <input type="email"  v-model="form.email" class="form-control" id="inputEmail" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputExperience" class="col-sm-12 control-label">Profile Picture</label>

                                    <div class="col-sm-12">
                                    <input class="" @change="updatePhoto" type="file" id="inputFile" name="profile_picture" accept="image/png, image/jpeg">
                                    </div>
                                </div>
                                <div class="form-group">
                                        <div class="col-sm-12">
                                        <button @click.prevent="updateUser" type="submit" class="btn btn-success">Update</button>
                                        </div>
                                </div>
                                </form>
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
            form: new Form({
                id: "",
                name: "",
                email: "",
                type: "",
                photo: "",
                franchise: "",
                password: "",
                remember: false
            })
        }
    },
    mounted(){
        console.log('Component Mounted')
    },
    methods: {
        updatePhoto(e) {
            let file = e.target.files[0];
            let reader = new FileReader();
            if(file['size'] < 2111775) {
                reader.onloadend = (file) => { this.form.photo = reader.result }
                reader.readAsDataURL(file);
            } else {
                Swal.fire("Oops...", "Picture bigger than 2mb", "error");
                this.form.photo = "profile.png"
            }
        },
        updateUser(){
            this.$Progress.start();
            this.form.put('api/profile')
                .then(() => {
                    Toast.fire({
                            icon: "success",
                            title: "User updated"
                        });
                    this.$Progress.finish();
                })
                .catch(() => {
                     this.$Progress.fail();
                    Toast.fire({
                            icon: "error",
                            title: "User not updated"
                        });
                })
        }
    },
    created(){
        axios.get('api/profile').then( ({ data }) => (this.form.fill(data)));
    }
};
</script>
