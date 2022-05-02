<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-12">
                <div class="card my-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3>User List</h3>
                            <Link class="btn btn-primary" href="user/create">Create</Link>
                        </div>

                        <p v-if="status" class="alert alert-success">{{ status }}</p>


                        <table class="table table-borderless">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>User Info</th>
                                <th>Controls</th>
                                <th>Created At</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="align-middle" v-for="user in users.data" :key="user.id">
                                <td>
                                    {{ user.id }}
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <img :src="user.photo" class="user-photo rounded-circle border-2 " alt="">
                                        <div>
                                            {{ user.name }}
                                            <br>
                                            <span class="text-black-50 fs-12">
                                                 {{ user.email }}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <Link :href="`user/${user.id}`" class="btn btn-outline-primary btn-sm" >
                                        <i class="fa-solid fa-circle-info"></i>
                                    </Link>
                                    <Link :href="`user/${user.id}/edit`" class="btn btn-outline-primary btn-sm" >
                                        <i class="fa-solid fa-edit"></i>
                                    </Link>
                                    <button class="btn btn-outline-primary btn-sm" @click="del(user)">
                                        <i class="fa-solid fa-delete-left"></i>
                                    </button>
                                </td>
                                <td>
                                    {{ user.showTime }}
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        {{ users.meta.links }}

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "index",
    props: [ 'users' , 'status' ],
    methods: {
        del(user) {
            this.$inertia.delete(`/user/${user.id}`, { preserveScroll: true });
        }
    },
}
</script>

<style scoped>

</style>
