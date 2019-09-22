<template>
    <div>

        <h4 style="margin-bottom:0">
            Users
        </h4>

        <br/>
        
        <div id="slider"></div>

        <div class="form-check-inline">
            <label class="form-check-label" for="raid-radio">
                <input @change="getUsers()" v-model="picked" type="radio" class="form-check-input" id="raid-radio" name="user-radio" value="raid" checked>Raid team
            </label>
        </div>
        <div class="form-check-inline">
            <label class="form-check-label" for="all-radio">
                <input @change="getUsers()" v-model="picked" type="radio" class="form-check-input" id="all-radio" name="user-radio" value="all">All users
            </label>
        </div>

        <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Class</th>
                <th>Officer note</th>
                <th>Raid member</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="user in users" :key="user.id">
                <td class="td-elem">{{user.username}}</td>
                <td class="td-elem" v-bind:style="{ color: classes[user.player_class_id - 1].color}">
                    {{classes[user.player_class_id - 1].name}}
                </td>
                <td>
                    {{user.officer_note}}
                </td>
                <td v-if="user.confirmed" >
                    <span><i class="fas fa-check"></i></span>
                </td>
                <td v-else>

                </td>
                <td>
                    <a @click="openPlayerInfos(user)" class="btn btn-warning">
                        <i class="fas fa-cog"></i>
                    </a>
                    <a v-if="user.confirmed" @click="removeFromRaidTeam(user.id, user.username)" data-toggle="tooltip" class="table-btn btn btn-danger" title="Remove from the raid team">
                        <span><i class="fas fa-user-times"></i></span>
                    </a>
                    <a v-else @click="addToRaidTeam(user.id, user.username)" data-toggle="tooltip" class="table-btn btn btn-success" title="Add to the raid team">
                        <span><i class="fas fa-user-plus"></i></span>
                    </a>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- Modal -->
    <form @submit.prevent="updatePlayerInfos()">
        <div class="modal fade" id="playerInfosModal" tabindex="-1" role="dialog" aria-labelledby="playerInfosModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="playerInfosModalLongTitle">{{this.form.username}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label>Class :</label>
                        <select v-model="form.player_class_id" class="form-control">
                            <option v-for="playerClass in classes" v-bind:key="playerClass.id" v-bind:value="playerClass.id">
                                {{playerClass.name}}
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Officer's note</label>
                        <input v-model="form.officer_note" type="text" name="officer_note"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('officer_note') }">
                        <has-error :form="form" field="officer_note"></has-error>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
                </div>
            </div>
        </div>
    </form>


    </div>
</template>

<script>
export default {
    data() {
        return {
            picked: 'raid',
            users: [],
            classes: [],
            form: new Form({
                id: '',
                username: '',
                player_class_id: '',
                officer_note : '',
            }),
        }
    },

    methods: {
        getClasses() {
            axios.get('/class').then((data) => (this.classes = data.data));
        },

        getUsers() {
            axios.get('/user/list/' + (this.picked == 'raid' ? 1 : 0)).then((data) => (this.users = data.data));
        },

        openPlayerInfos(user) {
            this.form.clear();
            this.form.reset();
            this.form.fill(user);
            $('#playerInfosModal').modal('show');
        },

        updatePlayerInfos() {
            this.form.put('/user/'+this.form.id).then(() => {
                this.getUsers();
                $('#playerInfosModal').modal('hide');
                Toast.fire({
                    type: 'success',
                    title: this.form.username + '\'s infos have been edited',
                });
            }).catch(e => {
                console.log(e);
            });
        },

        addToRaidTeam(userId, username) {
            console.log('adding to raid team...');
            axios.post('/user/confirm', {
                id: userId,
                confirm: 1
            })
            .then(() => {
                Toast.fire({
                    type: 'success',
                    title: username + ' added to the raid team',
                });
            })
            .catch((error) => (console.log(error)));

            this.getUsers();
        },

        removeFromRaidTeam(userId, username) {
            console.log('removing from raid team...');
            axios.post('/user/confirm', {
                id: userId,
                confirm: 0
            })
            .then(() => {
                Toast.fire({
                    type: 'success',
                    title: username + ' removed from the raid team',
                });
            })
            .catch((error) => (console.log(error)));

            this.getUsers();
        },
    },

    mounted() {
        this.getClasses();
        this.getUsers();
    },
}
</script>

<style scoped>
    .td-elem {
        padding-top: 20px;
    }
</style>