<template>
  <div class="container mt-2">
      <div v-if="!$gate.isAdminOrManegerOrOwner()">
        <not-found></not-found>
      </div>
      <div class="row d-flex justify-content-center" v-if="$gate.isAdminOrManegerOrOwner()">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title mt-2">Cabinets Table</h3>
              <div class="card-tools">
                <div class="input-group input-group-sm hidden-xs">
                  <button class="btn btn-success btn-sm mr-3 m-2" @click="newModal">
                    <i class="fas fa-cube mr-2"></i>
                    Add Cabinet
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
                    <th>Subcategory</th>
                    <th>Name</th>
                    <th>Modify</th>
                  </tr>

                  <tr v-for="cabinet in cabinets" :key="cabinet.id">
                    <td>{{ cabinet.id }}</td>
                    <td>{{ cabinet.subcategory.category.name }}</td>
                    <td>{{ cabinet.subcategory.name }}</td>
                    <td><router-link :to="'/cabinet/' + cabinet.id"> {{ cabinet.name | upText }} </router-link></td>
                    <td>
                      <a href="#" @click="editModal(cabinet)">
                        <i class="fa fa-edit mr-2"></i>
                      </a>
                      /
                      <a href="#" @click="deleteCabinet(cabinet.id)">
                        <i class="fa fa-trash-alt ml-2"></i>
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
<!-- Modal  -->
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
            >{{ editmode ? "Edit Cabinet" : "Create New Cabinet" }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="editmode ? updateCabinet() : createCabinet()">

              <div v-if="!editmode" class="form-group">
                <select
                  @change="loadSubCategories"
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
                <select
                  v-model="form.sub_category_id"
                  name="sub_category_id"
                  class="form-control"
                  :class="{'is-invalid': form.errors.has('sub_category_id')}"
                >
                  <option value disabled selected>- Sub-Category -</option>
                  <option v-for="subcategory in subcategories" :key="subcategory.id" :value="subcategory.id">{{ subcategory.name }}</option>
                </select>
                <has-error :form="form" field="subcategory"></has-error>
              </div>


              <div class="form-group">
                <input
                  placeholder="Cabinet Name"
                  v-model="form.name"
                  type="text"
                  name="name"
                  class="form-control"
                  :class="{'is-invalid': form.errors.has('name')}"
                />
                <has-error :form="form" field="categoryname"></has-error>
              </div>

              <div class="form-group">
                <select
                  v-model="form.measure_type"
                  name="measure_type"
                  class="form-control"
                  :class="{'is-invalid': form.errors.has('measure_type')}"
                >
                  <option value disabled selected>- Measure Type -</option>
                  <option value="Single">Single</option>
                  <option value="Multiple">Multiple</option>
                  <option value="Parametric">Parametric</option>
                </select>
                <has-error :form="form" field="measure_type"></has-error>
              </div>

              <div class="form-group">
                <select
                  v-model="form.type"
                  name="type"
                  class="form-control"
                  :class="{'is-invalid': form.errors.has('type')}"
                >
                  <option value disabled selected>- Cabinet Type -</option>
                  <option value="Cabinet">Cabinet</option>
                  <option value="Panel">Panel</option>
                </select>
                <has-error :form="form" field="type"></has-error>
              </div>


            <div class="form-row mb-1">
              <div class="form-group col-md-6">
                <input
                  placeholder="Minimum Width"
                  v-model="form.min_width"
                  type="text"
                  name="min_width"
                  class="form-control"
                  :class="{'is-invalid': form.errors.has('min_width')}"
                />
                <has-error :form="form" field="min_width"></has-error>
              </div>
              <div class="form-group col-md-6">
                <input
                  placeholder="Maximum Width"
                  v-model="form.max_width"
                  type="text"
                  name="max_width"
                  class="form-control"
                  :class="{'is-invalid': form.errors.has('max_width')}"
                />
                <has-error :form="form" field="max_width"></has-error>
              </div>
            </div>

            <div class="form-row mb-1">
              <div class="form-group col-md-6">
                <input
                  placeholder="Minimum Height"
                  v-model="form.min_height"
                  type="text"
                  name="min_height"
                  class="form-control"
                  :class="{'is-invalid': form.errors.has('min_height')}"
                />
                <has-error :form="form" field="min_height"></has-error>
              </div>
              <div class="form-group col-md-6">
                <input
                  placeholder="Maximum Height"
                  v-model="form.max_height"
                  type="text"
                  name="max_height"
                  class="form-control"
                  :class="{'is-invalid': form.errors.has('max_height')}"
                />
                <has-error :form="form" field="max_height"></has-error>
              </div>
            </div>

            <div class="form-row mb-1">
              <div class="form-group col-md-6">
                <input
                  placeholder="Minimum Depth"
                  v-model="form.min_depth"
                  type="text"
                  name="min_depth"
                  class="form-control"
                  :class="{'is-invalid': form.errors.has('min_depth')}"
                />
                <has-error :form="form" field="min_depth"></has-error>
              </div>
              <div class="form-group col-md-6">
                <input
                  placeholder="Maximum Depth"
                  v-model="form.max_depth"
                  type="text"
                  name="max_depth"
                  class="form-control"
                  :class="{'is-invalid': form.errors.has('max_depth')}"
                />
                <has-error :form="form" field="max_depth"></has-error>
              </div>
            </div>

            <div class="form-group">
                <label for="inputExperience">Cabinet Picture</label>
                <div class="w-100 mt-2">
                  <input @change="updatePicture" type="file" id="inputFile" name="picture" accept="image/png, image/jpeg">
                </div>
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
    </div>
    
</template>

<script>
export default {
    data() {
        return {
        cabinets: {},
        categories: {},
        subcategories: {},
        editmode: false,
        form: new Form({
            name: "",
            measure_type: "",
            id: "",
            picture: "",
            category_id: "",
            min_width: "",
            max_width: "",
            min_height: "",
            max_height: "",
            min_depth: "",
            max_depth: "",            
            sub_category_id: "",
            type: ""
        })
        };
    },
    methods: {
        newModal() {
            this.editmode = false;
            this.form.reset();
            $("#addNew").modal("show");
        },
        editModal(cabinet) {
          this.editmode = true;
          this.form.reset();
          $("#addNew").modal("show");
          this.form.fill(cabinet);
        },
        getCabinets() {
            axios.get('api/library')
            .then(response => {
                this.cabinets = response.data;
            });
        },
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
        loadSubCategories() {
          this.$Progress.start();
          axios
          .get("/api/subcategory/" + this.form.category_id)
          .then(({ data }) => {
              this.subcategories = data;
              this.$Progress.finish();
          })
          .catch(() => {
              this.$Progress.fail();
          });
        },
        createCabinet() {
          this.form
            .post("api/library")
            .then(() => {
              this.$Progress.start();
              Fire.$emit("reloadCabinets");
              $("#addNew").modal("hide");
              Toast.fire({
                icon: "success",
                title: "Cabinet created successfully"
              });
              this.$Progress.finish();
            })
            .catch(() => {
              Toast.fire({
                icon: "error",
                title: "Unable to create cabinet"
              });
            });
        },
         updatePicture(e) {
            let file = e.target.files[0];
            let reader = new FileReader();
            if(file['size'] < 2111775) {
                reader.onloadend = (file) => { this.form.picture = reader.result }
                reader.readAsDataURL(file);
            } else {
                Swal.fire("Oops...", "Picture bigger than 2mb", "error");
                this.form.photo = "no-preview.png"
            }
        },
        updateCabinet() {
          this.$Progress.start();
          this.form
            .put("api/library/" + this.form.id)
            .then(() => {
              Toast.fire({
                icon: "success",
                title: "Cabinet updated"
              });
              $("#addNew").modal("hide");
              this.$Progress.finish();
              Fire.$emit("reloadCabinets");
            })
            .catch(() => {
              this.$Progress.fail();
              Toast.fire({
                icon: "error",
                title: "Unable to update cabinet"
              });
            });
        },
        deleteCabinet(id) {
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
                  .delete("api/library/" + id)
                  .then(() => {
                    Swal.fire("Deleted!", "Cabinet has been deleted.", "success");
                    Fire.$emit("reloadCabinets");
                  })
              .catch(() => {
                  this.$Progress.fail();
                  Toast.fire({
                    icon: "error",
                    title: "Unable to delete cabinet"
                  });
              });
          }
        });
      },
    },
        created() {
            this.getCabinets();
            this.getCategories();  
            this.getSubCategories();  
            Fire.$on("reloadCabinets", () => {
                this.getCabinets();
            });
        }
    }
</script>
