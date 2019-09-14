<template>
    <div>
        <h4>Drag and drop the bosses in the order you want :</h4>

        <div class="row">
            <div class="col-sm-1 col-numbers">
                <div class="list-group col col-numbers">
                    <div class="list-group-item priority-number">1</div>
                    <div class="list-group-item priority-number">2</div>
                    <div class="list-group-item priority-number">3</div>
                    <div class="list-group-item priority-number">4</div>
                    <div class="list-group-item priority-number">5</div>
                    <div class="list-group-item priority-number">6</div>
                    <div class="list-group-item priority-number">7</div>
                    <div class="list-group-item priority-number">8</div>
                </div>
            </div>
            <div class="col-sm-11 col-bosses">
                <div id="bosslist" class="list-group col">
                    <div class="list-group-item"><img class="boss-icon" src="img/sivara-icon.jpg" alt="">Sivara</div>
                    <div class="list-group-item"><img class="boss-icon" src="img/behemoth-icon.jpg" alt="">Blackwater Behemoth</div>
                    <div class="list-group-item"><img class="boss-icon" src="img/radiance-icon.jpg" alt="">Radiance of Azshara</div>
                    <div class="list-group-item"><img class="boss-icon" src="img/ashvane-icon.jpg" alt="">Lady Ashvane</div>
                    <div class="list-group-item"><img class="boss-icon" src="img/orgozoa-icon.jpg" alt="">Orgozoa</div>
                    <div class="list-group-item"><img class="boss-icon" src="img/court-icon.jpg" alt="">Queen's Court</div>
                    <div class="list-group-item"><img class="boss-icon" src="img/zaqul-icon.jpg" alt="">Za'qul</div>
                    <div class="list-group-item"><img class="boss-icon" src="img/azshara-icon.jpg" alt="">Queen Azshara</div>
                </div>
            </div>
        </div>


        <a href="#" class="btn btn-success btn-lg">Save this order</a>
    </div>
</template>

<script>
    import Sortable from 'sortablejs';

    export default {
        
        mounted() {
            console.log('Component mounted.')
            console.log($('#example1').text()); // works

            new Sortable(bosslist, {
                animation: 150,
                ghostClass: 'blue-background-class'
            });
        }
    }
</script>
