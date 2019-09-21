<template>
    <div>
        <h4>Users</h4>
            <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Class</th>
                <th></th>
            </tr>
        </thead>
    </table>
    </div>
</template>

<script>
export default {
    data() {
        return {
            users: [],
            form:( {
                id: '',
                confirmed: '',
            }),
        }
    },
}
</script>