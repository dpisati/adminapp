<template>
  <div class="container">
      <!-- <div v-if="!$gate.isAdminOrManegerOrOwner()">
        <not-found></not-found>
      </div>
      <div class="row d-flex justify-content-center" v-if="$gate.isAdminOrManegerOrOwner()"> -->
      <div class="row d-flex justify-content-center">
        <div class="col-md-12 mt-5">
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
                    <th>Finish</th>
                    <th v-if="$gate.isAdminOrManegerOrOwner()">Modify</th>
                  </tr>

                  <tr v-for="material in materials" :key="material.id">
                    <td>{{ material.id }}</td>
                    <td>{{ material.supplier.name }}</td>
                    <td><router-link :to="'/material/' + material.id"> {{ material.name | upText }} </router-link></td>
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
      </div>
    </div>
    
</template>

<script>
export default {
    data() {
        return {
        materials: {},
        suppliers: {},
        finishes: {},
        editmode: false,
        form: new Form({
            id: "",
            supplier_id: "",
            name: "",
            finish: "",
            stock: "",
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
                this.finishes = response.data;
			      });
        },
        loadFinishes() {
          this.$Progress.start();
          axios
          .get("/api/finishes/" + this.form.supplier_id)
          .then(({ data }) => {
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
            });
        }
    }
</script>
