<template>
    <div>
        <h4>Bosses: </h4>
        <a href="#" @click="openCreateModal" class="btn btn-success">Add a boss</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Order</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="boss in bosses" :key="boss.id">
                    <td>{{boss.name}}</td>
                    <td>{{boss.order}}</td>
                    <td>
                        <a @click="openEditModal(boss)" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                        <a @click="deleteBoss(boss.id)" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Modal -->
        <form @submit.prevent="editMode ? updateBoss() : createBoss()">
            <div class="modal fade" id="bossModal" tabindex="-1" role="dialog" aria-labelledby="bossModalTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 v-show="!editMode" class="modal-title" id="bossModalLongTitle">Add a boss</h5>
                        <h5 v-show="editMode" class="modal-title" id="bossModalLongTitle">Edit boss</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">


                        <div class="form-group">
                            <label>Name : </label>
                            <input v-model="form.name" type="text" name="name"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                        </div>

                        <div class="form-group">
                            <label>Order: </label>
                            <input v-model="form.order" type="number" name="order"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('order') }">
                            <has-error :form="form" field="order"></has-error>
                        </div>

                        <div class="form-group">
                            <label>Boss' face</label>
                            <br/>
                            <input type="file" accept="image/*" @change="uploadImage($event)" id="file-input">
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button v-show="!editMode" type="submit" class="btn btn-success">Add</button>
                        <button v-show="editMode" type="submit" class="btn btn-success">Edit</button>
                    </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>
    
<script>

export default {

    props: {
        idRaid: {
            type: Number,
            required: true,
        }
    },

    data() {
        return {
            bosses: [],
            form: new Form( {
                id: '',
                name: '',
                order: '',
                idRaid: this.idRaid,
                img: null,
            }),
            editMode : false,
        }
    },

    methods: {
        uploadImage(e) {
            const file = e.target.files[0];
            console.log(file);
            this.form.img = file;
        },

        loadBosses() {
            axios.get("/boss/"+this.idRaid).then(({data}) => (this.bosses = data));
        },

        openCreateModal() {
            $('#bossModal').modal('show');
            this.form.clear();
            this.form.reset();
            this.form.idRaid = this.idRaid;
            this.editMode = false;
        },

        openEditModal(boss) {
            this.editMode = true;
            this.form.clear();
            this.form.reset();
            this.form.fill(boss);
            this.form.idRaid = this.idRaid;
            $('#bossModal').modal('show');
        },

        deleteBoss(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {

                    // Send to server   
                    this.form.delete('/boss/'+id).then(() => 
                    {
                        if (result.value) 
                        {
                            Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                            );
                            
                            this.loadBosses();
                        }
                    }).catch((error) => {
                        Swal.fire(
                            'Attention gamers!',
                            'Something went wrong',
                            'warning'
                            );
                        console.log(error);
                    });

                    
                })
        },

        createBoss() {
            this.form.submit('post', '/boss', {
                // Transform form data to FormData
              transformRequest: [function (data, headers) {
                return objectToFormData(data)
              }],
            }).then(() => 
            {
                this.loadBosses();
                $('#bossModal').modal('hide');
                Toast.fire({
                    type: 'success',
                    title: 'Boss created',
                });

            }).catch(e => {
                console.log(e);
            })
        },

        updateBoss() {
            this.form.put('/boss/'+this.form.id).then(() => {
                this.loadBosses();
                $('#bossModal').modal('hide');
                Toast.fire({
                    type: 'success',
                    title: 'Boss edited',
                });
            }).catch(e => {
                console.log(e);
            });
        },

    },

    mounted() {
        this.loadBosses();
    },
}
</script>