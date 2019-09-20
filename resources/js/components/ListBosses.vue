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
                            <input v-model="form.name" type="text" name="name" placeholder="Name"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                        </div>

                        <div class="form-group">
                            <input v-model="form.order" type="number" name="order" placeholder="1"
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
            this.editMode = false;
        },

        updateBoss() {

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