<template>
  <div class="container">

      <div class="row d-flex justify-content-center">
        <div class="col-md-12 mt-5">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title mt-2">Suppliers Table</h3>
              <div class="card-tools" v-if="$gate.isAdminOrManegerOrOwner()">
                <div class="input-group input-group-sm hidden-xs">
                  <button class="btn btn-success btn-sm mr-3 m-2" @click="newModalSupplier">
                    <i class="fas fa-cube mr-2"></i>
                    Add Supplier
                  </button>
                </div>
              </div>
            </div>

            <div class="card-body table-responsive no-padding ">
              <table class="table table-hover">
                <tbody>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th v-if="$gate.isAdminOrManegerOrOwner()">Modify</th>
                  </tr>

                  <tr v-for="supplier in suppliers" :key="supplier.id">
                    <td>{{ supplier.id }}</td>
                    <td>{{ supplier.name | upText }}</td>
                    <td v-if="$gate.isAdminOrManegerOrOwner()">
                      <a href="#" @click="editModalSupplier(supplier)">
                        <i class="fa fa-edit mr-2"></i>
                      </a>
                      /
                      <a href="#" @click="deleteSupplier(supplier.id)">
                        <i class="fa fa-trash-alt ml-2"></i>
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div> 
        

        <div class="col-md-12 mt-3">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title mt-2">Materials Table</h3>
              <div class="card-tools" v-if="$gate.isAdminOrManegerOrOwner()">
                <div class="input-group input-group-sm hidden-xs">
                  <button class="btn btn-success btn-sm mr-3 m-2" @click="newModal">
                    <i class="fas fa-cube mr-2"></i>
                    Add Material
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
                    <th>Supplier</th>
                    <th>Name</th>
                    <th>Range</th>
                    <th>Stock</th>
                    <th v-if="$gate.isAdminOrManegerOrOwner()">Modify</th>
                  </tr>

                  <tr v-for="material in materials" :key="material.id">
                    <td>{{ material.id }}</td>
                    <td>{{ material.supplier.name | upText }}</td>
                    <td><router-link :to="'/material/' + material.id"> {{ material.name | upText }} {{ material.finish | upText }} </router-link></td>
                    <td>{{ material.range | upText }}</td>
                    <td>{{ material.stock | upText }}</td>
                    <td v-if="$gate.isAdminOrManegerOrOwner()">
                      <a href="#" @click="editModal(material)">
                        <i class="fa fa-edit mr-2"></i>
                      </a>
                      /
                      <a href="#" @click="deleteMaterial(material.id)">
                        <i class="fa fa-trash-alt ml-2"></i>
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>



        <div class="col-md-12 mt-3">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title mt-2">Finishes Table</h3>
              <div class="card-tools" v-if="$gate.isAdminOrManegerOrOwner()">
                <div class="input-group input-group-sm hidden-xs">
                  <button class="btn btn-success btn-sm mr-3 m-2" @click="newModalFinish">
                    <i class="fas fa-cube mr-2"></i>
                    Add Finish
                  </button>
                </div>
              </div>
            </div>
            
            <div class="card-body table-responsive no-padding ">
              <table class="table table-hover">
                <tbody>
                  <tr>
                    <th>ID</th>
                    <th>Supplier</th>
                    <th>Finish</th>
                    <th v-if="$gate.isAdminOrManegerOrOwner()">Modify</th>
                  </tr>

                  <tr v-for="finish in allfinishes" :key="finish.id">
                    <td>{{ finish.id }}</td>
                    <td>{{ finish.supplier.name | upText }}</td>
                    <td>{{ finish.name | upText  }}</td>
                    <td v-if="$gate.isAdminOrManegerOrOwner()">
                      <a href="#" @click="editModalFinish(finish)">
                        <i class="fa fa-edit mr-2"></i>
                      </a>
                      /
                      <a href="#" @click="deleteFinish(finish.id)">
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

