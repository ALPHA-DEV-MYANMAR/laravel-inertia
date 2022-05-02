<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-4">
                <div class="my-4 d-flex justify-content-between align-items-center">
                    <h3>Detail User</h3>
                    <Link href="/user" class="btn btn-primary">User List</Link>
                </div>
                <div>
                    {{ user }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: [ 'user' ]
}
</script>

<style scoped>

</style>
