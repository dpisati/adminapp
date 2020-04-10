<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">                
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title mt-2">Projects Table</h3>
                        <div class="card-tools">
                            <div class="input-group input-group-sm hidden-xs">
                            <button class="btn btn-success btn-sm mr-3 m-2" @click="newModal">
                                <i class="fas fa-file-powerpoint nav-icon mr-2"></i>
                                Add project
                            </button>
                            </div>
                        </div>
                    </div>
                    
                    <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" role="tab" aria-controls="home" aria-selected="true"  @click="projectStatusSet('Active'); filteredProjects()">Active</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" role="tab" aria-controls="profile" aria-selected="false" @click="projectStatusSet('On-Hold'); filteredProjects()">On-Hold</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" role="tab" aria-controls="contact" aria-selected="false" @click="projectStatusSet('Sold'); filteredProjects()">Sold</a>
                        </li>
                    </ul>

                            <!-- /.card-header -->
                    <div class="card-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <th>Status</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Client</th>
                            <th>Quote</th>
                            <th>Modify</th>
                        </tr>


                        <tr v-for="project in projects" :key="project.id">
                            <td>{{ project.id }}</td>
                            <td>{{ project.user_id }}</td>
                            <td>{{ project.status }}</td>
                            <td>{{ project.name | upText }}</td>
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

            <!-- Modal -->
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
            <h5
              class="modal-title"
              id="addNewLabel"
            >{{ editmode ? "Edit Project" : "Create New Project" }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="editmode ? updateProject() : createProject()">
              <div class="form-group">
                <input
                  placeholder="Project Name"
                  v-model="form.name"
                  type="text"
                  name="name"
                  class="form-control"
                  :class="{'is-invalid': form.errors.has('name')}"
                />
                <has-error :form="form" field="projectname"></has-error>
              </div>

              <div class="form-group">
                <input
                  placeholder="Client Name"
                  v-model="form.client"
                  type="text"
                  name="client"
                  class="form-control"
                  :class="{'is-invalid': form.errors.has('client')}"
                />
                <has-error :form="form" field="client"></has-error>
              </div>

              <div class="form-group">
                <input
                  placeholder="Quote"
                  v-model="form.quote"
                  type="text"
                  name="quote"
                  class="form-control"
                  :class="{'is-invalid': form.errors.has('quote')}"
                />
                <has-error :form="form" field="quote"></has-error>
              </div>

              <div class="form-group">
                <select
                  v-model="form.status"
                  name="status"
                  class="form-control"
                  :class="{'is-invalid': form.errors.has('status')}"
                >
                  <option value disabled selected>- Project Status -</option>
                  <option value="Active">Active</option>
                  <option value="On-Hold">On-Hold</option>
                  <option value="Sold">Sold</option>
                </select>
                <has-error :form="form" field="status"></has-error>
              </div>

              <div class="modal-footer">
                <button
                  class="btn btn-secondary"
                  data-dismiss="modal"
                  :disabled="form.busy"
                  type="submit"
                >Close</button>
                <button type="submit" class="btn btn-success">{{ editmode ? "Save" : "Create" }}</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  <!-- Modal -->

    </div>
</template>

<script>
export default {
  data() {
    return {
      userId: '',
      userType: '',
      projects: {},
      editmode: true,
      projectStatus: 'Active',

      form: new Form({        
        name: "",        
        client: "",
        quote: "",
        franchise: "",
        status: ""
      })
    };
  },

  methods: {
    projectStatusSet(status) {
      this.projectStatus = status;
    },
    getResults(page = 1) {
          axios.get('api/project?page=' + page)
            .then(response => {
              this.projects = response.data;
      });
    },

    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#addNew").modal("show");
    },
    editModal(project) {
      this.editmode = true;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.fill(project);
    },

    createProject() {
      this.form
        .post("api/project")
        .then(() => {
          this.$Progress.start();
          Fire.$emit("reloadProjects");
          $("#addNew").modal("hide");
          Toast.fire({
            icon: "success",
            title: "project created successfully"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          Toast.fire({
            icon: "error",
            title: "Unable to create project"
          });
        });
    },

    updateProject() {
      this.$Progress.start();
      this.form
        .put("api/project/" + this.form.id)
        .then(() => {
          Toast.fire({
            icon: "success",
            title: "project updated"
          });
          $("#addNew").modal("hide");
          this.$Progress.finish();
          Fire.$emit("reloadProjects");
        })
        .catch(() => {
          this.$Progress.fail();
          Toast.fire({
            icon: "error",
            title: "Unable to update project"
          });
        });
    },
    getUserId(){
        let userId = axios.get('api/profile')
            .then((res) => {
              this.userId = res.data.id;
              this.userType = res.data.type;
              this.userFranchise = res.data.franchise;
            });
    },

    filteredProjects(){
      let query = this.projectStatus;
          axios.get('api/findProject?q=' + query)
            .then((data) => {
              if(this.userType == 'user') {
                let projects = data.data.data
                let projectsFilter = _.filter(projects, { 'user_id': this.userId });
                this.projects = projectsFilter;
              } else {
                this.projects = data.data.data;   
              }          
            })
        .catch(() => {});
    },

    loadprojects() {
      // if (this.$gate.isAdminOrManeger()) {
        this.$Progress.start();
        axios.get("api/project").then(({ data }) => (this.projects = data));
              if(this.userType == 'user') {
                let projects = this.projects
                let projectsFilter = _.filter(projects, { 'user_id': this.userId });
                this.projects = projectsFilter;
              } else {
                this.projects = data.data.data;
              }  
        this.$Progress.finish();        
      // }
    },
    deleteproject(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then(result => {
        if (result.value) {
          this.form
            .delete("api/project/" + id)
            .then(() => {
              Swal.fire("Deleted!", "project has been deleted.", "success");
              Fire.$emit("reloadProjects");
            })
        .catch(() => {
            this.$Progress.fail();
            Toast.fire({
              icon: "error",
              title: "Unable to delete project"
            });
        });
        }
      });
    }
  },

  created() {    
    Fire.$on('searching', () => {
      let query = this.$parent.search;
      axios.get('api/findProject?q=' + query)
        .then((data) => {
              if(this.userType == 'user') {
                let projects = data.data.data
                let projectsFilter = _.filter(projects, { 'user_id': this.userId });
                this.projects = projectsFilter;
              } else {
                this.projects = data.data.data;   
              } 
        })
        .catch(() => {})
    });
    // this.loadprojects();
    this.getUserId();
    this.filteredProjects();
    Fire.$on("reloadProjects", () => {
      this.filteredProjects();
    });
  }
};
</script>