<!-- Modal Supplier -->
    <div
      class="modal fade"
      id="addNewSupplier"
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
            >{{ editmode ? "Edit Supplier" : "Create New Supplier" }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form
              @submit.prevent="editmode ? updateSupplier() : createSupplier()"
              @keyup.enter.prevent="editmode ? updateSupplier() : createSupplier()"
            >
              <div class="form-group">
                <input
                  placeholder="Supplier Name"
                  v-model="form.name"
                  type="text"
                  name="name"
                  class="form-control"
                  :class="{'is-invalid': form.errors.has('name')}"
                />
                <has-error :form="form" field="suppliername"></has-error>
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
<!-- Modal Supplier -->


<!-- Modal Material -->
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
            >{{ editmode ? "Edit Material" : "Create New Material" }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form
              @submit.prevent="editmode ? updateMaterial() : createMaterial()"
              @keyup.enter.prevent="editmode ? updateMaterial() : createMaterial()"
            >
               <div class="form-group">
                <select
                  @change="loadFinishes"
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
                <input
                  placeholder="Material Name"
                  v-model="form.name"
                  type="text"
                  name="name"
                  class="form-control"
                  :class="{'is-invalid': form.errors.has('name')}"
                />
                <has-error :form="form" field="username"></has-error>
              </div>

                <div class="form-group">
                  <select
                    v-model="form.finish"
                    name="finish"
                    class="form-control"
                    :class="{'is-invalid': form.errors.has('finish')}"
                  >
                    <option value disabled selected>- Finish -</option>
                    <option
                      v-for="finish in finishes"
                      :key="finish.name"
                      :value="finish.name"
                    >{{ finish.name }}</option>
                  </select>
                  <has-error :form="form" field="finish"></has-error>
                </div>

                <div class="form-group">
                <select
                  v-model="form.range"
                  name="range"
                  class="form-control"
                  :class="{'is-invalid': form.errors.has('range')}"
                >
                  <option value disabled selected>- Range -</option>
                  <option value="One">One</option>
                  <option value="Two">Two</option>
                  <option value="Three">Three</option>
                  <option value="Four">Four</option>
                </select>
                <has-error :form="form" field="range"></has-error>
              </div>


              <div class="form-group">
                <select
                  v-model="form.stock"
                  name="stock"
                  class="form-control"
                  :class="{'is-invalid': form.errors.has('stock')}"
                >
                  <option value disabled selected>- Stock -</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
                <has-error :form="form" field="stock"></has-error>
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
<!-- Modal Material -->



<!-- Modal Finish -->
    <div
      class="modal fade"
      id="addNewFinish"
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
            >{{ editmode ? "Edit Finish" : "Create New Finish" }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form
              @submit.prevent="editmode ? updateFinish() : createFinish()"
              @keyup.enter.prevent="editmode ? updateFinish() : createFinish()"
            >
               <div class="form-group">
                <select
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
                <input
                  placeholder="Finish Name"
                  v-model="form.name"
                  type="text"
                  name="name"
                  class="form-control"
                  :class="{'is-invalid': form.errors.has('name')}"
                />
                <has-error :form="form" field="username"></has-error>
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
<!-- Modal Finish -->


  </div>
</template>

<script>
export default {
    data() {
        return {
        materials: {},
        suppliers: {},
        finishes: {},
        allfinishes: {},
        editmode: false,
        form: new Form({
            id: "",
            supplier_id: "",
            name: "",
            finish: "",
            stock: "",
            range: "",
            texture: ""
        })
        };
    },
    methods: {
        newModal() {
            this.editmode = false;
            this.form.reset();
            $("#addNew").modal("show");
        },
        editModal(material) {
          this.editmode = true;
          this.form.reset();
          $("#addNew").modal("show");
          this.form.fill(material);
        },
        newModalSupplier() {
            this.editmode = false;
            this.form.reset();
            $("#addNewSupplier").modal("show");
        },
        editModalSupplier(supplier) {
          this.editmode = true;
          this.form.reset();
          $("#addNewSupplier").modal("show");
          this.form.fill(supplier);
        },
        newModalFinish() {
            this.editmode = false;
            this.form.reset();
            $("#addNewFinish").modal("show");
        },
        editModalFinish(finish) {
          this.editmode = true;
          this.form.reset();
          $("#addNewFinish").modal("show");
          this.form.fill(finish);
        },
        getMaterials() {
            axios.get('api/material')
            .then(response => {
                this.materials = response.data;
            });
        },
        getSuppliers() {
            axios.get('api/supplier')
            .then(response => {
                this.suppliers = response.data;
			      });
        },
        getFinishes() {
            axios.get('api/finish')
            .then(response => {
                this.allfinishes = response.data;
			      });
        },
        loadFinishes() {
          this.$Progress.start();
          axios
          .get("/api/finish/" + this.form.supplier_id)
          .then(({ data }) => {
              console.log(data);
              this.finishes = data;
              this.$Progress.finish();
          })
          .catch(() => {
              this.$Progress.fail();
          });
        },
        createMaterial() {
          this.form
            .post("api/material")
            .then(() => {
              this.$Progress.start();
              Fire.$emit("reloadMaterials");
              $("#addNew").modal("hide");
              Toast.fire({
                icon: "success",
                title: "Material created successfully"
              });
              this.$Progress.finish();
            })
            .catch(() => {
              Toast.fire({
                icon: "error",
                title: "Unable to create Material"
              });
            });
        },
        createSupplier() {
          this.form
            .post("api/supplier")
            .then(() => {
              this.$Progress.start();
              Fire.$emit("reloadMaterials");
              $("#addNewSupplier").modal("hide");
              Toast.fire({
                icon: "success",
                title: "Supplier created successfully"
              });
              this.$Progress.finish();
            })
            .catch(() => {
              Toast.fire({
                icon: "error",
                title: "Unable to create supplier"
              });
            });
        },
        createFinish() {
          this.form
            .post("api/finish")
            .then(() => {
              this.$Progress.start();
              Fire.$emit("reloadMaterials");
              $("#addNewFinish").modal("hide");
              Toast.fire({
                icon: "success",
                title: "Finish created successfully"
              });
              this.$Progress.finish();
            })
            .catch(() => {
              Toast.fire({
                icon: "error",
                title: "Unable to create finish"
              });
            });
        },
         updateTexture(e) {
            let file = e.target.files[0];
            let reader = new FileReader();
            if(file['size'] < 2111775) {
                reader.onloadend = (file) => { this.form.texture = reader.result }
                reader.readAsDataURL(file);
            } else {
                Swal.fire("Oops...", "Picture bigger than 2mb", "error");
                this.form.photo = "no-preview.png"
            }
        },
        updateMaterial() {
          this.$Progress.start();
          this.form
            .put("api/material/" + this.form.id)
            .then(() => {
              Toast.fire({
                icon: "success",
                title: "Material updated"
              });
              $("#addNew").modal("hide");
              this.$Progress.finish();
              Fire.$emit("reloadMaterials");
            })
            .catch(() => {
              this.$Progress.fail();
              Toast.fire({
                icon: "error",
                title: "Unable to update Material"
              });
            });
        },
        updateSupplier() {
          this.$Progress.start();
          this.form
            .put("api/supplier/" + this.form.id)
            .then(() => {
              Toast.fire({
                icon: "success",
                title: "Supplier updated"
              });
              $("#addNewSupplier").modal("hide");
              this.$Progress.finish();
              Fire.$emit("reloadMaterials");
            })
            .catch(() => {
              this.$Progress.fail();
              Toast.fire({
                icon: "error",
                title: "Unable to update supplier"
              });
            });
        },
        updateFinish() {
          this.$Progress.start();
          this.form
            .put("api/finish/" + this.form.id)
            .then(() => {
              Toast.fire({
                icon: "success",
                title: "Finish updated"
              });
              $("#addNewFinish").modal("hide");
              this.$Progress.finish();
              Fire.$emit("reloadMaterials");
            })
            .catch(() => {
              this.$Progress.fail();
              Toast.fire({
                icon: "error",
                title: "Unable to update finish"
              });
            });
        },
        deleteMaterial(id) {
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
                  .delete("api/material/" + id)
                  .then(() => {
                    Swal.fire("Deleted!", "Material has been deleted.", "success");
                    Fire.$emit("reloadMaterials");
                  })
              .catch(() => {
                  this.$Progress.fail();
                  Toast.fire({
                    icon: "error",
                    title: "Unable to delete Material"
                  });
              });
          }
        });
      },
        deleteSupplier(id) {
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
                  .delete("api/supplier/" + id)
                  .then(() => {
                    Swal.fire("Deleted!", "Supplier has been deleted.", "success");
                    Fire.$emit("reloadMaterials");
                  })
              .catch(() => {
                  this.$Progress.fail();
                  Toast.fire({
                    icon: "error",
                    title: "Unable to delete supplier"
                  });
              });
          }
        });
      },
        deleteFinish(id) {
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
                  .delete("api/finish/" + id)
                  .then(() => {
                    Swal.fire("Deleted!", "Finsih has been deleted.", "success");
                    Fire.$emit("reloadMaterials");
                  })
              .catch(() => {
                  this.$Progress.fail();
                  Toast.fire({
                    icon: "error",
                    title: "Unable to delete finish"
                  });
              });
          }
        });
      },
    },
        created() {
            this.getMaterials();
            this.getSuppliers();  
            this.getFinishes();
            Fire.$on('searching', () => {
              let query = this.$parent.search;
              axios.get('api/findMaterial?q=' + query)
                .then((data) => {
                  this.materials = data.data.data
                })
                .catch(() => {})
            });
            Fire.$on("reloadMaterials", () => {
                this.getMaterials();
                this.getSuppliers();  
                this.getFinishes();
            });
        }
    }
</script>
