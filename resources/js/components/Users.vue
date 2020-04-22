<template>
  <div>
    <div class="container mt-5">
      <div v-if="!$gate.isAdminOrManegerOrOwner()">
        <not-found></not-found>
      </div>
      <div class="row" v-if="$gate.isAdminOrManegerOrOwner()">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title mt-2">Users Table</h3>
              <div class="card-tools">
                <div class="input-group input-group-sm hidden-xs">
                  <button class="btn btn-success btn-sm mr-3 m-2" @click="newModal">
                    <i class="fas fa-user-plus mr-2"></i>
                    Add User
                  </button>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody>
                  <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>E-mail</th>
                    <th>Franchise</th>
                    <th>Type</th>
                    <th>Modify</th>
                  </tr>

                  <tr v-for="user in users.data" :key="user.id">
                    <td>{{ user.id }}</td>
                    <td>{{ user.name | upText }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.franchise }}</td>
                    <td>{{ user.type | upText }}</td>
                    <td>
                      <a href="#" @click="editModal(user)">
                        <i class="fa fa-edit mr-2"></i>
                      </a>
                      /
                      <a href="#" @click="deleteUser(user.id)">
                        <i class="fa fa-trash-alt ml-2"></i>
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
              <div class="card-footer">
                <pagination :data="users" @pagination-change-page="getResults"></pagination>
              </div>
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
            >{{ editmode ? "Edit User" : "Create New User" }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="editmode ? updateUser() : createUser()">
              <div class="form-group">
                <input
                  placeholder="Username"
                  v-model="form.name"
                  type="text"
                  name="name"
                  class="form-control"
                  :class="{
                                        'is-invalid': form.errors.has('name')
                                    }"
                />
                <has-error :form="form" field="username"></has-error>
              </div>

              <div class="form-group">
                <input
                  placeholder="Email"
                  v-model="form.email"
                  type="email"
                  name="email"
                  class="form-control"
                  :class="{'is-invalid': form.errors.has('email')}"
                />
                <has-error :form="form" field="email"></has-error>
              </div>

              <div class="form-group">
                <select
                  v-model="form.type"
                  name="type"
                  class="form-control"
                  :class="{'is-invalid': form.errors.has('type')}"
                >
                  <option value disabled selected>- User Type -</option>
                  <option v-if="user.type === 'admin'" value="admin">Admin</option>
                  <option value="user">User</option>
                  <option value="maneger">Maneger</option>
                  <option v-if="user.type === 'admin'" value="owner">Owner</option>
                </select>
                <has-error :form="form" field="type"></has-error>
              </div>

              <div class="form-group">
                <select
                  v-model="form.franchise"
                  name="franchise"
                  class="form-control"
                  :class="{'is-invalid': form.errors.has('franchise')}"
                >
                  <option value disabled selected>- User Franchise -</option>
                  <option value="Christchurch">Christchurch</option>
                  <option value="Timaru">Timaru</option>
                  <option value="Hokitika">Hokitika</option>
                </select>
                <has-error :form="form" field="franchise"></has-error>
              </div>

              <div class="form-group">
                <input
                  v-model="form.password"
                  placeholder="Password"
                  type="password"
                  name="password"
                  class="form-control"
                  :class="{'is-invalid': form.errors.has('password')}"
                />
                <has-error :form="form" field="password"></has-error>
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
  </div>
</template>

<script>
export default {
  data() {
    return {
      user: {},
      users: {},
      editmode: true,

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
    };
  },

  methods: {
      getResults(page = 1) {
            axios.get('api/user?page=' + page)
              .then(response => {
                this.users = response.data;
				});
    },
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#addNew").modal("show");
    },
    editModal(user) {
      this.editmode = true;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.fill(user);
    },

    createUser() {
      this.form
        .post("api/user")
        .then(() => {
          this.$Progress.start();
          Fire.$emit("reloadUsers");
          $("#addNew").modal("hide");
          Toast.fire({
            icon: "success",
            title: "User created successfully"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          Toast.fire({
            icon: "error",
            title: "Unable to create user"
          });
        });
    },

    updateUser() {
      this.$Progress.start();
      this.form
        .put("api/user/" + this.form.id)
        .then(() => {
          Toast.fire({
            icon: "success",
            title: "User updated"
          });
          $("#addNew").modal("hide");
          this.$Progress.finish();
          Fire.$emit("reloadUsers");
        })
        .catch(() => {
          this.$Progress.fail();
          Toast.fire({
            icon: "error",
            title: "Unable to update user"
          });
        });
    },
    loadUsers() {
      if (this.$gate.isAdminOrManegerOrOwner()) {
        this.$Progress.start();
        axios.get("api/user").then(({ data }) => (this.users = data));
        this.$Progress.finish();
      }
    },
    deleteUser(id) {
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
            .delete("api/user/" + id)
            .then(() => {
              Swal.fire("Deleted!", "User has been deleted.", "success");
              Fire.$emit("reloadUsers");
            })
        .catch(() => {
            this.$Progress.fail();
            Toast.fire({
              icon: "error",
              title: "Unable to delete user"
            });
        });
        }
      });
    },
    getUser(){
      let user = axios.get('api/profile')
          .then((res) => {
            this.user = res.data;
      });
    },
  },

  created() {
    this.getUser();
    Fire.$on('searching', () => {
      let query = this.$parent.search;
      axios.get('api/findUser?q=' + query)
        .then((data) => {
          this.users = data.data
        })
        .catch(() => {})
    });
    this.loadUsers();
    Fire.$on("reloadUsers", () => {
      this.loadUsers();
    });
  }
};
</script>
