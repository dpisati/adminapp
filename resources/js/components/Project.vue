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
                    <!-- Widget: user widget style 1 -->
                    <div class="card card-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="d-flex widget-user-header bg-white justify-content-center align-items-center">
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
                              <td><router-link :to="'/cabinets/' + cabinet.cabinet_id"> {{ cabinet.name | upText }} </router-link></td>
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
                <form @submit.prevent="editmode ? updateRoom() : createRoom()">
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
                <form @submit.prevent="editmode ? updateCabinet() : addCabinet()">
                  <div class="form-row">
                    <!-- <div class="form-group col-md-2">
                        <input type="text" class="form-control" placeholder="id" v-model="form.id">
                    </div> -->
                      <div class="form-group col-md-4">                          
                            <input
                            placeholder="Quantity"
                            v-model="form.quantity"
                            type="text"
                            name="quantity"
                            class="form-control"
                            :class="{'is-invalid': form.errors.has('quantity')}"
                            />
                            <has-error :form="form" field="cabinetquantity"></has-error>
                  </div>
                    <div class="form-group col-md-8">
                        <input
                        placeholder="Cabinet Name"
                        v-model="form.name"
                        type="text"
                        name="name"
                        class="form-control"
                        :class="{'is-invalid': form.errors.has('name')}"
                        />
                        <has-error :form="form" field="cabinetname"></has-error>
                    </div>
                  </div>

                    <div class="form-row mb-1">
                        <div class="form-group col-md-4">
                            <input type="text" class="form-control" placeholder="Width" v-model="form.width">
                        </div>
                        <div class="form-group col-md-4">
                            <input type="text" class="form-control" placeholder="Height" v-model="form.height">
                        </div>
                        <div class="form-group col-md-4">
                            <input type="text" class="form-control" placeholder="Depth" v-model="form.depth">
                        </div>
                        <div class="form-group col-md-12">
                             <textarea class="form-control" id="comment" rows="1" placeholder="Comment..." v-model="form.comment"></textarea>
                        </div>
                    </div>
                                  <div class="form-group">
                <select
                  v-model="form.type"
                  name="type"
                  class="form-control"
                  :class="{'is-invalid': form.errors.has('type')}"
                >
                  <option value disabled selected>- Unit Type -</option>
                  <option value="Cabinet">Cabinet</option>
                  <option value="Panel">Panel</option>
                </select>
                <has-error :form="form" field="type"></has-error>
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
                room_id: ""
            })
        }
    },
    methods: {
        cabinetTypeCount() {
            this.totalPanels = 0;
            this.totalCabinets = 0;
            this.rooms.forEach(room => {
                room.cabinets.forEach(cabinet => {
                    if(cabinet.type == 'Cabinet') {
                        this.totalCabinets += cabinet.quantity;
                    } else {
                        this.totalPanels += cabinet.quantity;
                    }
                })
            });
        },
        addCabinetModal(room) {
            this.editmode = false;
            this.form.reset();
            this.form.room_id = room.id;
            $("#addNewCabinet").modal("show");
        },
        addCabinet(){
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
                $("#addNewCabinet").modal("hide");
                this.$Progress.finish();
                Fire.$emit("reloadRooms");
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
            this.form.project_id = this.id
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
                        this.form.project_id = this.id
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
            }
    },
    created() {
        this.loadRooms();        
        Fire.$on("reloadRooms", () => {
            this.loadRooms();
        });
    }
};
</script>
