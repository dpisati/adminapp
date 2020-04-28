<template>
  <div>
    <!-- ///////////////////////////-- CATEGORIES TABLE --///////////////////////////// -->
    <div class="container mt-5">
      <div v-if="!$gate.isAdminOrManegerOrOwner()">
        <not-found></not-found>
      </div>
      <div class="row d-flex justify-content-center" v-if="$gate.isAdminOrManegerOrOwner()">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title mt-2">Categories Table</h3>
              <div class="card-tools">
                <div class="input-group input-group-sm hidden-xs">
                  <button class="btn btn-success btn-sm mr-3 m-2" @click="newModal">
                    <i class="fas fa-columns mr-2"></i>
                    Add Category
                  </button>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive no-padding ">
              <table class="table table-hover">
                <tbody>
                  <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Modify</th>
                  </tr>

                  <tr v-for="category in categories" :key="category.id">
                    <td>{{ category.id }}</td>
                    <td>{{ category.name | upText }}</td>
                    <td>
                      <a href="#" @click="editModal(category)">
                        <i class="fa fa-edit mr-2"></i>
                      </a>
                      /
                      <a href="#" @click="deleteCategory(category.id)">
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
    <!-- ///////////////////////////-- CATEGORIES TABLE --///////////////////////////// -->
    <!-- ///////////////////////////-- SUBCATEGORIES TABLE --///////////////////////////// -->
    <div class="container mt-2">
      <div v-if="!$gate.isAdminOrManegerOrOwner()">
        <not-found></not-found>
      </div>
      <div class="row d-flex justify-content-center" v-if="$gate.isAdminOrManegerOrOwner()">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title mt-2">Sub-Categories Table</h3>
              <div class="card-tools">
                <div class="input-group input-group-sm hidden-xs">
                  <button class="btn btn-success btn-sm mr-3 m-2" @click="newModalSub">
                    <i class="fas fa-columns mr-2"></i>
                    Add Sub-Category
                  </button>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive no-padding ">
              <table class="table table-hover">
                <tbody>
                  <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Sub-Category</th>
                    <th>Modify</th>
                  </tr>

                  <tr v-for="subcategory in subcategories" :key="subcategory.id">
                    <td>{{ subcategory.id }}</td>
                    <td>{{ subcategory.category.name }}</td>
                    <td>{{ subcategory.name | upText }}</td>
                    <td>
                      <a href="#" @click="editModalSub(subcategory)">
                        <i class="fa fa-edit mr-2"></i>
                      </a>
                      /
                      <a href="#" @click="deleteSubCategory(subcategory.id)">
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
    <!-- ///////////////////////////-- SUBCATEGORIES TABLE --///////////////////////////// -->
    <!-- Modal Category -->
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
            >{{ editmode ? "Edit Category" : "Create New Category" }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="editmode ? updateCategory() : createCategory()">
              <div class="form-group">
                <input
                  placeholder="Category Name"
                  v-model="form.name"
                  type="text"
                  name="name"
                  class="form-control"
                  :class="{'is-invalid': form.errors.has('name')}"
                />
                <has-error :form="form" field="categoryname"></has-error>
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
<!-- Modal Sub-Category -->
    <div
      class="modal fade"
      id="addNewSub"
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
            >{{ editmode ? "Edit Sub-Category" : "Create New Sub-Category" }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="editmode ? updateSubCategory() : createSubCategory()">

              <div class="form-group">
                <select
                  v-model="form.category_id"
                  name="category"
                  class="form-control"
                  :class="{'is-invalid': form.errors.has('category')}"
                >
                  <option value disabled selected>- Category -</option>
                  <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
                </select>
                <has-error :form="form" field="category"></has-error>
              </div>
              <div class="form-group">
                <input
                  placeholder="Sub-Category Name"
                  v-model="form.name"
                  type="text"
                  name="name"
                  class="form-control"
                  :class="{'is-invalid': form.errors.has('name')}"
                />
                <has-error :form="form" field="categoryname"></has-error>
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
<!-- Modal Sub-Category -->




  </div>
</template>

<script>
export default {
  data() {
    return {
      categories: {},
      subcategories: {},
      editmode: true,

      form: new Form({
        name: "",
        id: "",
        category_id: "",
      })
    };
  },

  methods: {
    getCategories() {
            axios.get('api/category')
              .then(response => {
                this.categories = response.data;
				});
    },
    getSubCategories() {
            axios.get('api/subcategory')
              .then(response => {
                this.subcategories = response.data;
				});
    },
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#addNew").modal("show");
    },
    newModalSub() {
      this.editmode = false;
      this.form.reset();
      $("#addNewSub").modal("show");
    },
    editModal(category) {
      this.editmode = true;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.fill(category);
    },

    createCategory() {
      this.form
        .post("api/category")
        .then(() => {
          this.$Progress.start();
          Fire.$emit("reloadCategories");
          $("#addNew").modal("hide");
          Toast.fire({
            icon: "success",
            title: "Category created successfully"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          Toast.fire({
            icon: "error",
            title: "Unable to create category"
          });
        });
    },
    createSubCategory() {
      this.form
        .post("api/subcategory")
        .then(() => {
          this.$Progress.start();
          Fire.$emit("reloadCategories");
          $("#addNewSub").modal("hide");
          Toast.fire({
            icon: "success",
            title: "Sub-Category created successfully"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          Toast.fire({
            icon: "error",
            title: "Unable to create sub-category"
          });
        });
    },

    updateCategory() {
      this.$Progress.start();
      this.form
        .put("api/category/" + this.form.id)
        .then(() => {
          Toast.fire({
            icon: "success",
            title: "Category updated"
          });
          $("#addNew").modal("hide");
          this.$Progress.finish();
          Fire.$emit("reloadCategories");
        })
        .catch(() => {
          this.$Progress.fail();
          Toast.fire({
            icon: "error",
            title: "Unable to update category"
          });
        });
    },
    updateSubCategory() {
      this.$Progress.start();
      this.form
        .put("api/subcategory/" + this.form.id)
        .then(() => {
          Toast.fire({
            icon: "success",
            title: "Sub-Category updated"
          });
          $("#addNewSub").modal("hide");
          this.$Progress.finish();
          Fire.$emit("reloadCategories");
        })
        .catch(() => {
          this.$Progress.fail();
          Toast.fire({
            icon: "error",
            title: "Unable to update sub-category"
          });
        });
    },
    loadCategories() {
        this.$Progress.start();
        axios.get("api/category").then(({ data }) => (this.categories = data));
        this.$Progress.finish();
    },
    deleteCategory(id) {
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
            .delete("api/category/" + id)
            .then(() => {
              Swal.fire("Deleted!", "Category has been deleted.", "success");
              Fire.$emit("reloadCategories");
            })
        .catch(() => {
            this.$Progress.fail();
            Toast.fire({
              icon: "error",
              title: "Unable to delete category"
            });
        });
        }
      });
    },
    deleteSubCategory(id) {
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
            .delete("api/subcategory/" + id)
            .then(() => {
              Swal.fire("Deleted!", "Sub-Category has been deleted.", "success");
              Fire.$emit("reloadCategories");
            })
        .catch(() => {
            this.$Progress.fail();
            Toast.fire({
              icon: "error",
              title: "Unable to delete sub-category"
            });
        });
        }
      });
    },
    getCategory(){
      axios.get('api/category')
          .then((res) => {
            this.categories = res.data;
      });
    },
  },

  created() {
    this.getCategories();
    this.getSubCategories();    
    Fire.$on("reloadCategories", () => {
      this.loadCategories();
      this.getSubCategories();
    });
  }
};
</script>
