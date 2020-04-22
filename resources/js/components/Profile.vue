<style>
    .widget-user-header {
        background-position: center center;
        background-size: cover;
    }
</style>

<template>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-8 mt-3">
                <div >
                    <!-- Widget: user widget style 1 -->
                    <div class="card card-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-white" 
                            style="background-image:url('./images/user-background.jpg')">
                        <h3 class="widget-user-username mt-3">{{ this.form.name }}</h3>
                        </div>
                        <div class="widget-user-image">
                        <img class="img-circle" :src="getProfilePhoto()" style="width:100px;height:100px;object-fit:cover;margin-left:-5px;" alt="User Avatar">
                        </div>
                        <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-6 border-right">
                            <div class="description-block">
                                <h5 class="description-header">{{totalProjects}}</h5>
                                <span class="description-text">PROJECTS</span>
                            </div>
                            <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6">
                            <div class="description-block">
                                <h5 class="description-header">{{totalSold}}</h5>
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
                                    <label for="inputName" class="col-sm-12 control-label">Name</label>

                                    <div class="col-sm-12">
                                    <input 
                                        type="email" 
                                        v-model="form.name" 
                                        class="form-control" 
                                        id="inputName" 
                                        placeholder="Name"
                                        :class="{'is-invalid': form.errors.has('name')}"
                                    >
                                    <has-error :form="form" field="name"></has-error>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-12 control-label">Email</label>

                                    <div class="col-sm-12">
                                    <input 
                                        type="email"  
                                        v-model="form.email" 
                                        class="form-control" 
                                        id="inputEmail" 
                                        placeholder="Email"
                                        :class="{'is-invalid': form.errors.has('email')}"
                                    >
                                    <has-error :form="form" field="email"></has-error>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword" class="col-sm-12 control-label">Password</label>

                                    <div class="col-sm-12">
                                    <input 
                                        type="password" 
                                        v-model="form.password" 
                                        class="form-control" 
                                        id="inputPassword" 
                                        placeholder="Password"
                                        :class="{'is-invalid': form.errors.has('password')}"
                                    >
                                    <has-error :form="form" field="password"></has-error>
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
            userId: "",
            totalProjects: 0,
            totalSold: 0,
            currentPhoto: "",
            projects: {},
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
    methods: {
        projectsCount() {
            this.totalProjects = 0;
            this.totalSold = 0;
            this.projects.forEach(project => {
                if(project.status == "Sold") {
                    this.totalSold += 1;
                } else {
                    this.totalProjects += 1;
                };
            });
        },
        getUserId(){
            let userId = axios.get('api/profile')
                .then((res) => {
                this.userId = res.data.id;
                });
            axios.get('api/project')
            .then((data) => {
                let projects = data.data.data
                let projectsFilter = _.filter(projects, { 'user_id': this.userId });
                this.projects = projectsFilter;
                 this.projectsCount();
            })
            .catch(() => {});
        },

        getProfilePhoto(){
            let profilePhoto = (this.form.photo.match(/\//) ? this.currentPhoto : this.form.photo);
            this.currentPhoto = profilePhoto;
            return "images/profile/" + profilePhoto;
        },
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
                    axios
                    .get("api/profile")
                    .then(({ data }) => {
                        this.$Progress.finish();
                        this.currentPhoto = data.photo;
                        return this.form.fill(data);
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    });
                    this.getProfilePhoto();
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
        this.$Progress.start();
        this.getUserId();
        axios
        .get("api/profile")
        .then(({ data }) => {
            this.$Progress.finish();
            this.currentPhoto = data.photo;
            return this.form.fill(data);
        })
        .catch(() => {
            this.$Progress.fail();
        });
    }
};
</script>
