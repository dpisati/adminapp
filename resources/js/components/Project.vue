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
          <div class="card card-widget widget-user">
            <div
              class="d-flex widget-user-header bg-white justify-content-center align-items-center"
            >
              <h3 class="widget-user-username">{{ this.project.name }}</h3>
            </div>
            <div class="card-footer pt-3">
              <div class="row">
                <div class="col-sm-6 border-right">
                  <div class="description-block">
                    <h5 class="description-header">{{ totalCabinets }}</h5>
                    <span class="description-text">CABINETS</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                  <div class="description-block">
                    <h5 class="description-header">{{ totalPanels }}</h5>
                    <span class="description-text">PANELS</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
          <div class="mb-3" v-if="project.status != 'Sold'">
            <div class="input-group input-group-sm hidden-xs">
              <button class="btn btn-success mr-3 m-2" @click="newModal">
                <i class="fas fa-house-user nav-icon mr-2"></i>
                Add Room
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card" v-for="room in rooms" :key="room.id">
            <div class="card-header">
              <h3 class="card-title mt-2">{{ room.name }}</h3>
              <div class="card-tools" v-if="project.status != 'Sold'">
                <div class="input-group input-group-sm hidden-xs">
                  <button class="btn btn-success btn-sm mr-3 m-2" @click="addCabinetModal(room)">
                    <i class="fas fa-inbox nav-icon mr-2"></i>
                    Add Cabinet
                  </button>
                  <button class="btn btn-secondary btn-sm mr-3 m-2" @click="editModal(room)">
                    <i class="fas fa-edit nav-icon mr-2"></i>
                    Update Room
                  </button>
                  <button class="btn btn-danger btn-sm mr-3 m-2" @click="deleteRoom(room.id)">
                    <i class="fas fa-trash nav-icon mr-2"></i>
                    Delete Room
                  </button>
                </div>
              </div>
            </div>

            <div class="card-footer pt-3">
              <div class="row">
                <div class="col-sm-6 border-right">
                  <div class="description-block">
                    <h5 class="description-header">{{ room.material }}</h5>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                  <div class="description-block">
                    <h5 class="description-header">{{ room.handle }}</h5>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
                





            <div class="card-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody>
                  <tr>
                    <!-- <th>ID</th> -->
                    <th>Quantity</th>
                    <th>Name</th>
                    <th>Width</th>
                    <th>Height</th>
                    <th>Depth</th>
                    <th>Comment</th>
                    <th v-if="project.status != 'Sold'">Modify</th>
                  </tr>
                  <tr v-for="cabinet in room.cabinets" :key="cabinet.id">
                    <!-- <td>{{ cabinet.id }}</td> -->
                    <td>{{ cabinet.quantity }}</td>
                    <td>
                      <router-link
                        :to="'/cabinet/' + cabinet.cabinet_id"
                      >{{ cabinet.name | upText }}</router-link>
                    </td>
                    <td>{{ cabinet.width }}</td>
                    <td>{{ cabinet.height }}</td>
                    <td>{{ cabinet.depth }}</td>
                    <td v-if="cabinet.comment">{{ cabinet.comment }}</td>
                    <td v-else>-</td>
                    <td v-if="project.status != 'Sold'">
                      <a href="#" @click="editModalCabinet(cabinet)">
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
      </div>
    </div>

    <!-- Room Modal -->
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
            >{{ editmode ? "Edit Room" : "Create New Room" }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form
              @submit.prevent="editmode ? updateRoom() : createRoom()"
              @keyup.enter.prevent="editmode ? updateRoom() : createRoom()"
            >
              <div class="form-group">
                <input
                  placeholder="Room Name"
                  v-model="form.name"
                  type="text"
                  name="name"
                  class="form-control"
                  :class="{'is-invalid': form.errors.has('name')}"
                />
                <has-error :form="form" field="roomname"></has-error>
              </div>

              <div class="form-group">
                <select
                  @change="loadMaterials"
                  v-model="form.supplier_id"
                  name="supplier"
                  class="form-control"
                  :class="{'is-invalid': form.errors.has('supplier')}"
                >
                  <option value disabled selected>- Supplier -</option>
                  <option
                    v-for="supplier in suppliers"
                    :key="supplier.id"
                    :value="supplier.id"
                  >{{ supplier.name }}</option>
                </select>
                <has-error :form="form" field="supplier"></has-error>
              </div>


              <div class="form-group">
                <select
                  @change="loadSupplierName"
                  v-model="form.material"
                  name="material"
                  class="form-control"
                  :class="{'is-invalid': form.errors.has('material')}"
                >
                  <option value disabled selected>- Material -</option>
                  <option
                    v-for="material in materials"
                    :key="material.id"
                    :value="material.name + ' ' + material.finish"
                  >{{ material.name }} {{ material.finish }} </option>
                </select>
                <has-error :form="form" field="material"></has-error>
              </div>

              <div class="form-group">
                <select
                  v-model="form.handle"
                  name="handle"
                  class="form-control"
                  :class="{'is-invalid': form.errors.has('handle')}"
                >
                  <option value disabled selected>- Handle -</option>
                  <option value="No Handle">No Handle</option>
                  <option value="Strip Handle">Strip Handle</option>
                  <option value="Hidden Handle">Hidden Handle</option>
                </select>
                <has-error :form="form" field="handle"></has-error>
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
    <!-- Room Modal -->
    <!-- Cabinet Modal -->
    <div
      class="modal fade"
      id="addNewCabinet"
      tabindex="-1"
      role="dialog"
      aria-labelledby="addNewLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5
              class="modal-title"
              id="addNewLabel"
            >{{ editmode ? "Edit Cabinet" : "Add New Cabinet" }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form
              @submit.prevent="editmode ? updateCabinet() : addCabinet()"
              @keyup.enter.prevent="editmode ? updateCabinet() : addCabinet()"
            >
              <div class="form-row">
                <!-- <div class="form-group col-md-2">
                        <input type="text" class="form-control" placeholder="id" v-model="form.id">
                </div>-->

                <div v-if="!editmode" class="form-group col-md-4">
                  <select
                    @change="loadSubCategories"
                    v-model="form.category"
                    name="category"
                    class="form-control"
                    :class="{'is-invalid': form.errors.has('category')}"
                  >
                    <option value disabled selected>- Category -</option>
                    <option
                      v-for="category in categories"
                      :key="category.id"
                      :value="category.id"
                    >{{ category.name }}</option>
                  </select>
                  <has-error :form="form" field="category"></has-error>
                </div>

                <div v-if="!editmode" class="form-group col-md-4">
                  <select
                    @change="loadCabinets"
                    v-model="form.subcategory"
                    name="subcategory"
                    class="form-control"
                    :class="{'is-invalid': form.errors.has('subcategory')}"
                  >
                    <option value disabled selected>- Sub Category -</option>
                    <option
                      v-for="subcategory in subcategories"
                      :key="subcategory.id"
                      :value="subcategory.id"
                    >{{ subcategory.name }}</option>
                  </select>
                  <has-error :form="form" field="subcategory"></has-error>
                </div>

                <div v-if="!editmode" class="form-group col-md-4">
                  <select
                    @change="loadCabinetInfo"
                    v-model="form.cabinets"
                    name="cabinet"
                    class="form-control"
                    :class="{'is-invalid': form.errors.has('cabinet')}"
                  >
                    <option value disabled selected>- Cabinet -</option>
                    <option
                      v-for="cabinet in cabinets"
                      :key="cabinet.id"
                      :value="cabinet.id"
                    >{{ cabinet.name }}</option>
                  </select>
                  <has-error :form="form" field="cabinet"></has-error>
                </div>
              </div>

              <div class="form-row mb-1">
                <div class="form-group col-md-4">
                  <input 
                    name="width"
                    type="text" 
                    class="form-control"
                    :class="{'is-invalid': form.errors.has('width')}"
                    placeholder="Width" 
                    v-model="form.width" 
                  />
                  <has-error :form="form" field="width"></has-error>
                </div>
                <div class="form-group col-md-4">
                  <input
                    name="height"
                    type="text"
                    class="form-control"
                    placeholder="Height"
                    v-model="form.height"
                    :class="{'is-invalid': form.errors.has('height')}"
                  />
                  <has-error :form="form" field="height"></has-error>
                </div>
                <div class="form-group col-md-4">
                  <input 
                    name="depth"
                    type="text" 
                    class="form-control" 
                    placeholder="Depth" 
                    v-model="form.depth" 
                    :class="{'is-invalid': form.errors.has('depth')}"
                  />
                  <has-error :form="form" field="depth"></has-error>
                </div>
                <div class="form-group col-md-4">
                  <input
                    placeholder="Quantity"
                    v-model="form.quantity"
                    type="text"
                    name="quantity"
                    class="form-control"
                    :class="{'is-invalid': form.errors.has('quantity')}"
                  />
                  <has-error :form="form" field="quantity"></has-error>
                </div>
                <div class="form-group col-md-8">
                  <textarea
                    class="form-control"
                    id="comment"
                    rows="1"
                    placeholder="Comment..."
                    v-model="form.comment"
                  ></textarea>
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
    <!-- Room Modal -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      id: this.$route.params.id,
      editmode: true,
      totalCabinets: 0,
      totalPanels: 0,
      project: {},
      rooms: {},
      cabinets: {},
      categories: {},
      subcategories: {},
      allfinishes: {},
      finishes: {},
      materials: {},
      suppliers: {},
      form: new Form({
        id: "",
        quantity: "",
        name: "",
        width: "",
        height: "",
        depth: "",
        comment: "",
        type: "",
        project_id: "",
        cabinet_id: "",
        room_id: "",
        category: "",
        subcategory: "",
        cabinets: "",
        handle: "",
        supplier_id: "",
        completeMaterial: "",
        material: ""
      })
    };
  },
  methods: {
    cabinetTypeCount() {
      this.totalPanels = 0;
      this.totalCabinets = 0;
      this.rooms.forEach(room => {
        room.cabinets.forEach(cabinet => {
          if (cabinet.type == "Cabinet") {
            this.totalCabinets += cabinet.quantity;
          } else {
            this.totalPanels += cabinet.quantity;
          }
        });
      });
    },
    addCabinetModal(room) {
      this.editmode = false;
      this.form.reset();
      this.form.room_id = room.id;
      $("#addNewCabinet").modal("show");
    },
    addCabinet() {
      this.form
        .post("/api/addCabinet")
        .then(() => {
          this.$Progress.start();
          Fire.$emit("reloadRooms");
          $("#addNewCabinet").modal("hide");
          Toast.fire({
            icon: "success",
            title: "Cabinet added successfully"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          Toast.fire({
            icon: "error",
            title: "Unable to add cabinet"
          });
        });
    },
    updateCabinet() {
      this.$Progress.start();
      this.form
        .put("/api/cabinet/" + this.form.id)
        .then(() => {
          Toast.fire({
            icon: "success",
            title: "Cabinet updated"
          });
          this.$Progress.finish();
          Fire.$emit("reloadRooms");
          $("#addNewCabinet").modal("hide");
        })
        .catch(() => {
          this.$Progress.fail();
          Toast.fire({
            icon: "error",
            title: "Unable to update cabinet"
          });
        });
    },
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#addNew").modal("show");
    },
    createRoom() {
      this.form.project_id = this.id;
      this.form
        .post("/api/room")
        .then(() => {
          this.$Progress.start();
          Fire.$emit("reloadRooms");
          $("#addNew").modal("hide");
          Toast.fire({
            icon: "success",
            title: "Room created successfully"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          Toast.fire({
            icon: "error",
            title: "Unable to create room"
          });
        });
    },
    editModal(room) {
      this.editmode = true;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.fill(room);
      this.form.project_id = this.project_id;
    },
    editModalCabinet(cabinet) {
      console.log(cabinet);
      this.editmode = true;
      this.form.reset();
      $("#addNewCabinet").modal("show");
      this.form.fill(cabinet);
      this.form.project_id = this.project_id;
    },
    updateRoom(room) {
      this.form
        .put("/api/room/" + this.form.id)
        .then(() => {
          this.$Progress.start();
          $("#addNew").modal("hide");
          Toast.fire({
            icon: "success",
            title: "Room created successfully"
          });
          Fire.$emit("reloadRooms");
          this.$Progress.finish();
        })
        .catch(() => {
          Toast.fire({
            icon: "error",
            title: "Unable to create room"
          });
        });
    },
    deleteRoom(id) {
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
            .delete("/api/room/" + id)
            .then(() => {
              Swal.fire("Deleted!", "Room has been deleted.", "success");
              Fire.$emit("reloadRooms");
            })
            .catch(() => {
              this.$Progress.fail();
              Toast.fire({
                icon: "error",
                title: "Unable to delete room"
              });
            });
        }
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
            .delete("/api/cabinet/" + id)
            .then(() => {
              Swal.fire("Deleted!", "Cabinet has been deleted.", "success");
              Fire.$emit("reloadRooms");
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
    loadRooms() {
      this.$Progress.start();
      axios
        .get("/api/project/" + this.id)
        .then(({ data }) => {
          this.project = data;
          this.form.project_id = this.id;
          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.fail();
        });
      axios
        .get("/api/room/" + this.id)
        .then(({ data }) => {
          this.rooms = data;
          this.$Progress.finish();
          this.cabinetTypeCount();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    loadCategories() {
      this.$Progress.start();
      axios
        .get("/api/category")
        .then(({ data }) => {
          this.categories = data;
          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    loadSubCategories() {
      this.$Progress.start();
      axios
        .get("/api/subcategory/" + this.form.category)
        .then(({ data }) => {
          this.subcategories = data;
          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    loadCabinets() {
      this.$Progress.start();
      axios
        .get("/api/findCabinetBySubCategory/" + this.form.subcategory)
        .then(({ data }) => {
          this.cabinets = data;
          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    loadCabinetInfo() {
      this.$Progress.start();
      axios
        .get("/api/findCabinet/" + this.form.cabinets)
        .then(({ data }) => {
          this.form.name = data.name;
          this.form.type = data.type;
          this.form.id = data.id;
          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
        loadMaterials() {
            axios.get('/api/findMaterial/' + this.form.supplier_id)
            .then(response => {
                this.materials = response.data;
            });
        },
        getSuppliers() {
            axios.get('/api/supplier')
            .then(response => {
                this.suppliers = response.data;
			      });
        },
        loadSupplierName() {
          this.form.completeMaterial = this.materials[0].supplier.name + ' ' + this.form.material;
        }
  },
  created() {
    this.loadRooms();
    this.loadCategories();
    this.getSuppliers();  
    Fire.$on("reloadRooms", () => {
      this.$Progress.start();
      this.loadRooms();
    });
  }
};
</script>
