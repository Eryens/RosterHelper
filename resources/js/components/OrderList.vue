<template>
    <div>
        <h4>Drag and drop the bosses in the order you want :</h4>

        <div class="row">
            <div class="col-sm-1 col-numbers">
                <div v-for="boss in bosses" :key="boss.id" class="list-group col col-numbers">
                    <div class="list-group-item priority-number">{{boss.order}}</div>
                </div>
            </div>
            <div class="col-sm-11 col-bosses">
                <!-- <div v-for="boss in bosses" :key="boss.id" id="bosslist" class="list-group col">
                    <div class="list-group-item"><img class="boss-icon" :src="boss.img_path" :alt="boss.name"> {{boss.name}}</div>
                </div> -->
                <draggable v-model="bosses" group="bosses" @start="drag-true" @end="drag-false">
                    <div class="list-group-item" v-for="boss in bosses" :key="boss.id"><img class="boss-icon" :src="boss.img_path" :alt="boss.name"> {{boss.name}}</div>
                </draggable>
            </div>
        </div>


        <a href="#" class="btn btn-success btn-lg">Save this order</a>
    </div>
</template>

<script>

    export default {

        components: {
            draggable,
        },

        props: {
            idRaid: {
                type: Number,
                required: true,
            }
        },

        data() {
            return {
                drag: [],
                bosses: [],
            }
        },

        methods: {
            loadBosses() {
                axios.get("/boss/"+this.idRaid).then(({data}) => (this.bosses = data));
            },
        },
        
        mounted() {
            this.loadBosses();
        }
    }
</script>
