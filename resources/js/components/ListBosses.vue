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
                        <a class="btn btn-warning"><i class="fas fa-edit"></i></a>
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
                        <h5 class="modal-title" id="bossModalLongTitle">Add a boss</h5>
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

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Add</button>
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
            }),
            editMode : false,
        }
    },

    methods: {
        loadBosses() {
            axios.get("/boss").then(({data}) => (this.bosses = data));
        },

        openCreateModal() {
            console.log('salut') ;
            $('#bossModal').modal('show');
            this.form.clear();
            this.form.reset();
            this.editMode = false;
        },

        updateBoss() {

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
            this.form.post('/boss').then(() => 
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


    },

    mounted() {
        //console.log('Component mounted.');
        
        this.loadBosses();
    },
}
</script>