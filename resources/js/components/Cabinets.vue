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
                <select
                  v-model="form.subcategory_id"
                  name="subcategory"
                  class="form-control"
                  :class="{'is-invalid': form.errors.has('subcategory')}"
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
                  <option value="Parametrical">Parametrical</option>
                </select>
                <has-error :form="form" field="measure_type"></has-error>
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
                  <input class="" @change="updatePicture" type="file" id="inputFile" name="cabinet_picture" accept="image/png, image/jpeg">
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
            category_id: "",
            min_width: "",
            max_width: "",
            min_height: "",
            max_height: "",
            min_depth: "",
            max_depth: "",            
            subcategory_id: ""
        })
        };
    },
    methods: {
        newModal() {
            this.editmode = false;
            this.form.reset();
            $("#addNew").modal("show");
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
         updatePicture(){
            this.$Progress.start();
            this.form.put('api/cabinet')
                .then(() => {
                    Toast.fire({
                            icon: "success",
                            title: "User updated"
                        });
                    axios
                    .get("api/cabinet")
                    .then(({ data }) => {
                        this.$Progress.finish();
                        this.currentPhoto = data.picture;
                        return this.form.fill(data);
                    })
                    .catch(() => {
                        this.$Progress.fail();
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
        created() {
            this.getCabinets();
            this.getCategories();  
            this.getSubCategories();  
            Fire.$on("reloadCabinets", () => {
                this.loadCabinets();
            });
        }
    }
</script>
