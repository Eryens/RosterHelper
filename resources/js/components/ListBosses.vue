<template>
    <div>
        <h1>pk tu marsh pa</h1>

        <table class="table table-bordered">

        </table>

    </div>
</template>

<script>

    $raidId = 0;

    export default {

        props: ['idraid'],
        mounted () {
            $raidId = this.idraid;
        }
    }
</script>